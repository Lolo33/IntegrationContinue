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

if (estConnecte()){
    header("Location: api_gestion");
}
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
        <div class="col-lg-9 cont-tool">
            <div id="contenu-doc" style="width: 70%; margin: 40px auto;">

                    <div class="form-conteneur">
                        <form class="form-horizontal" id="form-inscription">
                            <fieldset>
                                <legend>Créer un compte sur le Serveur de Test</legend>
                                <div id="erreur-inscription"></div>
                                <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Identifiant Client">
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Mot de passe">
                                <input type="text" class="form-control" id="nomSociete" name="nomSociete" placeholder="Nom de la société">
                                <input type="text" class="form-control" id="adresseL1" name="adresseL1" placeholder="Adresse (ligne 1)">
                                <input type="text" class="form-control" id="adresseL2" name="adresseL2" placeholder="Adresse (ligne 2)">
                                <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="Code postal">
                                <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville">
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="Adresse e-mail">
                                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Numéro de téléphone">

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> En m'inscrivant je confirme avoir pris connaissance des
                                        <a href="conditions">conditions générales d'utilisation</a> et y adhérer sans réserve.
                                    </label>
                                </div>

                                <div class="btn-zone">
                                    <button type="reset" class="btn btn-default">Annuler</button>
                                    <button type="submit" class="btn btn-success">Obtenir une clé d'API</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>

            </div>
        </div>


    </div>
</div>

<script src="js/spinner.js"></script>
<script>

    var opts = {
        lines: 13 // The number of lines to draw
        , length: 28 // The length of each line
        , width: 14 // The line thickness
        , radius: 42 // The radius of the inner circle
        , scale: 1 // Scales overall size of the spinner
        , corners: 1 // Corner roundness (0..1)
        , color: '#f5f5f5' // #rgb or #rrggbb or array of colors
        , opacity: 0.25 // Opacity of the lines
        , rotate: 0 // The rotation offset
        , direction: 1 // 1: clockwise, -1: counterclockwise
        , speed: 1 // Rounds per second
        , trail: 60 // Afterglow percentage
        , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
        , zIndex: 2e9 // The z-index (defaults to 2000000000)
        , className: 'spinner' // The CSS class to assign to the spinner
        , top: '50%' // Top position relative to parent
        , left: '50%' // Left position relative to parent
        , shadow: false // Whether to render a shadow
        , hwaccel: false // Whether to use hardware acceleration
        , position: 'absolute' // Element positioning
    };
    var target = document.getElementById('spinner');
    var spinner = new Spinner(opts).spin(target);

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

        var $div_cache = $("#cache");
        $div_cache.show();
        var opts = {
            lines: 13 // The number of lines to draw
            , length: 28 // The length of each line
            , width: 14 // The line thickness
            , radius: 42 // The radius of the inner circle
            , scale: 1 // Scales overall size of the spinner
            , corners: 1 // Corner roundness (0..1)
            , color: '#f5f5f5' // #rgb or #rrggbb or array of colors
            , opacity: 0.25 // Opacity of the lines
            , rotate: 0 // The rotation offset
            , direction: 1 // 1: clockwise, -1: counterclockwise
            , speed: 1 // Rounds per second
            , trail: 60 // Afterglow percentage
            , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
            , zIndex: 2e9 // The z-index (defaults to 2000000000)
            , className: 'spinner' // The CSS class to assign to the spinner
            , top: '50%' // Top position relative to parent
            , left: '50%' // Left position relative to parent
            , shadow: false // Whether to render a shadow
            , hwaccel: false // Whether to use hardware acceleration
            , position: 'absolute' // Element positioning
        };
        var target = document.getElementById('spinner');
        var spinner = new Spinner(opts).spin(target);
        $.post("ajax/inscription_traitement.php", {nomSociete:nomSociete, client_id:client_id, pass:pass, adresseL1:adresseL1, adresseL2:adresseL2, codePostal:codePostal, ville:ville, mail:mail, telephone:telephone}, function(data){
            $("#erreur-inscription").html(data).slideDown();
            spinner.stop();
            $div_cache.hide();
        });
    })
</script>
<?php include 'includes/script_bas_page.php'; ?>
</body>
</html>
