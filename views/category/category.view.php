<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Category</title>

</head>

</head>

<body>
    <div style="display: flex; justify-content: center">
        <h2>Category list with Item count.</h2>
    </div>

    <div style="margin-left: 20%">

        <?php
        function countChildrenInArray(array $array)
        {
            $count = 0;
            foreach ($array as $item) {
                if (count($item['children'])) {
                    $count += countChildrenInArray($item['children']);
                }
                $count += count($item['items']) ?? 0;
            }
            return $count;
        }
        function printArrayAsList($categories)
        {
            echo '<ul>';
            foreach ($categories as $cat) {
                echo '<li>' . $cat['Name'];
                if (count($cat['children'])) {
                    echo "(" . countChildrenInArray($cat['children']) + count($cat['items']) . ")" . '</li>';
                    printArrayAsList($cat['children']);
                } else {
                    echo "(" . count($cat['items']) . ")";
                }
            }
            echo '</ul><br>';
        }
        printArrayAsList($categories);

        ?>

    </div>

</body>

</html>