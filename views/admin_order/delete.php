<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section style="margin-bottom: 120px;">
        <div class="container">
            <div class="row"><br>
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админ-панель</a></li>
                        <li><a href="/admin/order">Управление заказами</a></li>
                        <li class="active">Удалить заказ</li>
                    </ol>
                </div>

                <h4>Удалить заказ #<?= $id ?></h4>
                <p>Вы действительно хотите удалить этот заказ?</p>

                <form action="#" method="post">
                    <input type="submit" name="submit" value="Удалить">
                </form>
            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer_admin.php'; ?>