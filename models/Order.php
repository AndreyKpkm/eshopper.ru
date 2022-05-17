<?php

class Order
{

    /**
     * Сохранение заказа
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {


        $db = Db::getConnection();
        $products = json_encode($products);

        if ($userId === false) $userId = 1;

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';


        $result = $db->prepare($sql);

        return $result->execute([
            "user_name" => $userName,
            "user_phone" => $userPhone,
            "user_comment" => $userComment,
            "user_id" => $userId,
            "products" => $products,
        ]);

    }

}