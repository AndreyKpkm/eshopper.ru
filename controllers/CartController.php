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

}