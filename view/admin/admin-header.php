<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $title; ?></title>
    <link href="view/admin/asset/style.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
    <link href="view\admin\asset\boot.css" rel="stylesheet" />
    <link rel='icon' type="image/svg" href="public\img\logo\logo-onglet.png">
    <script src="view/admin/asset/font-awesome.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> -->
</head>

<script>
    setInterval(function() {
        document.querySelector("#date").innerText = new Date().toLocaleString()
    }, 500)
</script>

<body class="sb-nav-fixed bg-dark text-light">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->

        <p id="date" class="text-light m-4 w-12"></p>


        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <a class="navbar-brand ps-3" href="index.php">
            <h3 class="text-center">Accueil site</h3>
        </a>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                    <li><a class="dropdown-item" href="./?path=main&action=logout">Se deconnecter</a></li>
                </ul>
            </li>
        </ul>


    </nav>