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

    public static function getOrderList()
    {

        // Соединение с БД
        $db = Db::getConnection();

        $orderList = array();

        $result = $db->query('SELECT `id`, `name` FROM product_order ORDER BY `sort_order` ASC');

        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['name'] = $row['name'];
            $i++;
        }

        return $orderList;

    }

    /**
     * Возвращает массив категорий для списка в админ-панели
     * (при этом в результат попадают и включенные и выключенные категории).
     * @return array - массив категорий.
     */
    public static function getOrderListAdmin(): array
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Запрос в БД
        $sql = 'SELECT `id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `status` FROM product_order ORDER BY id DESC';
        $result = $db->query($sql);

        // Получение и возврат результатов
        $i = 0;
        $orderList = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_name'] = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['user_comment'] = $row['user_comment'];
            $orderList[$i]['user_id'] = $row['user_id'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['status'] = $row['status'];
            $i++;
        }

        return $orderList;

    }

    /**
     * Удалить категорию с заданным id
     * @param integer $id - id заказа
     * @return bool
     */
    public static function deleteOrderById(int $id): bool
    {

        $db = Db::getConnection();
        $sql = "DELETE FROM product_order WHERE id = :id";

        $result = $db->prepare($sql);
        return $result->execute(
            ['id' => $id]
        );

    }

    /**
     * Возвращает статус заказа
     * @param integer $status
     * @return string
     */
    public static function getStatusText(int $status): string
    {

        switch ($status) {
            case 1:
                return 'Новый заказ';
                break;
            case 2:
                return 'В обработке';
                break;
            case 3:
                return 'Доставляется';
                break;
            case 4:
                return 'Завершён';
                break;
            default:
                return 'Ошибка статуса';
        }

    }

    /**
     * Обновить данные заказа
     * @param integer $id - id заказа
     * @param string $user_name - имя клиента
     * @param string $user_phone - номер телефона
     * @param string $user_comment - комментарий к заказу
     * @param integer $user_id - id пользователя
     * @param $date - дата заказа
     * @param integer $status - статус заказа
     * @return bool
     */
    public static function updateOrderById(int $id, string $user_name, string $user_phone, string $user_comment, int $user_id, $date, int $status): bool
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Запрос в БД
        $sql = "UPDATE product_order SET 
                         user_name = :user_name, 
                         user_phone = :user_phone, 
                         user_comment = :user_comment,
                         user_id = :user_id,
                         date = :date,
                         status = :status
                WHERE id = :id";
        $result = $db->prepare($sql);

        // Получение и возврат результатов
        return $result->execute([
            'id' => $id,
            'user_name' => $user_name,
            'user_phone' => $user_phone,
            'user_comment' => $user_comment,
            'user_id' => $user_id,
            'date' => $date,
            'status' => $status,
        ]);

    }

    /**
     * Возвращает заказ с указанным id
     * @param integer $id - id заказа
     * @return array - массив с информацией о заказе
     */
    public static function getOrderProducts(int $id): array
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Запрос в БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';
        $result = $db->prepare($sql);

        // Выполняем запрос
        $result->execute(['id' => $id]);

        return $result->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Просмотр данных заказа
     * @param integer $id - id заказа
     * @return mixed
     */
    public static function getOrderById(int $id)
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Запрос в БД
        $sql = "SELECT * FROM product_order WHERE id = :id";
        $result = $db->prepare($sql);

        // Получение и возврат результатов
        $result->execute([
            'id' => $id,
        ]);

        return $result->fetch(PDO::FETCH_ASSOC);

    }

}