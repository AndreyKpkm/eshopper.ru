<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section style="margin-bottom:120px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Добрый день, администратор!</h1>
                    <p>Вам доступны такие возможности:</p>

                    <div>
                        <a href="/admin/product">Управление товарами</a><br>
                        <a href="/admin/category">Управление категориями</a><br>
                        <a href="/admin/order">Управление заказами</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer_admin.php'; ?>