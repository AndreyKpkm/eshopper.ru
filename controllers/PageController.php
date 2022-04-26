<?php

include_once ROOT . '/models/Page.php';

class PageController
{

    public function actionView($pageSlug)
    {

        $page = Page::getPage($pageSlug);

        require_once(ROOT . '/views/page/view.php');

        return true;

    }

}