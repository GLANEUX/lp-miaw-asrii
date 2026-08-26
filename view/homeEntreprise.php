<!-- Affiche l'espace entreprise -->
<!-- Accessible uniquement pour les Entreprises -->
<!-- Accessible sur /home (Connecté en entreprise) -->

<section class="bg-custom-grey p-4 pb-0">
    <div class=" py-2 px-3 rounded bg-white">
        <h2>Bienvenue - <?= e($data['nom']) ?></h2>
    </div>
</section>
<section class="bg-custom-grey px-5 py-3">

    <div class="row g-5 py-2">
        <div class="col-6">
            <div class="text-right py-3">
                <a href="<?= URL ?>/projets/add"
                    class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter un Projet</a>
                <a  class="see"> -</a>
                <a href="<?= URL ?>/projets/list"  class="see">Voir tous</a>

            </div>
            <div class="bg-custom-black p-2 text-white">Projets tuteuré</div>
            <div class="bg-white p-3">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>

                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['projets'] as $projet) { ?>
                            <tr>
                                <td>
                                    <?= e($projet['titre']) ?>
                                </td>
                                <td>
                                    <pre><?= e($projet['description']) ?></pre>
                                </td>

                                <td>
                                    <a href="<?= URL ?>/projets/edit?id=<?= e($projet['id']) ?>"
                                        class="btn btn-primary btn-sm">Modifier</a>
                                    <a href="<?= URL ?>/projets/delete?id=<?= e($projet['id']) ?>"
                                        class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div class="text-right py-3">
                <a href="<?= URL ?>/offres/add" class="bg-custom-purple txt-color-black button-font py-2 px-3 rounded">Ajouter une
                    offre</a>     
                    <a  class="see"> -</a>
                <a href="<?= URL ?>/offres" class="see">Voir tous</a>
            </div>
            <div class="bg-custom-black p-2 text-white">Offre d'alternance</div>
            <div class="bg-white p-3">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['alternances'] as $alternances) { ?>
                            <tr>
                                <td>
                                    <?= e($alternances['poste']) ?>
                                </td>
                                <td>
                                    <pre><?= e($alternances['description']) ?></pre>
                                </td>

                                <td>
                                    <a href="<?= URL ?>/offres/edit?id=<?= e($alternances['id']) ?>"
                                        class="btn btn-primary btn-sm">Modifier</a>
                                    <a href="<?= URL ?>/offres/delete?id=<?= e($alternances['id']) ?>"
                                    class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</section>
