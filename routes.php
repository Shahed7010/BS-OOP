<?php

$router->get('/', 'controllers/index.php');

$router->get('/category', 'controllers/category/Category.php');

$router->get('/category-item', 'controllers/category/CategoryItem.php');
