<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 28/08/2017
 * Time: 19:08
 */
include "includes/init.php";
include "CmbSdk/Autoloader.php";

\CmbSdk\Autoloader::registerRacine();
$token = new \CmbSdk\ClassesMetiers\UtilisateurToken();

?>

<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.php"; ?>
    <title>ConnectMyBooking API (<?php echo $nomSite ?>) - Récupère les horaires de nombreux complexes sportifs en France</title>
</head>

<body>

<!--     <style>
        #mon-menu {
            width: 300px;
            position: fixed;
            background: red;
            height: 100%;
            overflow: auto;
            left: 0;
        }
        #mon-contenu {
            margin-left: 300px;
            background: blue;
        }
    </style>
   <div id="mon-menu">
        Menu
    </div>
    <div id="mon-contenu">
        Contenu
    </div> -->
<style>
    #mon-menu {
        background: red;
        height: 900px;
    }
    #mon-contenu {
        background: blue;
    }
</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3" id="mon-menu">
                Menu
            </div>
            <div class="col-md-9" id="mon-contenu">
                Contenu
                <div class="row">
                    <div class="col-lg-6">
                        News 1
                    </div>
                    <div class="col-lg-6">
                        News 2
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
