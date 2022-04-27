<H1>Modifier l'annonce !</H1>
<?php
if (!empty($_SESSION['message'])) :
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>
<?= $formModify;
?>