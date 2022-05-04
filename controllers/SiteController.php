<?php

include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class SiteController
{

    public function actionIndex()
    {

        $categories = Category::getCategoriesList();
        $latestProducts = Product::getLatestProducts(6);

        require_once(ROOT . '/views/site/index.php');
        return true;

    }

    public function actionContacts()
    {

        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {

            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors === false) {
                $adminEmail = 'andreychernov1@yandex.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }

        }

        $page = Page::getPageContacts();

        require_once ROOT . '/views/site/contacts.php';

        return true;

    }

}