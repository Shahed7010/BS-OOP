<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Category</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

</head>

<body>
    <div style="display: flex;  justify-content: center;">
        <h2>Categories with total item</h2>
    </div>

    <div style="display: flex; justify-content: center;">
        <table class="table" style="width: 40%">
            <thead>
                <tr>
                    <th scope="col">Category Name</th>
                    <th scope="col">Total Items</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat) : ?>
                    <tr>
                        <td><?= $cat['Name'] ?></td>
                        <td><?= $cat['items_count'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>