<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$categories = $db->query('select `Name`, `Id`, `Number` from `category`')->get();

$catIds = array_map(fn ($cat) => $cat['Id'], $categories);
$ids = join(', ', $catIds);

$items = $db->query("select `item`.`Id`, `item`.`Number`, `item_category_relations`.`categoryId` as `pivot_categoryId`,
 `item_category_relations`.`ItemNumber` as `pivot_ItemNumber` from `item` inner join `item_category_relations`
  on `item`.`Number` = `item_category_relations`.`ItemNumber` where `item_category_relations`.`categoryId` 
  in ($ids)")->get();

foreach ($categories as $key => $cat) {
    $categories[$key]['items'] = array_filter($items, function ($item) use ($cat) {
        return $item['pivot_categoryId'] == $cat['Id'];
    });
}

$children = $db->query("select `category`.*, `catetory_relations`.`ParentcategoryId` as `pivot_ParentcategoryId`,
 `catetory_relations`.`categoryId` as `pivot_categoryId` from `category` inner join 
 `catetory_relations` on `category`.`Id` = `catetory_relations`.`categoryId` 
 where `catetory_relations`.`ParentcategoryId` in ($ids)")->get();

foreach ($children as $key => $cat) {
    $children[$key]['items'] = array_filter($items, function ($item) use ($cat) {
        return $item['pivot_categoryId'] == $cat['Id'];
    });
}

// dd(($children));

function setChildren(&$categories, $children)
{
    foreach ($categories as $key => $cat) {
        $categories[$key]['children'] = array_filter($children, function ($child) use ($cat) {
            return $child['pivot_ParentcategoryId'] == $cat['Id'];
        });
        if (count($categories[$key]['children'])) {
            setChildren($categories[$key]['children'], $children);
        }
    }
}

setChildren($categories, $children);

// dd($categories);

view("category/category.view.php", [
    'categories' => $categories
]);
