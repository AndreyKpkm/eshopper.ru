<?php include ROOT . '/views/layouts/header.php' ?>

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="/template/images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                <img src="/template/images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>100% Responsive Design</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="/template/images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                <img src="/template/images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free Ecommerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="/template/images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                <img src="/template/images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Категории</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        <?php foreach ($categories as $categoryItem) : ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="/category/<?= $categoryItem['id'] ?>"><?= $categoryItem['name'] ?></a>
                                </h4>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div><!--/category-products-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="/template/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>

                    <?php foreach($latestProducts as $product) : ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="<?= $product['image'] ?>" alt="" width="255" height="368" />
                                    <h2>$<?= $product['price'] ?></h2>
                                    <p>
                                        <a href="/product/<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                    </p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    <?php if($product['is_new']) : ?>
                                        <img src="/template/images/home/new.png" class="new" alt="new product">
                                    <?php endif; ?>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>$<?= $product['price'] ?></h2>
                                        <p>
                                            <a href="/product/<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                        </p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>


                </div><!--features_items-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="cycle-slideshow"
                             data-cycle-fx="carousel"
                             data-cycle-timeout="15000"
                             data-cycle-carousel-visible="4"
                             data-cycle-carousel-fluid="true"
                             data-cycle-slides="div.item"
                             data-cycle-prev="#prev"
                             data-cycle-next="#next"
                        >

                            <!-- Блоки слайдов -->
                            <?php foreach ($sliderProducts as $sliderItem) : ?>
                                <div class="item">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="<?= Product::getImage($sliderItem['id']) ?>" alt="<?= $sliderItem['name'] ?>">
                                                <p class="slider-price">$<?= $sliderItem['price'] ?></p>
                                                <a href="#" class="btn btn-default add-to-cart" data-id="<?= $sliderItem['id'] ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                                <br>
                                            </div>
                                            <?php if ($sliderItem['is_new']) : ?>
                                                <img class="new" src="/template/images/home/new.png" alt="new">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- /Блоки слайдов -->

                        </div>
                        <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" id="next"  href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php' ?>