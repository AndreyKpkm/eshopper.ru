<?php

class AdminOrderController extends AdminBase
{

    /**
     * Action для страниц "Управление заказами"
     * @return bool
     */
    public function actionIndex(): bool
    {

        // Проверка доступа
        self::checkAdmin();

        // Получаем список заказов
        $orderList = Order::getOrderListAdmin();

        // Подключаем вид
        require_once ROOT . '/views/admin_order/index.php';
        return true;

    }

    /**
     * Action для страницы "Редактировать заказ"
     * @param integer $id
     * @return bool
     */
    public function actionUpdate(int $id): bool
    {

        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные из формы
            $user_name = $_POST['user_name'];
            $user_phone = $_POST['user_phone'];
            $user_comment = $_POST['user_comment'];
            $user_id = $_POST['user_id'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            // Сохраняем изменения
            Order::updateOrderById($id, $user_name, $user_phone, $user_comment, $user_id, $date, $status);

            // Перенаправляем пользователя на страницу управления заказами
            header("Location: /admin/order");
        }

        // Подключаем вид
        require_once ROOT . '/views/admin_order/update.php';
        return true;
    }

    public function actionView(int $id)
    {

        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о заказе по id
        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProductsByIds($productsIds);

        // Подключаем вид
        require_once ROOT . '/views/admin_order/view.php';
        return true;

    }

    /**
     * Удалить заказ
     * @param integer $id
     * @return bool
     */
    public function actionDelete(int $id): bool
    {

        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, удаляем заказ
            Order::deleteOrderById($id);

            // Перенаправляем пользователя на страницу управлениями товара
            header("Location: /admin/order");
        }

        // Перенаправляем пользователя на страницу управления заказами
        require_once(ROOT . "/views/admin_order/delete.php");
        return true;

    }

}