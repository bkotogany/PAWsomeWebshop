<?php

namespace Webshop\Controllers;

use Webshop\View;

class IndexController extends BaseController
{
    public function index(): void
    {
        echo (new View())->render('index.php', [
            'title' => 'Kezdőlap - Állatwebshop'
        ]);
    }
}