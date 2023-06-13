<!-- Liste des notes d'un étudiant -->
<!-- Accessible uniquement pour les Etudiants, Enseignants ou les Admins -->
<!-- Accessible sur /notes pour les étudiants -->
<!-- Accessible sur /notes?id=id_de_l_etudiant pour les enseignants ou admins (Il est plus simple d'aller sur /notes puis "Consulter les notes") -->

<h1> Test Notes </h1>
<table>
    <thead>
        <tr>
            <th colspan="2">Notes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['notes'] as $note) { ?>
            <tr>
                <td><?= $note['matiere'] ?></td>
                <td><?= $note['libelle'] ?></td>
                <td><?= $note['note'] ?></td>
                <td><pre><?= $note['commentaire'] ?></pre></td>
                <?php if ( ($_SESSION['level'] == 'enseignant') || ($_SESSION['level'] == 'administrateur')) { ?>
                    <td><a href="<?= URL ?>/notes/edit?id=<?= $note['idnote'] ?>"> Modifier </a></td>
                    <td><a href="<?= URL ?>/notes/delete?id=<?= $note['idnote'] ?>"> Supprimer </a></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
