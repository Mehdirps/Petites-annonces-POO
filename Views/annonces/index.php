<h1>Listes des annonces</h1>
<a href="/annonces/add">Ajouter une annonce</a>
<?php foreach ($annonces as $annonce) : ?>

    <article>
        <h2><a href="/annonces/view/<?= $annonce->id ?>"><?= $annonce->title ?></a></h2>
        <p><?= $annonce->description ?></p>
    </article>

<?php endforeach; ?>