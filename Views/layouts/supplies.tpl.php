<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bars-test-project</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
    <ul class="main-menu">
        <li><a href="/">Поставщики</a></li>
        <li><a href="/product">Товары</a></li>
        <li><a href="/supply">Форма поставок</a></li>
    </ul>
    <h1><?= $title ?></h1>
    <h3>Поиск</h3>
    <table>
        <thead>
        <tr>
            <td>Товар</td>
            <td>Поставщик</td>
            <td>Дата</td>
            <td>Клиент</td>
            <td>Действие</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <form name="form_search">
                <td><input name="search_product" type="text""></td>
                <td><input name="search_provider" type="text""></td>
                <td><input name="search_date" type="date""></td>
                <td><input name="search_customer" type="text""></td>
                <td>
                    <input class="col" type="button" value="Найти" onclick="searchSupplies();">
                    <input class="col" type="button" value="Очистить" onclick="clearSearch();">
                </td>
            </form>
        </tr>
        </tbody>
    </table>
    <table>
        <thead>
        <tr>
            <td>ID</td>
            <td>Поставщик</td>
            <td>Товар</td>
            <td>Количество</td>
            <td>Дата</td>
            <td>Клиент</td>
            <td>Действие</td>
        </tr>
        </thead>
        <tbody id="supplies" class="supplies">
        <?php foreach ($supplies as $supply): ?>
            <tr>
                <form method="post" class="row stroke-bottom" id="supply-<?= $supply->id ?>">
                    <td><?= $supply->id ?></td>
                    <td>
                        <select name="provider_id_<?= $supply->id ?>">
                            <?php foreach ($providers as $provider): ?>
                                <option value="<?= $provider->id ?>"
                                        <?php if ($supply->provider_id == $provider->id): ?>selected<?php endif; ?> ><?= $provider->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select name="product_id_<?= $supply->id ?>">
                            <?php foreach ($products as $product): ?>
                                <option value="<?= $product->id ?>"
                                        <?php if ($supply->product_id == $product->id): ?>selected<?php endif; ?> ><?= $product->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input name="quantity_<?= $supply->id ?>" type="text" value="<?= $supply->quantity ?>">
                    </td>
                    <td><?= $supply->date ?></td>
                    <td>
                        <input name="customer_<?= $supply->id ?>" type="text" value="<?= $supply->customer ?>">
                    </td>
                    <td>
                        <input type="button" value="Сохранить" onclick="saveSupply(<?= $supply->id ?>);">
                        <input type="button" value="Удалить" onclick="delSupply(<?= $supply->id ?>);">
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <h2 class="margin-top-15">Добавить поставку</h2>
    <table>
        <thead>
        <tr>
            <td>Поставщик</td>
            <td>Товар</td>
            <td>Количество</td>
            <td>Клиент</td>
            <td>Действие</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <form action="" method="post" class="row form-add" name="form_add">
                <td>
                    <select name="add_provider" id="">
                        <?php foreach ($providers as $provider): ?>
                            <option value="<?= $provider->id ?>"><?= $provider->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select name="add_product" id="">
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product->id ?>"><?= $product->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input name="add_quantity" type="text" value="1">
                </td>
                <td>
                    <input name="add_customer" type="text" value="заказчик">
                </td>
                <td>
                    <input type="button" value="Добавить" onclick="addSupply();">
                </td>
            </form>
        </tr>
        </tbody>
    </table>
</div>
<script src="/assets/js/script.js"></script>
</body>
</html>