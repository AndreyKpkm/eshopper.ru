<?php

class Cart
{

    public static function addProduct($id)
    {

        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = [];

        // Если в корзине уже есть товары, они хранятся в сессии.
        if ( isset($_SESSION['products']) ) {
            // Тогда заполним наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар есть в корзине, но был добавлен ещё раз, увеличим количество.
        if ( array_key_exists($id, $productsInCart) ) {
            $productsInCart[$id]++;
        } else {
            // Добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();

    }

    /**
     * Подсчёт количества товаров в корзине (в сессии)
     * @return int
     */
    public static function countItems()
    {

        if ( isset($_SESSION['products']) ) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        }

    }

    /**
     * @return bool|mixed
     */
    public static function getProducts()
    {

        if ( isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;

    }

    /**
     * @param $products
     * @return float|int
     */
    public static function getTotalPrice($products)
    {

        $productsInCart = self::getProducts();

        $total = 0;

        if ( $productsInCart ) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;

    }

    /**
     * Удалит товар из корзины
     * @param int $id
     * @return bool
     */
    public static function removeProduct(int $id)
    {

        $id = intval($id);

        if ( isset($_SESSION['products'][$id]) ) {
            unset($_SESSION['products'][$id]);
        } else {
            return false;
        }

    }

    public static function clear()
    {

        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }

    }

}