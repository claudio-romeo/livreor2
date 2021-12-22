<?php
require "bdd.php";

require_once 'class/message.php';
require_once 'class/guestbook.php';
$errors = null;
if (isset($_POST['username'], $_POST['message'])) {
    $message = new Message($_POST['username'], $_POST['message']);
    if ($message->isValid()) 
    {
        $guestbook = new guestbook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
        $guestbook-> addmessage($message);

    } else {
        $errors = $message->getErrors();
    }
}

var_dump($errors);

$title = "Livre d'or";

require 'header.php';

?>

<div class="container">
    <h1>Livre d'or</h1>

    <?php if (!empty($errors)) : ?>

        <div class="alert alert-danger">
            Formulaire invalide
        </div>
    <?php endif ?>


    <form action="" method="post">
        <div class="form-groupe">
            <input value="<?= htmlentities($_POST['username'] ?? '')?>" type="text" name="username" placeholder="Votre pseudo" class="form-control  <?= isset($errors['username']) ? 'is-invalid' :'' ?>">
            <?php if (isset($errors['username'])) : ?>
                <div class="invalide-feedback"><?= $errors['username'] ?></div>
            <?php endif ?>
        </div>
        <div class="form-group">
            <textarea name="message" placeholder="Votre message" class="form-control <?= isset($errors['message']) ? 'is-invalid' :'' ?> " value="<?= htmlentities($_POST['message'] ?? '')?>" rows="5" ></textarea>
            <?php if (isset($errors['message'])) : ?>
                <div class="invalide-feedback"><?= $errors['message'] ?></div>
            <?php endif ?>
        </div>

        <button class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php

require 'footer.php';

?>