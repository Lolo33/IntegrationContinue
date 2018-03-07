<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 28/08/2017
 * Time: 19:08
 */

use CmbSdk\ClassesMetiers\UtilisateurToken;
use CmbSdk\Autoloader;
use CmbSdk\CmbApi;
use CmbSdk\Exceptions\ReponseException;

include "includes/init.php";
include "CmbSdk/Autoloader.php";

Autoloader::registerRacine();

$CmbApi = new CmbApi(true, "ZwbyKi5TGaXT5q9tflMO73iXxHyrE0XNuZJiRC61pmW49rCA3WeAfqx9NpilI2jx6iw=");

$session_token = new UtilisateurToken();
if (!estConnecte())
    header("Location: api_connexion");
else
    $session_token = unserialize($_SESSION["token"]);

?>

<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.php"; ?>
    <title>ConnectMyBooking API (<?php echo $nomSite ?>) - Obtenir une clé d'API</title>
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
            <a class="navbar-brand" href="index"><?php echo $nomSite; ?></a>
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
        <div class="col-lg-9 cont-tool espace-top">
            <div id="contenu-doc" class="espace-top">

                <h4 class="titre-gerer">Informations de compte</h4>
                <div class="conteneur-light">
                    <div class="row">
                        <div class="espace-top col-lg-12 new-line-info-api">
                            <div class="titre-info-api">Identifiant Client:</div>
                            <div class="info-api"><strong><?php echo $session_token->getApiUser()->getUserClientId(); ?></strong></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 new-line-info-api">
                            <div class="titre-info-api">Date de création:</div>
                            <div class="info-api">
                                <?php
                                    $date = new DateTime($session_token->getCreatedAt());
                                    echo "Le " . $date->format("d-m-Y") . " à " . $date->format("H:i:s");
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="espace-bot col-lg-12 new-line-info-api">
                            <div class="titre-info-api">Clé d'API:</div>
                            <div class="info-api">
                                <input id="input-api-key" class="form-control" type="text" style="display: inline-block; margin-right: 30px;" readonly="" value="<?php echo $session_token->getValue(); ?>" />
                                <button class="btn btn-primary disabled">Obtenir une nouvelle clé d'API</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-zone margin-gerer">
                </div>


               <h4 class="titre-gerer"  style="margin-top: 40px;">Statistiques</h4>
                <div class="conteneur-light">
                    <?php try {
                        $listeReservations = $CmbApi->ReservationsAction->GetAll();
                        ?>
                        <div class="row new-line-info-api">
                            <div class="col-lg-6 ">
                                <div class="titre-info-api">Réservations totales:</div>
                                <div class="info-api">
                                    <strong><?php echo count($listeReservations); ?></strong>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="titre-info-api">Dernière réservation:</div>
                                <div class="info-api">
                                    <strong><?php echo $listeReservations[count($listeReservations)-1]->getReference(); ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="row new-line-info-api">
                            <div class="col-lg-6">
                                <div class="titre-info-api">Réservations ce mois:</div>
                                <div class="info-api"><strong></strong></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="titre-info-api">Réservations cette année:</div>
                                <div class="info-api"><strong></strong></div>
                            </div>
                        </div>
                    <?php }catch(ReponseException $e){
                        echo "Erreur de réponse HTTP: " . $e->getReponse() . "<br />" .
                            "Message : " . $e->getMessage();
                    } ?>
                </div>

            </div>
        </div>


    </div>
</div>

<script>
    $("#input-api-key").click(function () {
        document.getElementById("input-api-key").removeAttribute('readonly');
        SelectText("input-api-key");
    }).blur(function(){
        document.getElementById("input-api-key").setAttribute("readonly", "readonly");
    });

    function SelectText(element) {
        var doc = document
            , text = doc.getElementById(element)
            , range, selection
        ;
        if (doc.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(text);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();
            range = document.createRange();
            range.selectNodeContents(text);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    }

    document.onclick = function(e) {
        if (e.target.className === 'click') {
            SelectText('selectme');
        }
    };
</script>

<?php include 'includes/script_bas_page.php'; ?>

</body>
</html>
