<?php

class Page
{

    public static function getPage($pageSlug)
    {

        $slug = trim($pageSlug);

        if ($pageSlug) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM page WHERE `slug` = '{$slug}'");

            $row = $result->fetch(PDO::FETCH_ASSOC);

            return $row;

        }

    }

    public static function getPageContacts()
    {

        $db = Db::getConnection();

        $result = $db->query("SELECT * FROM page WHERE `slug` = 'contacts'");
        $row = $result->fetch(PDO::FETCH_ASSOC);

        return $row;

    }

}