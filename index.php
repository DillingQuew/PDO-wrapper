<?php
use Models\Product;
include "classes/models/Product.php";

$id = 2;
$data = [
            'category_id'=>"1",
            'title'=>'Жопа Димаса NEW',
//            'price' => '100',
            'descr' => 'Продано!!!',
//            'sort' => '2',
        ];
$product = new Product();
Product::softDelete(2);
Product::update(3, $data);
$data = Product::getAll();
Product::hardDelete(10);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID категории</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Цена</th>
                <th scope="col">Описание</th>
                <th scope="col">Сортировка</th>
                <th scope="col">Создано</th>
                <th scope="col">Обновлено</th>
                <th scope="col">Удалено</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $obj) { ?>
            <tr>
                <th scope="row"><?=$obj['id']?></th>
                <td><?=$obj['category_id']?></td>
                <td><?=$obj['title']?></td>
                <td><?=$obj['price']?> р.</td>
                <td><?=$obj['description']?></td>
                <td><?=$obj['sort']?></td>
                <td><?=$obj['created_at']?></td>
                <td><?=$obj['updated_at']?></td>
                <td><?=$obj['deleted_at']?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
