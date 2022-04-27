<H1>Ajouter une annonce !</H1>
<?php
if (!empty($_SESSION['message'])) :
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>
<?= $form;
?>