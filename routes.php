<?php

$router->get('/', 'controllers/index.php');

$router->get('/category', 'controllers/category/CategoryController.php');

$router->get('/category-item', 'controllers/category/CategoryItemController.php');
