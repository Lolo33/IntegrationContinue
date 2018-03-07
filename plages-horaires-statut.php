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
    <title>Plage Horaires Statuts - <?php echo $nomSite; ?> - Documentation</title>
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
                <li class="active">
                    <a href="plages-horaires-statut">PlagesHorairesStatuts <span class="caret"></span></a>
                    <ul class="sous-menu">
                        <li id="structure-item" class="sous-menu-item sous-menu-item-active"><a href="#structure">Structure de l'objet</a></li>
                    </ul>
                </li>

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
                    <h3 class="titre-section">Structure d'un objet PlageHoraireStatut</h3>
                    <div class="obj-description">
                        Un objet PlageHoraireStatut représente le statut d'une plage horaire,
                        c'est à dire les différents états dans lesquels peut se retrouver la plage horaire.
                        Pour qu'une plage horaires soit reservable, il faut que son statut soit : "Libre"  (statut 2).
                    </div>
                    <br />
                    Un objet PlageHoraireStatut est constitué comme suit :
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
                                <td>StatutNom</td>
                                <td>String</td>
                                <td></td>
                                <td>Libéllé du statut</td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        Statuts de plages horaires qui existent actuellement :
                        <ul class="pager text-left" style="text-align: left;">
                            <li style="display: block;"><a class="pager--not-link">1 - Disponible</a> <- La plage horaire est disponible à la réservation.</li>
                            <li style="display: block;"><a class="pager--not-link">2 - Non Disponible</a> <- La plage horaire est fermée à la réservation par le complexe </li>
                            <li style="display: block;"><a class="pager--not-link">3 - Réservé</a> <- La plage horaire est ouverte mais déja réservée.</li>

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
