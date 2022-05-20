<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section style="margin-bottom:120px;">
    <div class="container">
        <div class="row">

            <br>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админ-панель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Просмотр заказа</li>
                </ol>
            </div>

            <h1>Просмотр заказа #<?= $order['id'] ?></h1>

            <br>

            <div class="col-lg-4">
                <div class="login-table">

                    <h5>Информация о заказе</h5>

                    <table class="table-admin-small table-bordered table-striped table">
                        <tr>
                            <td>Номер заказа</td>
                            <td><?= $order['id'] ?></td>
                        </tr>
                        <tr>
                            <td>Имя клиента</td>
                            <td><?= $order['user_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Телефон клиента</td>
                            <td><?= $order['user_phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Комментарий клиента</td>
                            <td><?= $order['user_comment'] ?></td>
                        </tr>
                        <?php if ($order['user_id'] !== 0): ?>
                            <tr>
                                <td>ID клиента</td>
                                <td><?= $order['user_id'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Статус заказа</td>
                            <td><mark><?= Order::getStatusText($order['status']) ?></mark></td>
                        </tr>
                        <tr>
                            <td>Дата заказа</td>
                            <td><?= $order['date'] ?></td>
                        </tr>
                    </table>


                    <h5>Товары в заказе</h5>

                    <table class="table-admin-medium table-bordered table-striped table table-order-products">
                        <thead>
                            <tr>
                                <th>ID товара</th>
                                <th>Артикул товара</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><?= $product['code'] ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= $product['price'] ?></td>
                                    <td><?= $productsQuantity[$product['id']] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                    <a href="/admin/order/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
                </div>
            </div>



        </div>
    </div>
</section>


<?php include ROOT . '/views/layouts/footer_admin.php'; ?>