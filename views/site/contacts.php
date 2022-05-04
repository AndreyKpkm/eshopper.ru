<?php include ROOT . '/views/layouts/header.php' ?>


<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?= '<p>' . $page['text'] . '</p>' ?>
        </div>

        <div class="col-sm-6">

            <?php if ($result) : ?>
                <p>Сообещение отправлено! Мы ответим Вам на указанный email.</p>
            <?php else : ?>
                <?php if (isset($errors) && is_array($errors)) : ?>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li> – <?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="signup-form"> <!-- sign up form -->
                    <h2 class="title">Обратная связь</h2>
                    <p>Есть вопрос? Напишите нам</p>
                    <br>
                    <form action="#" method="post">
                        <div>
                            <label for="userEmail">Ваша почта</label>
                            <input type="email" name="userEmail" id="userEmail" placeholder="E-mail" value="<?= $userEmail ?>">
                        </div>
                        <div>
                            <label for="userText">Сообщение</label>
                            <input type="text" name="userText" id="userText" placeholder="Сообщение" value="<?= $userText ?>">
                        </div>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Отправить">
                    </form>
                </div> <!-- /sign up form -->

            <?php endif; ?>

        </div>
    </div>

    <br>
    <br>
</div>


<?php include ROOT . '/views/layouts/footer.php' ?>
