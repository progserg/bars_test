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
            <td>Артикул</td>
            <td>Наименование</td>
            <td>Единицы Измерения</td>
            <td>Поставщики</td>
            <td>Действие</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->vendor ?></td>
                <td><?= $product->name ?></td>
                <td><?= $product->measure_name ?></td>
                <td>
                    <select id="product-<?= $product->id ?>" multiple>
                        <?php foreach ($providers as $provider): ?>
                            <option value="<?= $provider->id ?>" <?php if (in_array($provider->id, $product->provider_ids)): ?>selected<?php endif; ?> ><?= $provider->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <button onclick="addProvidersToProduct('<?=$product->id?>');">Сохранить</button>
                    <button onclick="clearProviders('<?=$product->id?>');">Очистить выбор</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="/assets/js/script.js"></script>
</body>
</html>