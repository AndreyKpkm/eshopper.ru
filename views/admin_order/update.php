<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section style="margin-bottom:120px;">
        <div class="container">
            <div class="row">

                <br>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админ-панель</a></li>
                        <li><a href="/admin/order">Управление заказами</a></li>
                        <li class="active">Редактировать заказ</li>
                    </ol>
                </div>

                <h1>Редактировать заказ #<?= $order['id'] ?></h1>

                <br>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post">
                            <label for="form-user-name">Имя клиента</label>
                            <input id="form-user-name" type="text" name="user_name" value="<?= $order['user_name'] ?>">

                            <br>

                            <label for="form-user-name">Номер телефона</label>
                            <input id="form-user-name" type="text" name="user_phone" value="<?= $order['user_phone'] ?>">

                            <br>

                            <label for="form-user-comment">Комментарий</label>
                            <textarea id="form-user-comment" name="user_comment" cols="30" rows="10"><?= $order['user_comment'] ?></textarea>

                            <br><br>

                            <label for="form-price">ID клиента</label>
                            <input id="form-price" type="text" name="user_id" value="<?= $order['user_id'] ?>">

                            <br>

                            <label for="form-status">Статус заказа</label>
                            <select id="form-status" name="status">
                                <option value="1" <?php if ($order['status'] === 1) echo ' selected="selected"'; ?>>Новый заказ</option>
                                <option value="2" <?php if ($order['status'] === 2) echo ' selected="selected"'; ?>>В обработке</option>
                                <option value="3" <?php if ($order['status'] === 3) echo ' selected="selected"'; ?>>Доставляется</option>
                                <option value="4" <?php if ($order['status'] === 4) echo ' selected="selected"'; ?>>Завершён</option>
                            </select>

                            <br><br>

                            <label for="form-data">Дата и время заказа</label>
                            <input id="form-data" type="datetime-local" name="date" value="<?= $order['date'] ?>">

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