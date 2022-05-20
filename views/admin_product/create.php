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

                <h1>Добавить новый товар</h1>

                <br>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <label for="form-name">Название товара</label>
                            <input id="form-name" type="text" name="name">

                            <label for="form-code">Артикул</label>
                            <input id="form-code" type="text" name="code">

                            <label for="form-price">Стоимость, $</label>
                            <input id="form-price" type="text" name="price">

                            <label for="form-category">Категория</label>
                            <select id="form-category" name="category_id">
                                <?php if (is_array($categoriesList)) : ?>
                                    <?php foreach ($categoriesList as $category) : ?>
                                        <option value="<?= $category['id'] ?>">
                                            <?= $category['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <br><br>

                            <label for="form-brand">Производитель</label>
                            <input id="form-brand" type="text" name="brand">

                            <label for="form-image">Изображение товара</label>
                            <input id="form-image" type="file" name="image">

                            <label for="form-description">Детальное описание</label>
                            <textarea id="form-description" name="description" cols="30" rows="10"></textarea>

                            <br><br>

                            <label for="form-availability">Наличие на складе</label>
                            <select id="form-availability" name="availability">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br><br>

                            <label for="form-is-new">Новинки</label>
                            <select id="form-is-new" name="is_new">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br><br>

                            <label for="form-is-recommended">Рекомендуемые</label>
                            <select id="form-is-recommended" name="is_recommended">
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br><br>

                            <label for="form-status">Статус</label>
                            <select id="form-status" name="status">
                                <option value="1">Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>

                            <br><br>

                            <input class="btn btn-default" type="submit" name="submit" value="Сохранить">

                            <br><br>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer_admin.php'; ?>