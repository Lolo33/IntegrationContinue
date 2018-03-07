<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 16/08/2017
 * Time: 15:10
 */
include "includes/init.php";
include "CmbSdk/Autoloader.php";

\CmbSdk\Autoloader::registerRacine();
$token = new \CmbSdk\ClassesMetiers\UtilisateurToken();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'includes/head.php'; ?>
    <title>Coordonnees - <?php echo $nomSite; ?> - Documentation</title>
</head>


<body>

<?php include 'includes/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3 nav-tool">
            <h2 class="titre-menu">Navigation</h2>
            <?php include 'includes/head_navigation.php'; ?>
            <h4 class="nav-titre">Documentation</h4>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="debuter">Débuter avec CMB-API</a></li>
                <li><a href="complexes">Complexes</a></li>
                <li class="active">
                    <a href="coordonnees">Coordonnees <span class="caret"></span></a>
                    <ul class="sous-menu">
                        <li id="structure-item" class="sous-menu-item sous-menu-item-active"><a href="#structure">Structure de l'objet</a></li>
                    </ul>
                </li>
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


                <section id="structure">
                    <h3 class="titre-section">Structure d'un objet Coordonnee</h3>
                    Un objet Coordonnee rassemble les informations de localisation et de contacts d'un autre objet.
                    Par exemple, un objet Coordonnee est utilisé par un objet complexe pour stocker ses informations.<br /><br />
                    Voici comment est constitué un objet de type Coordonnee :
                    <br /><br />
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Nom de la propriété</th>
                            <th>Type</th>
                            <th></th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <td>Id</td>
                            <td>Integer</td>
                            <td></td>
                            <td>Identifiant de l'objet coordonnée</td>
                        </tr>
                        <tr class="active">
                            <td>AdresseLigne1</td>
                            <td>String</td>
                            <td></td>
                            <td>Première ligne de l'adresse postale (numéro, rue/avenue...)</td>
                        </tr>
                        <tr class="active">
                            <td>AdresseLigne2</td>
                            <td>String</td>
                            <td>Nullable</td>
                            <td>Deuxième ligne de l'adresse postale (résidence, appartement, interphone...)</td>
                        </tr>
                        <tr class="active">
                            <td>Code postal</td>
                            <td>String</td>
                            <td></td>
                            <td>Code postal / Code région</td>
                        </tr>
                        <tr class="active">
                            <td>Ville</td>
                            <td>String</td>
                            <td></td>
                            <td>Ville de résidence</td>
                        </tr>
                        <tr class="active">
                            <td>Mail</td>
                            <td>String</td>
                            <td></td>
                            <td>Adresse de courrier électronique (courriel)</td>
                        </tr>
                        <tr class="active">
                            <td>Telephone</td>
                            <td>String</td>
                            <td></td>
                            <td>Numéro de télephone</td>
                        </tr>

                        </tbody>
                    </table>
                </section>


            </div>


        </div>

    </div>
</div>

<script src="js/script.js"></script>
<?php include 'includes/script_bas_page.php'; ?>
</body>
</html>
