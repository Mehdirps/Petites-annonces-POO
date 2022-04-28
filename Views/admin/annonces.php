<table class="table table-striped">
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Actif</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($annonces as $annonce) : ?>
            <tr>
                <td><?= $annonce->id ?></td>
                <td><?= $annonce->title ?></td>
                <td><?= $annonce->description ?></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault<?= $annonce->id ?>"  <?= $annonce->active ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexSwitchCheckDefault<?= $annonce->id ?>"></label>
                    </div>
                </td>
                <td><a href="" class="btn btn-warning">Modifer</a><a href="" class="btn btn-danger">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>