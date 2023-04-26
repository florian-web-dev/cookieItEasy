<?php $title = 'Dashboard Admin'; ?>

<?php ob_start(); ?>
<div class="container">
    <h1>Dashboard</h1>

    <div class="row">
        <hr>
        <div class="m-2 d-flex justify-content-evenly align-items-center">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z" />
                </svg>
            </div>
            <div>
                <p class="m-0">Bonjours, <?= $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?> </p>
            </div>
        </div>
        <hr>
        <div class="m-4 p-4 border border-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
            </svg>
            <h2 class="text-center text-decoration-underline">Mode d'emploi</h2>
            <div class="p-3 fs-4">
                <p>Lorsque vous ajoutez un produit, le nom de l'image doit être le même que celui du produit.</p>
                <p>Lorsque vous ajoutez une catégorie le nom de l'image dans le dossier header doit être le même que le nom de pas catégorie </p>
                <p>PS : attention aux majuscules</p>
            </div>

        </div>


        <div class="col-lg-4 col-md-5 col-12">
            <h2>Gestion des articles</h2>
            <a class="btn btn-info my-2" href="?path=admin&action=formAjoutArticle">Ajouter un articles</a>
            <br>
            <a class="btn btn-info my-2" href="?path=admin&action=adminArticle">Gèrer les articles</a>
        </div>

        <div class="col-lg-4 col-md-5 col-12">
            <h2>Gestion des categories</h2>
            <a class="btn btn-danger my-2" href="?path=admin&action=gereCategorie">Gèrer les categories</a>
        </div>
        <div class="col-lg-4 col-md-5 col-12">
            <h2>Gestion des utilisateurs</h2>
            <a class="btn btn-danger my-2" href="?path=admin&action=modiCommande">Gèrer les commandes</a>
        </div>

        <div class="col-lg-4 col-md-5 col-12">
            <h2>Gestion des utilisateurs</h2>
            <!-- <a class="btn btn-danger my-2" href="#">Gèrer les admins</a>
            <br> -->
            <a class="btn btn-danger my-2" href="?path=admin&action=client">Les clients</a>
        </div>


    </div>
    <br>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/admin/admin-template.php'); ?>