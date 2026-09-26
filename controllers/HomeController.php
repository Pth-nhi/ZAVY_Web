<?php

class HomeController
{
    public function index()
    {
        $title = 'Trang chủ - ZAVYWEB';

        $contentView = __DIR__ . '/../views/home/index.php';

        require_once __DIR__ . '/../views/layouts/layout.php';
    }
}