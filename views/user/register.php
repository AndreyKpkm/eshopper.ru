<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">


            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if (isset($result) && $result) : ?>
                    <p>Вы успешно зарегистрировались!</p>
                <?php else : ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form">
                        <h2>Регистрация на сайте</h2>
                        <form action="#" method="post"> <!-- sign up form -->
                            <input type="text" name="name" placeholder="Имя" value="<?= $name ?>">
                            <input type="email" name="email" placeholder="Email" value="<?= $email ?>">
                            <input type="password" name="password" placeholder="Пароль" value="<?= $password ?>">
                            <button type="submit" class="btn btn-default" name="submit">Регистрация</button>
                        </form>
                    </div> <!-- /sign up form -->

                <?php endif; ?>
                <br>
                <br>
            </div>

        </div>
    </div>
</section>



<?php include ROOT . '/views/layouts/footer.php'; ?>

