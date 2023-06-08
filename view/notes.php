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
                <?php if ( (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'enseignant') ||
                (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && isset($_SESSION['level']) && $_SESSION['level'] == 'admin')) { ?>
                    <td><a href="<?= URL ?>/notes/edit?id=<?= $note['idnote'] ?>"> Modifier </a></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
