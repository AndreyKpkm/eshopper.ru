<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section style="margin-bottom:120px;">
        <div class="container">
            <div class="row">

                <br>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админ-панель</a></li>
                        <li class="active">Управление заказами</li>
                    </ol>
                </div>

                <h4>Список заказов</h4>

                <br>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th>ID заказа</th>
                        <th>Имя клиента</th>
                        <th>Телефон</th>
                        <th>Комментарий</th>
                        <th>ID пользователя</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach($orderList as $order): ?>
                        <tr>
                            <td><a href="/admin/order/view/<?= $order['id'] ?>"><?= $order['id'] ?></a></td>
                            <td><?= $order['user_name'] ?></td>
                            <td><?= $order['user_phone'] ?></td>
                            <td><?= $order['user_comment'] ?></td>
                            <td><?= $order['user_id'] ?></td>
                            <td><?= $order['date'] ?></td>
                            <td><?= Order::getStatusText($order['status']) ?></td>
                            <td>
                                <a href="/admin/order/update/<?= $order['id'] ?>" title="Редактировать">
                                    <i class="fa fa-pencil-square"></i></a>
                            </td>
                            <td>
                                <a href="/admin/order/delete/<?= $order['id'] ?>" title="Удалить">
                                    <i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer_admin.php'; ?>