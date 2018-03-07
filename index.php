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

<div id="cache"><h2 id="logo-spinner">ConnectMyBooking API</h2><div id="spinner"></div></div>
<!-- NAVBAR -->
<nav class="navbar navbar-default" style="margin: 0 0 0 20%;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $nomSite; ?></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Débuter</a></li>
                <li><a href="complexes">Documentation </a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Saisir un mot clé...">
                </div>
                <button type="submit" class="btn btn-default">Rechercher</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php if (estConnecte()){
                    $token = unserialize($_SESSION["token"]);
                ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span> <?php echo $token->getApiUser()->getUserClientId(); ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="api_gestion">Mon Compte</a></li>
                            <li class="divider"></li>
                            <li><a href="api_deconnexion">Déconnexion</a></li>
                        </ul>
                    </li>
                <?php }else{ ?>
                    <li><a href="api_connexion"><span class="glyphicon glyphicon-user"></span>  S'identifier</a> </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3 nav-tool">
            <h2 class="titre-menu">Navigation</h2>
            <?php include 'includes/head_navigation.php'; ?>
            <h4 class="nav-titre">Documentation</h4>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="debuter">Débuter avec CMB-API</a></li>
                <li><a href="complexes">Complexes</a></li>
                <li><a href="coordonnees">Coordonnees</a></li>
                <li><a href="plages-horaires">PlagesHoraires</a></li>
                <li><a href="plages-horaires-statut">PlagesHorairesStatuts</a></li>
                <li><a href="planning-tarifs">PlanningTarifs</a></li>
                <li><a href="planning-comissions">PlanningComissions</a></li>
                <li><a href="reservations">Reservations</a></li>
                <li><a href="terrains">Terrains</a></li>
                <li><a href="terrains-type">TerrainTypes</a></li>
            </ul>
        </div>

        <!-- Contenu de la page -->
        <div class="col-lg-9 cont-tool">
            <div id="contenu-doc">

                <h1 class="text-center titre-section espace-bot">Bienvenue sur l'API ConnectMyBooking</h1>
                <div class="liens-accueil text-center espace-top" style="margin: 10px 50px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="downloads/CmbSdk.rar">
                                <img src="img/dl.png" width="70" class="img-rounded img-index" /><br />
                                <span class="glyphicon glyphicon-download-alt"></span> Telecharger le SDK
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="debuter">
                                <img src="img/settings.png" width="70" class="img-rounded img-index" /><br />
                                <span class="glyphicon glyphicon-lock"></span> Configuration / Installation
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="complexes">
                                <img src="img/lire.png" width="70" class="img-rounded img-index" /><br />
                                <span class="glyphicon glyphicon-book"></span> Lire la documentation
                            </a>
                        </div>
                    </div>
                    <div class="row liens-accueil-new-line">
                        <?php if (!estConnecte()){ ?>
                            <div class="col-lg-4">
                                <a href="api_connexion">
                                    <img src="img/carte_id.png" width="70" class="img-rounded img-index"><br />
                                    <span class="glyphicon glyphicon-user"></span> S'identifier
                                </a>
                            </div>
                        <?php }else{ ?>
                            <div class="col-lg-4">
                                <a href="api_gestion.php">
                                    <img src="img/carte_id.png" width="70" class="img-rounded img-index"><br />
                                    <span class="glyphicon glyphicon-user"></span> Tableau de bord
                                </a>
                            </div>
                        <?php } ?>
                        <div class="col-lg-4">
                            <a href="confidentialite">
                                <img src="img/secu.png" width="70" class="img-rounded img-index" /><br />
                                <span class="glyphicon glyphicon-lock"></span> Sécurité / Confidentialité
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <?php if (!estConnecte()){ ?>
                                <a href="api_inscription">
                                    <img src="img/cle.png" width="70" class="img-rounded img-index" /><br />
                                    <span class="glyphicon glyphicon-user"></span> Obtenir une clé d'API
                                </a>
                            <?php }else{ ?>
                                <a class="deco" href="api_deconnexion">
                                    <img src="img/deconnect.png" width="70" class="img-rounded img-index" /><br />
                                    <span class="glyphicon glyphicon-user"></span> Se déconnecter
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>
</div>

<script>
    $("#form-inscription").submit(function (e) {
        e.preventDefault();
        var client_id = $("#client_id").val();
        var pass = $("#pass").val();
        var nomSociete = $("#nomSociete").val();
        var adresseL1 = $("#adresseL1").val();
        var adresseL2 = $("#adresseL2").val();
        var codePostal = $("#codePostal").val();
        var ville = $("#ville").val();
        var mail = $("#mail").val();
        var telephone = $("#telephone").val();
        $.post("ajax/inscription_traitement.php", {nomSociete:nomSociete, client_id:client_id, pass:pass, adresseL1:adresseL1, adresseL2:adresseL2, codePostal:codePostal, ville:ville, mail:mail, telephone:telephone}, function(data){
            $("#erreur-inscription").html(data).slideDown();
        });
    })
</script>
<?php include 'includes/script_bas_page.php'; ?>
</body>
</html>
