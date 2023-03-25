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
    $categories[$key]['items_count'] = count(array_filter($items, function ($item) use ($cat) {
        return $item['pivot_categoryId'] == $cat['Id'];
    }));
}

usort($categories, function ($item1, $item2) {
    return $item2['items_count'] <=> $item1['items_count'];
});

// dd($categories);

view("category/category_item.view.php", [
    'categories' => $categories
]);
