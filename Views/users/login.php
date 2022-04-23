<h1>Connexion</h1>
<?php
if (!empty($_SESSION['error'])) :
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error'];
        unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>
<a href="/users/register">Je n'ai pas de compte - Je m'inscris</a>
<?= $loginForm ?>