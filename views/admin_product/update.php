<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section style="margin-bottom:120px;">
        <div class="container">
            <div class="row">

                <br>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админ-панель</a></li>
                        <li><a href="/admin/product">Управление товарами</a></li>
                        <li class="active">Создать товар</li>
                    </ol>
                </div>

                <h1>Редактировать товар «<?= $product['name']; ?>»</h1>

                <br>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <label for="form-name">Название товара</label>
                            <input id="form-name" type="text" name="name" value="<?= $product['name'] ?>">

                            <label for="form-code">Артикул</label>
                            <input id="form-code" type="text" name="code" value="<?= $product['code'] ?>">

                            <label for="form-price">Стоимость, $</label>
                            <input id="form-price" type="text" name="price" value="<?= $product['price'] ?>">

                            <label for="form-category">Категория</label>
                            <select id="form-category" name="category_id">
                                <?php if (is_array($categoriesList)) : ?>
                                    <?php foreach ($categoriesList as $category) : ?>
                                        <option value="<?= $category['id'] ?>" <?php if ($product['category_id'] === $category['id']) echo 'selected="selected"' ?>>
                                            <?php echo $category['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <br><br>

                            <label for="form-brand">Производитель</label>
                            <input id="form-brand" type="text" name="brand" value="<?= $product['brand'] ?>">

                            <label for="form-image">Изображение товара</label>
                            <input id="form-image" type="file" name="image" value="<?= $product['image'] ?>">

                            <img src="<?= Product::getImage($product['id']); ?>" width="200" alt="<?= $product['name'] ?>" />
                            <input type="file" name="image" value="<?= $product['image']; ?>">

                            <label for="form-description">Детальное описание</label>
                            <textarea id="form-description" name="description" cols="30" rows="10"><?= $product['description'] ?></textarea>

                            <br><br>

                            <label for="form-availability">Наличие на складе</label>
                            <select id="form-availability" name="availability">
                                <option value="1" <?php if ($product['availability'] === 1) echo ' selected="selected"'; ?>>Да</option>
                                <option value="0" <?php if ($product['availability'] === 0) echo ' selected="selected"'; ?>>Нет</option>
                            </select>

                            <br><br>

                            <label for="form-is-new">Новинки</label>
                            <select id="form-is-new" name="is_new">
                                <option value="1" <?php if ($product['is_new'] === 1) echo ' selected="selected"'; ?>>Да</option>
                                <option value="0" <?php if ($product['is_new'] === 0) echo ' selected="selected"'; ?>>Нет</option>
                            </select>

                            <br><br>

                            <label for="form-is-recommended">Рекомендуемые</label>
                            <select id="form-is-recommended" name="is_recommended">
                                <option value="1" <?php if ($product['is_recommended'] === 1) echo ' selected="selected"'; ?>>Да</option>
                                <option value="0" <?php if ($product['is_recommended'] === 0) echo ' selected="selected"'; ?>>Нет</option>
                            </select>

                            <br><br>

                            <label for="form-status">Статус</label>
                            <select id="form-status" name="status">
                                <option value="1" <?php if ($product['status'] === 1) echo ' selected="selected"'; ?>>Отображается</option>
                                <option value="0" <?php if ($product['status'] === 0) echo ' selected="selected"'; ?>>Скрыт</option>
                            </select>

                            <br><br>

                            <input class="btn btn-default" type="submit" name="submit" value="Обновить данные">

                            <br><br>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer_admin.php'; ?>