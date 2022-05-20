<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section style="margin-bottom:120px;">
        <div class="container">
            <div class="row">

                <br>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админ-панель</a></li>
                        <li><a href="/admin/category">Управление категориями</a></li>
                        <li class="active">Добавить категорию</li>
                    </ol>
                </div>

                <h1>Добавить новую категорию</h1>

                <br>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li> - <?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post">

                            <label for="form-name">Название</label>
                            <input id="form-name" type="text" name="name">

                            <label for="form-sort-order">Порядковый номер</label>
                            <input id="form-sort-order" type="text" name="sort_order">

                            <label for="form-status">Статус</label>
                            <select id="form-status" name="status">
                                <option value="1" selected="selected">Отображается</option>
                                <option value="0">Скрыта</option>
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