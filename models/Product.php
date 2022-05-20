<?php

class Product
{

    public const SHOW_BY_DEFAULT = 6;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT):array
    {

        $count = intval($count);

        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT `id`, `name`, `price`, `image`, `is_new` FROM product '
                . 'WHERE status = "1"'
                . 'ORDER BY `id` DESC '
                . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }

    public static function getProductsListByCategory($categoryId = false, $page = 1):array
    {

        if ($categoryId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $products = array();
            $result = $db->query("SELECT `id`, `name`, `price`, `image`, `is_new` FROM product "
                    . "WHERE status = '1' AND category_id = '$categoryId' "
                    . "ORDER BY id DESC "
                    . "LIMIT " . self::SHOW_BY_DEFAULT
                    . " OFFSET " . $offset);

            $i = 0;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $products;
        }

    }

    // Return product item by id
    public static function getProductById(int $id)
    {

        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }

        return false;

    }

    public static function getProductsByIds($idsArray)
    {

        $products = [];

        // Соедниение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(', ', $idsArray);

        // Запрос к БД
        $sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idsString)";
        $result = $db->query($sql);

        // Получение и возврат результатов
        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;

    }

    // Return total products
    public static function getTotalProductsInCategory(int $categoryId):int
    {

        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS `count` FROM product WHERE `status` = "1" AND `category_id`="' . $categoryId . '"');
        $row = $result->fetch(PDO::FETCH_ASSOC);

        return $row['count'];

    }

    /**
     * Возвращает список рекомендуемых товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getRecommendedProducts(): array
    {

        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT id, name, price, is_new FROM product WHERE status = "1" AND is_recommended = "1" ORDER BY id DESC';

        // Получение и возврат результатов
        $result = $db->query($sql);

        $i = 0;
        $productsList = [];
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;

    }


    public static function getImage(int $id)
    {

        $noImage = '/template/images/shop/lamoda_temp.jpg';

        $db = Db::getConnection();

        $result = $db->prepare("SELECT image FROM product WHERE id = :id");
        $result->execute(["id" => $id]);
        $pathToProductImage = $result->fetch(PDO::FETCH_LAZY);


        if (file_exists(ROOT . $pathToProductImage['image'])) {
            return $pathToProductImage['image'];
        } else {
            return $noImage;
        }
    }

    /**
     * Удаляет товар с указанным id
     * @param integer $id - id товара
     * @return boolean - результат выполнения метода
     */
    public static function deleteProductById(int $id): bool
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM product WHERE id = :id';

        // Получение и возврат результаов. Используется подготовленный запрос.
        $result = $db->prepare($sql);
        return $result->execute(['id' => $id]);

    }

    /**
     * Возвращает список товаров
     * @return array
     */
    public static function getProductsList(): array
    {

        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT `id`, `name`, `price`, `code` FROM product ORDER BY id ASC';

        // Получение и возврат результатов
        $result = $db->query($sql);

        $i = 0;
        $productsList = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }

        return $productsList;

    }

    /**
     * Редактирует товар с заданным id
     * @param integer $id - id товара
     * @param array $options - массив с информацией о товаре
     * @return bool - результат выполнения метода
     */
    public static function updateProductById(int $id, array $options): bool
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE product SET 
                   name = :name, 
                   code = :code,
                   price = :price,
                   category_id = :category_id,
                   brand = :brand,
                   availability = :availability,
                   description = :description,
                   is_new = :is_new,
                   is_recommended = :is_recommended,
                   status = :status
               WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос.
        $result = $db->prepare($sql);

        $bool = $result->execute([
            'id' => $id,
            'name' => $options['name'],
            'code' => $options['code'],
            'price' => $options['price'],
            'category_id' => $options['category_id'],
            'brand' => $options['brand'],
            'availability' => $options['availability'],
            'description' => $options['description'],
            'is_new' => $options['is_new'],
            'is_recommended' => $options['is_recommended'],
            'status' => $options['status'],
        ]);

        return $bool;

    }

    /**
     * Добавляем новый товар
     * @param array $options - массив с информацией о товаре
     * @return int|string
     */
    public static function createProduct(array $options)
    {

        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'INSERT INTO product (`name`, `code`, `price`, `category_id`, `image`, `brand`, `availability`, `description`, `is_new`, `is_recommended`, `status`) VALUES (:name, :code, :price, :category_id, :image, :brand, :availability, :description, :is_new, :is_recommended, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос.
        $result = $db->prepare($sql);
        $bool = $result->execute([
            "name" => $options['name'],
            "code" => $options['code'],
            "price" => str_replace(',', '.', $options['price']),
            "category_id" => $options['category_id'],
            "image" => ($options['image'] !== "/template/images/shop/") ? $options['image'] : "/template/images/shop/lamoda_temp.jpg",
            "brand" => $options['brand'],
            "availability" => $options['availability'],
            "description" => $options['description'],
            "is_new" => $options['is_new'],
            "is_recommended" => $options['is_recommended'],
            "status" => $options['status'],
        ]);

        if ( $bool ) {
            // Если запрос выполнен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;

    }

}