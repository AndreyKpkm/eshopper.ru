<?php

class Category
{

    public static function getCategoriesList()
    {

        // Соединение с БД
        $db = Db::getConnection();

        $categoryList = array();

        $result = $db->query('SELECT `id`, `name` FROM category ORDER BY `sort_order` ASC');

        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;

    }

    /**
     * Возвращает массив категорий для списка в админ-панели
     * (при этом в результат попадают и включенные и выключенные категории).
     * @return array - массив категорий.
     */
    public static function getCategoriesListAdmin(): array
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Запрос в БД
        $sql = 'SELECT `id`, `name`, `sort_order`, `status` FROM category ORDER BY sort_order ASC';
        $result = $db->query($sql);

        // Получение и возврат результатов
        $i = 0;
        $categoryList = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }

        return $categoryList;

    }

    /**
     * Создать новую категорию
     * @param string $name
     * @param integer $sortOrder
     * @param integer $status
     * @return bool
     */
    public static function createCategory(string $name, int $sortOrder, int $status): bool
    {
        
        $db = Db::getConnection();
        $sql = "INSERT INTO category (name, sort_order, status) VALUES (:name, :sort_order, :status)";
        $result = $db->prepare($sql);

        return $result->execute([
            'name' => $name,
            'sort_order' => $sortOrder,
            'status' => $status,
        ]);
    
    }


    /**
     * Удалить категорию с заданным id
     * @param integer $id
     * @return bool
     */
    public static function deleteCategoryById(int $id): bool
    {
        
        $db = Db::getConnection();
        $sql = "DELETE FROM category WHERE id = :id";

        $result = $db->prepare($sql);
        return $result->execute(
            ['id' => $id]
        );

    }

    /**
     * Обновить категорию с указанным id
     * @param integer $id
     * @param string $name
     * @param integer $sortOrder
     * @param integer $status
     * @return bool
     */
    public static function updateCategoryById(int $id, string $name, int $sortOrder, int $status): bool
    {
        
        $db = Db::getConnection();
        $sql = "UPDATE category SET name = :name, sort_order = :sort_order, status = :status WHERE id = :id";

        $result = $db->prepare($sql);

        return $result->execute([
            'id' => $id,
            'name' => $name,
            'sort_order' => $sortOrder,
            'status' => $status,
        ]);
        
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public static function getCategoryById(int $id)
    {
        
        $db = Db::getConnection();
        $sql = "SELECT * FROM category WHERE id = :id";

        $result = $db->prepare($sql);
        
        $result->execute([
            'id' => $id,
        ]);
        
        return $result->fetch(PDO::FETCH_ASSOC);
        
    }

}