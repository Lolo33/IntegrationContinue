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
    <title>Planning Tarifs - <?php echo $nomSite; ?> - Documentation</title>
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
                <li class="active"><a href="planning-tarifs">PlanningTarifs <span class="caret"></span></a>
                    <ul class="sous-menu">
                        <li id="structure-item" class="sous-menu-item sous-menu-item-active"><a href="#structure">Structure de l'objet</a></li>
                        <li id="recup-item" class="sous-menu-item"><a href="#recup-liste">Récupérer les tarifs d'un terrain</a></li>
                        <li id="recup-one-item" class="sous-menu-item"><a href="#recup-one">Récupérer un tarif</a></li>
                    </ul>
                </li>
                <li><a href="planning-comissions">PlanningComissions</a></li>
                <li><a href="reservations">Reservations</a></li>
                <li><a href="terrains.php">Terrains</a></li>
                <li><a href="terrains-type">TerrainTypes</a></li>
            </ul>
        </div>

        <!-- Contenu de la page -->
        <div class="col-lg-9 cont-tool">


            <div id="contenu-doc">
                <section id="structure">
                    <h3 class="titre-section">Structure d'un objet PlanningTarif</h3>
                    <div class="obj-description"> Un objet PlanningTarif associe des horaires d'un terrain (jour de la semaine et heure)
                        avec le prix de ce terrain. Dans cette version 1, les prix des terrains sont affichés en euros.
                        Des constantes sont définies pour les jours de la semaine, mais leurs valeurs sont les valeurs classiques de la propriété day of week de php
                        (0 = Dimanche, 1 = Lundi ... 6 = Samedi)</div>
                    <br /><br>
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
                            <td>Identifiant du la Plage Horaire</td>
                        </tr>
                        <tr class="active">
                            <td>Terrain</td>
                            <td>
                                <a data-descr="Objet Terrain: cliquez pour voir les propriétés de l'objet"
                                   href="terrains" target="_blank">Terrain</a>
                            </td>
                            <td></td>
                            <td>Le terrain auquel est rattachée le tarif</td>
                        </tr>
                        <tr class="active">
                            <td>Montant</td>
                            <td>float</td>
                            <td></td>
                            <td>Prix du terrain en euros (2 décimales)</td>
                        </tr>
                        <tr class="active">
                            <td>JourDeLaSemaine</td>
                            <td><a data-descr="Entier de 0 (Dimanche) à 6 (Lundi)">Integer</a></td>
                            <td></td>
                            <td>Jour de la semaine concerné par le tarif</td>
                        </tr>
                        <tr class="active">
                            <td>HeureDebut</td>
                            <td><a data-descr="String au format H:i:s">String</a></td>
                            <td></td>
                            <td>Heure à laquelle commence le tarif</td>
                        </tr>
                        <tr class="active">
                            <td>HeureFin</td>
                            <td><a data-descr="String au format H:i:s">String</a></td>
                            <td></td>
                            <td>Heure à laquelle se finit le tarif</td>
                        </tr>
                        </tbody>
                    </table>
                </section>

                <section id="recup-liste">
                    <h3 class="titre-section">Récupèrer la liste des tarifs d'un terrain</h3>
                    <div class="requete-description">
                        Pour récupérer la liste de tous les tarifs d'un terrain donné, il vous faut envoyer une requete HTTP de type GET
                        sur l'URL ùapi_url%/terrains/{id}/tarifs où %api_url% représente l'URL de l'API et {id} représente l'id du terrain duquel
                        on veut récupérer les tarifs
                    </div>
                    <div class="col-md-2 method">
                        <h4 class="methode-http methode-get">GET</h4>
                    </div>
                    <div class="col-md-10 method">
                        <h4 class="url">... /terrains/{id}/tarifs</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="example">Exemple de code</div>
                            <div class="select-langage">
                                <ul class="nav nav-tabs">
                                    <li class="code-select active" style="width: 25%;"><a href="#php-recup" data-toggle="tab" aria-expanded="false">PHP</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>Javascript</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>.NET</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>Java</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content tab-code">
                                    <div class="tab-pane fade active in" id="php-recup">
                                            <pre><code class="code php">

&lt;php

include 'CmbSdk/Autoloader.php';

// On instancie la classe CmbApi avec la clé d'API
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // Récupère la liste des tarifs d'un terrain par l'ID du terrain
    $Tarifs = $CmdApi->PlanningTarifsAction->GetAllFromTerrain($Terrain);

    // Parcours le tableau de terrains
    foreach ($Tarifs as $unTarif) {
        // TODO : Actions sur les terrains
        // ...
    }

}catch(\CmbSdk\Exceptions\ReponseException ex){
    echo "Erreur de réponse HTTP: " .
    $e->getReponse() . "&lt;br />" .
    "Message : " . $e->getMessage();
}

?&gt;

                                            </code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="profile">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="example">Exemple de réponse : </div>
                            <div class="select-langage">
                                <ul class="nav nav-tabs">
                                    <li class="code-select active" style="width: 25%;"><a href="#json-recup" data-toggle="tab" aria-expanded="false">JSON</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>XML</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>HTML</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>YML</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content tab-code">
                                    <div class="tab-pane fade active in" id="json-recup">
                                <pre><code class="code json">
[
    {
        "id": 1,
        "terrain": {
            "id": 1,
            "nom": "Terrain Intérieur 1",
            "type": {
                "id": 1,
                "typeNom": "5c5 Intérieur"
            },
            ...
        },
        "montant": 80,
        "jourDeLaSemaine": 1
        "heureDebut": "11:00:00",
        "heureFin": "12:00:00",
    },
    {
        "id": 2,
        ...
    }
    ...
]
                        </code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="java-recup-one">
                                        <pre><code>

                                            </code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>

                <section id="recup-one">
                    <h3 class="titre-section">Récupèrer un Tarif par son ID</h3>

                    <div class="requete-description">
                        Pour récupérer un PlanningTarif, il vous faut connaitre son identifiant (récupérable lorsque vous cherchez un terrain).
                        Avec cet id, vous pouvez interroger l'URI %api_url%/tarifs/{id} - où {id} représente l'identifiant du tarif.
                    </div>

                    <div class="col-md-2 method">
                        <h4 class="methode-http methode-get">GET</h4>
                    </div>
                    <div class="col-md-10 method">
                        <h4 class="url">... /tarifs/{id}</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="example">Exemple de code</div>
                            <div class="select-langage">
                                <ul class="nav nav-tabs">
                                    <li class="code-select active" style="width: 25%;"><a href="#php-recup" data-toggle="tab" aria-expanded="false">PHP</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>Javascript</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>.NET</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>Java</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content tab-code">
                                    <div class="tab-pane fade active in" id="php-recup">
                                            <pre><code class="code php">

&lt;php

include 'CmbSdk/Autoloader.php';

// On instancie la classe CmbApi avec la clé d'API
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // On récupère un objet PlanningTarif par son ID
    $Tarif = $CmdApi->PlanningTarifsAction->Get("ID");

    // ...

}catch(\CmbSdk\Exceptions\ReponseException ex){
    echo "Erreur de réponse HTTP: " .
    $e->getReponse() . "&lt;br />" .
    "Message : " . $e->getMessage();
}

?&gt;

                                                </code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="profile">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="example">Exemple de réponse : </div>
                            <div class="select-langage">
                                <ul class="nav nav-tabs">
                                    <li class="code-select active" style="width: 25%;"><a href="#json-recup" data-toggle="tab" aria-expanded="false">JSON</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>XML</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>HTML</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>YML</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content tab-code">
                                    <div class="tab-pane fade active in" id="json-recup">
                                <pre><code class="code json">
{
    "id": 1,
    "terrain": {
        "id": 1,
        "nom": "Terrain Intérieur 1",
        "type": {
            "id": 1,
            "typeNom": "5c5 Intérieur"
        },
        ...
    },
    "montant": 80,
    "jourDeLaSemaine": 1
    "heureDebut": "11:00:00",
    "heureFin": "12:00:00"
}
                                    </code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="java-recup-one">
                                        <pre><code>

                                            </code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>

            </div>
        </div>

    </div>
</div>

<script src="js/script.js"></script>
<script src="highlight/highlight.pack.js"></script>
<script src="js/coloration_syntaxique.js"></script>
<?php include 'includes/script_bas_page.php'; ?>
</body>
</html>
