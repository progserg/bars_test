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
    <table>
        <thead>
        <tr>
            <td>ID</td>
            <td>ИНН</td>
            <td>Поставщик</td>
            <td>Наименование</td>
            <td>Действие</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($providers as $provider): ?>
            <tr>
                <td><?= $provider->id ?></td>
                <td><?= $provider->inn ?></td>
                <td><?= $provider->name ?></td>
                <td>
                    <select id="provider-<?= $provider->id ?>" multiple>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product->id ?>"
                                    <?php if (in_array($product->id, $provider->product_ids)): ?>selected<?php endif; ?> ><?= $product->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <button onclick="addProductsToProvider('<?= $provider->id ?>');">Сохранить</button>
                    <button onclick="clearProducts('<?= $provider->id ?>');">Очистить выбор</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="/assets/js/script.js"></script>
</body>
</html>