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