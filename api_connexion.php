<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 28/08/2017
 * Time: 19:08
 */
include "includes/init.php";
include "CmbSdk/Autoloader.php";

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
                    <li class="active"><a href="api_connexion"><span class="glyphicon glyphicon-user"></span>  S'identifier</a> </li>
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
            <div id="contenu-doc" style="width: 60%; margin: auto; margin-top: 40px;">

                    <div class="form-conteneur">
                        <form class="form-horizontal" id="form-connexion">
                            <fieldset>
                                <legend>S'identifier sur ConnectMyBooking</legend>
                                <div id="erreur-connexion"></div>
                                <input type="text" class="form-control" id="inputClientIdCo" placeholder="Identifiant Client">
                                <input type="password" class="form-control" id="inputPasswordCo" placeholder="Mot de passe">
                                 <div class="col-lg-6" style="margin: 15px 0;">
                                    <a href="api_inscription">Pas encore de compte ?</a>
                                </div>
                                <div class="col-lg-6" style="text-align: right; margin: 15px 0;">
                                    <a href="newpass">Mot de passe oublié ?</a>
                                </div>
                                <div class="btn-zone">
                                    <button type="reset" class="btn btn-default">Annuler</button>
                                    <button type="submit" class="btn btn-success">Accéder à mon compte</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>

            </div>
        </div>


    </div>
</div>

<script>
    $("#form-connexion").submit(function (e) {
        e.preventDefault();
        var client_id = $("#inputClientIdCo").val();
        var pass = $("#inputPasswordCo").val();
        $.post("ajax/connexion_traitement.php", {client_id:client_id, pass:pass}, function (data) {
            $("#erreur-connexion").html(data).slideDown();
        });
    });
</script>
<?php include 'includes/script_bas_page.php'; ?>
</body>
</html>

