<?php

class AdminCategoryController extends AdminBase
{

    /**
     * Action для страниц "Управление категориями"
     * @return bool
     */
    public function actionIndex(): bool
    {

        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $categoriesList = Category::getCategoriesListAdmin();

        // Подключаем вид
        require_once ROOT . '/views/admin_category/index.php';
        return true;

    }

    /**
     * Action для страницы "Добавить категорию"
     * @return bool
     */
    public function actionCreate(): bool
    {

        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные из формы
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors === false) {
                // Если ошибок нет, добавляем новую категорию
                Category::createCategory($name, $sortOrder, $status);

                // Перенаправляем пользователя на страницу управления категориями
                header("Location: /admin/category");
            }
        }

        require_once ROOT . '/views/admin_category/create.php';
        return true;

    }

    /**
     * Action для страницы "Редактировать категорию"
     * @param integer $id
     * @return bool
     */
    public function actionUpdate(int $id): bool
    {

        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретной категории
        $category = Category::getCategoryById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные из формы
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Сохраняем изменения
            Category::updateCategoryById($id, $name, $sortOrder, $status);

            // Перенаправляем пользователя на страницу управления категориями
            header("Location: /admin/category");
        }

        // Подключаем вид
        require_once ROOT . '/views/admin_category/update.php';
        return true;
    }

    public function actionDelete($id)
    {

        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, удаляем категорию
            Category::deleteCategoryById($id);

            // Перенаправляем пользователя на страницу управлениями товара
            header("Location: /admin/category");
        }

        // Перенаправляем пользователя на страницу управления товарами
        require_once(ROOT . "/views/admin_category/delete.php");
        return true;

    }

}