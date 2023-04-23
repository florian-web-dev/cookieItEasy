<?php
$title = "Les Clients";
ob_start(); ?>

<table class="table table-dark table-hover text-center">
    <thead>
        <h2><?=$title?></h2>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">email</th>
            <th scope="col">adresse</th>
            <th scope="col">ville</th>
            <th scope="col">codePostal</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($lesClient as $client) : ?>
            <tr>
                <td><?= $client->getPrenom()  ?></td>
                <td><?= $client->getNom()  ?></td>
                <td><?= $client->getEmail()  ?></td>
                <td><?= $client->getAdresse() ?></td>
                <td><?= $client->getVille()  ?></td>
                <td><?= $client->getCodePostal()  ?></td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>





<?php
$content = ob_get_clean();

require('view/admin/admin-template.php');
?>