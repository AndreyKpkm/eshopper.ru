<?php include ROOT . '/views/layouts/header.php' ?>


<div id="page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="title text-center"><?= $page['name'] ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= '<p>' . $page['text'] . '</p>' ?>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->

<div style="height:90px"></div>



<?php include ROOT . '/views/layouts/footer.php' ?>
