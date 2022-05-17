<?php

class User
{

    public static function register($name, $email, $password)
    {

        $db = Db::getConnection();

        $sql = 'INSERT INTO user (`name`, `email`, `password`) VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->execute(['name' => $name, 'email' => $email, 'password' => $password]);

        return $result;

    }

    // Проверяет имя: не меньше, чем 2 символа
    public static function checkName($name)
    {

        if (strlen($name) > 2) {
            return true;
        }
        return false;

    }

    // Проверяет имя: не меньше, чем 6 символов
    public static function checkPassword($password)
    {

        if (strlen($password) >= 6) {
            return true;
        }
        return false;

    }

    // Проверяет email на валидность
    public static function checkEmail($email)
    {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;

    }

    // Проверка email на совпадение в базе данных
    public static function checkEmailExists($email)
    {

        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->execute(['email'=>$email]);

        if ($result->fetchColumn())
            return true;
        return false;

    }

    // Проверяет телефон: не меньше, чем 7 символа
    public static function checkPhone($phone)
    {

        if (strlen($phone) > 7) {
            return true;
        }
        return false;

    }

    /**
     * Проверяем, существует ли пользователь с заданными $email и $password
     * @param string $email
     * @param string $password
     * @return mixed : integer user id or false
     */
    public static function checkUserData(string $email, string $password)
    {

        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->execute(['email' => $email, 'password' => $password]);

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return false;

    }

    /**
     * Запоминаем пользователя
     * @param string $userId
     */
    public static function auth(string $userId):void
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернём идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login/");
        return false;
    }

    /**
     * Проверяем, авторизован ли пользователь на сайте
     * @return bool
     */
    public static function isGuest():bool
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Возвращает данные пользователя по его id
     * @param $userId
     * @return bool|mixed
     */
    public static function getUserById($userId)
    {
        $id = intval($userId);

        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->execute(['id' => $id]);

            return $result->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public static function edit($userId, $name, $password)
    {

        $db = Db::getConnection();

        $sql = 'UPDATE user SET name = :name, password = :password WHERE id = :id';

        $result = $db->prepare($sql);
        return $result->execute(['id'=>$userId, 'name'=>$name, 'password'=>$password]);

    }

}