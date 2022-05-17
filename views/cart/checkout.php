<?php include ROOT . '/views/layouts/header.php' ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products">
                            <?php foreach ($categories as $categoryItem) : ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/category/<?= $categoryItem['id'] ?>"><?= $categoryItem['name'] ?></a>
                                        </h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">Оформление заказа</h2>

                        <?php if ($result) : ?>

                            <p>Заказ оформлен. Мы Вам перезвоним.</p>

                        <?php else : ?>

                            <p>Выбрано товаров: <?= $totalQuantity ?>, на сумму $<?= $totalPrice ?>.</p><br>

                            <div class="col-sm-4">
                                <?php if (isset($errors) && is_array($errors)): ?>
                                    <ul>
                                        <?php foreach ($errors as $error) : ?>
                                            <li> - <?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <p>Для оформления заказа заполните форму.  Наш менеджер свяжется с Вами.</p>

                                <div class="login-form">

                                    <form action="#" method="post">
                                        <div>
                                            <label for="order-name">Ваше имя</label><br>
                                            <input id="order-name" type="text" name="order-name" value="<?= $userName ?>">
                                        </div>
                                        <div>
                                            <label for="order-phone">Номер телефона</label><br>
                                            <input id="order-phone" type="text" name="order-phone" value="<?= $userPhone ?>">
                                        </div>
                                        <div>
                                            <label for="order-comment">Комментарий к заказу</label><br>
                                            <input id="order-comment" type="text" name="order-comment" value="<?= $userComment ?>">
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-default" name="submit" value="Оформить">
                                    </form>

                                </div>

                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.







<?php include ROOT . '/views/layouts/footer.php' ?>