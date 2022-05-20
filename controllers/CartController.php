<?php

class CartController
{

    public function actionAdd($id)
    {

        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");

    }

    public function actionAddAjax($id)
    {

        // Добавляем товар в корзину
        echo Cart::addProduct($id);
        return true;

    }

    /**
     * Возвращает товары
     * @return bool
     */
    public function actionIndex()
    {

        $categories = Category::getCategoriesList();

        // Получим данные из корзины
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once ROOT . '/views/cart/index.php';

        return true;

    }

    /**
     * Удаляет товары из корзины
     */
    public function actionRemoveAjax($id)
    {

        Cart::removeProduct($id);
        return true;

    }

    /**
     * Обновляет общую сумму заказа корзины
     */
    public function actionUpdateTotalPriceCartAjax()
    {

        // Итоги: обшая стоимость, количество товаров
        $productsInCart = Cart::getProducts();
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

//        return $totalPrice;
        echo $totalPrice;
        return true;
    }

    public function actionCheckout()
    {

        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Статус успещного оформления заказа
        $result = false;

        // Форма отправлена?
        if (isset($_POST['submit'])) {
            // Форма была отправлена

            // Считываем данные формы
            $userName = $_POST['order-name'];
            $userPhone = $_POST['order-phone'];
            $userComment = $_POST['order-comment'];

            // Валидация полей
            $errors = false;
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }

            // Форма заполнена корректно?
            if ($errors == false) {
                // Форма заполнена корректно? - Да
                // Сохраняем заказ в базе данных

                // Собираем информацию с заказа
                $productsInCart = Cart::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }

                // Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    // Оповещаем администратора о новом заказе
                    $adminEmail = 'andreychernov1@yandex.ru';
                    $message = 'http://test-eshopper.ru/admin/orders';
                    $subject = 'Новый заказ';
                    mail($adminEmail, $subject, $message);

                    // Очищаем корзину
                    Cart::clear();
                }

            } else {
                // Форма заполнена корректно? - Нет

                // Итоги: обшая стоимость, количество товаров
                $productsInCart = Cart::getProducts();
                if (empty($productsInCart)) header("Location: /catalog/");
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }

        } else {
            // Форма отправлена? - Нет

            // Получаем данные из корзины
            $productsInCart = Cart::getProducts();

            // В корзине есть товары?
            if ($productsInCart === false) {
                // В корзине есть товары? - Нет
                // Отправляем пользователя в каталог искать товары
                header("Location: /catalog/");
            } else {
                //  В корзине есть товары? - Да

                // Итоги: общая стоимость, количество товаров
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Пользовтель авторизован?
                if (User::isGuest()) {

                } else {
                    // Да, авторизован.
                    // Получаем информацию о пользователе из БД по id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    // Подставляем в форму
                    $userName = $user['name'];
                }
            }
        }

        require_once ROOT . '/views/cart/checkout.php';

        return true;

    }

}