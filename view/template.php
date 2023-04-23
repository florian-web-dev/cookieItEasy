<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vente de Hamburger, Salade, Desserts et Boissons en livraisons">
    <meta name="keywords" content="Hamburger, Salade, Desserts, Ben & Jerry's, Boissons, Pepsi, OASIS ">
    <meta name="author" content="GAGNANT Florian">
    <!-- CSS bootstrap -->
    <link rel="stylesheet" href="public/bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/section.css">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Food Easy Home <?= $title; ?></title>
    <link rel='icon' type="image/svg" href="public\img\logo\logo-onglet.png">
</head>
<body>
    <?php include_once "public/css/header.php";?>
    
    <?php include "menu.php"; ?>

    <?php echo $content; ?>

    <?php include "footer.php"; ?>
    <!-- JS bootstrap -->
    <script src="public/bootstrap-5.0.0-beta2-dist/js/bootstrap.bundle.js"></script>
    <script src="public/js/verifForm.js"></script>
    <script src="public/js/app.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bad+Script&family=Open+Sans+Condensed:wght@700&display=swap" rel="stylesheet">
</body>
</html>