<?php

class AdminProductController extends AdminBase
{

    // Action для страницы "Управление товарами"
    public function actionIndex()
    {

        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $productsList = Product::getProductsList();

        // Подключаем вид
        require_once ROOT . '/views/admin_product/index.php';
        return true;

    }

    /**
     * Action для страницы "Удалить товар"
     * @param $id
     * @return boolean
     */
    public function actionDelete($id): bool
    {

        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, тогда удаляем товар
            Product::deleteProductById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/product/");
        }

        // Подключаем вид
        require_once ROOT . '/views/admin_product/delete.php';
        return true;

    }

    /**
     * Action ля страницы "Добавить товар"
     * @return bool
     */
    public function actionCreate()
    {

        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорй для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['image'] = "/template/images/shop/{$_FILES['image']['name']}";
            $options['description'] = $_POST['description'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors === false) {
                // Если ошибок нет, добавляем новый товар
                $id = Product::createProduct($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        // Если загружалось, переносим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/template/images/shop/{$_FILES['image']['name']}");
                    }
                }

                // Перенаправляем пользователя на страницу управления товарами
                header("Location: /admin/product");
            }
        }

        // Подключаем вид
        require_once ROOT . '/views/admin_product/create.php';
        return true;

    }

    /**
     * Action для страницы "Редактировать товар"
     */
    public function actionUpdate($id) {

        // Проверка доступа
        self::checkAdmin();

        // олучаем список категорий для выпдающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Получаем данные о конкретном заказе
        $product = Product::getProductById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена, получаем данные из формы редактрования. При необходимости можно валидировать значения.
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения.
            if (Product::updateProductById($id, $options)) {
                // Если запись сохранена.
                // Проверим, загружалось ли через форму изображение.
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    // Если загружалось, переместим его в нужную папку, дадим новое имя.
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/template/images/shop/{$_FILES['image']['name']}");
                }
            }
            header('Location: /admin/product');

        }
        require_once __DIR__ . '/../views/admin_product/update.php';
        return true;
    }

}