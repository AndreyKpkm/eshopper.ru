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
                        <h2 class="title text-center">Корзина</h2>
                        <?php if ($productsInCart) : ?>
                            <p>Вы выбрали такие товары:</p>
                            <table class="table-bordered table-striped table">
                                <tr>
                                    <th class="col-delete"></th>
                                    <th>Код товара</th>
                                    <th>Название</th>
                                    <th>Кол-во, шт</th>
                                    <th>Стоимость, $</th>
                                </tr>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td class="col-delete">
                                            <button class="btn" data-id="<?= $product['id'] ?>" title="Удалить"><i class="fa fa-times"></i></button>
                                        </td>
                                        <td><?= $product['code'] ?></td>
                                        <td>
                                            <a href="/product/<?= $product['id'] ?>">
                                                <?= $product['name'] ?>
                                            </a>
                                        </td>
                                        <td><?= $productsInCart[$product['id']] ?></td>
                                        <td><?= $product['price'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4">Общая стоимость</td>
                                    <td id="cart-total-price"><?= $totalPrice ?></td>
                                </tr>
                            </table>
                            <a class="btn btn-default" href="/cart/checkout/">Оформить заказ</a>
                        <?php else : ?>
                            <p>Корзина пуста</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer.php' ?>