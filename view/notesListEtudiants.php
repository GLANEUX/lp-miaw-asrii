<!-- Liste des étudiants -->
<!-- Accessible uniquement pour les Enseignants ou les Admins -->
<!-- Accessible sur /notes -->

<h1> Liste des étudiants </h1>
<table>
    <thead>
        <tr>
            <th colspan="2">Notes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['etudiants'] as $etudiant) { ?>
            <tr>
                <td><?= $etudiant['nom'] ?></td>
                <td><?= $etudiant['prenom'] ?></td>
                <td><a href="<?= URL ?>/notes?id=<?= $etudiant['id'] ?>">Consulter les notes</a></td>
                <td><a href="<?= URL ?>/notes/add?id=<?= $etudiant['id'] ?>">Ajouter une note</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
