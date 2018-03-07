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
    <title>Terrains Types - <?php echo $nomSite; ?> - Documentation</title>
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
                <li><a href="coordonnees">Coordonnees</a></li>
                <li><a href="plages-horaires">PlagesHoraires</a></li>
                <li><a href="plages-horaires-statut">PlagesHorairesStatuts</a></li>

                <li><a href="planning-tarifs">PlanningTarifs</a></li>
                <li><a href="planning-comissions">PlanningComissions</a></li>
                <li><a href="reservations">Reservations</a></li>
                <li><a href="terrains">Terrains</a></li>
                <li class="active">
                    <a href="terrains-type">TerrainTypes <span class="caret"></span></a>
                    <ul class="sous-menu">
                        <li id="structure-item" class="sous-menu-item sous-menu-item-active">
                            <a href="#structure">Structure de l'objet</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Contenu de la page -->
        <div class="col-lg-9 cont-tool">
            <div id="contenu-doc">


                <section id="structure">
                    <h3 class="titre-section">Structure d'un objet TerrainType</h3>
                    <div class="obj-description">
                        Un objet TerrainType représente un des types de terrains que vous pouvez trouver dans n'importe quel complexe.
                        Les types indiquent ainsi le nombre de joueurs qu'il peut accueillir ainsi que sa position dans le complexe (Extérieur / Interieur).
                    </div>
                    <br />
                    Un objet TerrainType est constitué comme suit :
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
                            <td>TypeNom</td>
                            <td>String</td>
                            <td></td>
                            <td>Libéllé du type</td>
                        </tr>
                        </tbody>
                    </table>

                    <div>
                        Les types de terrains qui existent actuellement :
                        <ul class="pager" style="text-align: left;">
                            <li style="display: block;"><a class="pager--not-link">1 - 5x5 Intérieur</a> <- Terrains pouvant accueillir jusqu'a 10 personnes en Intérieur</li>
                            <li style="display: block;"><a class="pager--not-link">2 - 5x5 Exterieur</a><- Terrains pouvant accueillir jusqu'a 10 personnes en Extérieur</li>
                            <li style="display: block;"><a class="pager--not-link">3 - 4x4 Intérieur</a><- Terrains pouvant accueillir jusqu'a 8 personnes en Intérieur</li>
                            <li style="display: block;"><a class="pager--not-link">4 - 4x4 Extérieur</a><- Terrains pouvant accueillir jusqu'a 8 personnes en Extérieur</li>
                        </ul>
                    </div>

                </section>


            </div>


        </div>

    </div>
</div>

<script src="js/script.js"></script>
<?php include 'includes/script_bas_page.php'; ?>
</body>
</html>
