<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section style="margin-bottom: 120px;">
        <div class="container">
            <div class="row"><br>
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админ-панель</a></li>
                        <li><a href="/admin/category">Управление категориями</a></li>
                        <li class="active">Удалить категорию</li>
                    </ol>
                </div>

                <h4>Удалить категорию #<?= $id ?></h4>
                <p>Вы действительно хотите удалить эту категорию?</p>

                <form action="#" method="post">
                    <input type="submit" name="submit" value="Удалить">
                </form>
            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer_admin.php'; ?>