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
    <title>Terrains - <?php echo $nomSite; ?> - Documentation</title>
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
                    <li class="active">
                        <a href="terrains.php">Terrains <span class="caret"></span></a>
                        <ul class="sous-menu">
                            <li id="structure-item" class="sous-menu-item sous-menu-item-active"><a href="#structure">Structure de l'objet</a></li>
                            <li id="recup-item" class="sous-menu-item"><a href="#recup-liste">Récupérer la liste des terrains d'un complexe</a></li>
                            <li id="recup-one-item" class="sous-menu-item"><a href="#recup-one">Récupérer un terrain</a></li>
                        </ul>
                    </li>
                    <li><a href="terrains-type">TerrainTypes</a></li>
                </ul>
            </div>

            <!-- Contenu de la page -->
            <div class="col-lg-9 cont-tool">


                <div id="contenu-doc">
                    <section id="structure">
                    <h3 class="titre-section">Structure d'un objet Terrain</h3>
                        Un objet Terrain correspond à un des terrains d'un complexe donné.<br />
                        Voici comment est constitué un terrain :
                        <br /><br>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nom de la propriété</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active">
                                    <td>Id</td>
                                    <td>Integer</td>
                                    <td>Identifiant du terrain</td>
                                </tr>
                                <tr class="active">
                                    <td>Nom</td>
                                    <td>String</td>
                                    <td>Nom complet du terrain</td>
                                </tr>
                                <tr class="active">
                                    <td>Type</td>
                                    <td><a data-descr="Objet TerrainType: cliquez pour voir les propriétés de l'objet"
                                           href="terrains-type" target="_blank">TerrainType</a></td>
                                    <td>Le type du terrain (5x5, 4x4, Interieur, Exterieur..)</td>
                                </tr>
                                <tr class="active">
                                    <td>Complexe</td>
                                    <td>
                                        <a data-descr="Objet Complexe: cliquez pour voir les propriétés de l'objet"
                                           href="complexes" target="_blank">Complexe</a>
                                    </td>
                                    <td>Le complexe dans lequel se situe le terrain</td>
                                </tr>
                                <tr class="active">
                                    <td>ListeHoraires</td>
                                    <td><a data-descr="Tableau d'objets PlageHoraire : cliquez pour voir les propriétés de l'objet"
                                           href="plages-horaires" target="_blank">PlageHoraires[]</a></td>
                                    <td>Liste des plages horaires d'un terrain</td>
                                </tr>
                                <tr class="active">
                                    <td>ListeTarifs</td>
                                    <td><a data-descr="Tableau d'objets PlanningTarif : cliquez pour voir les propriétés de l'objet"
                                           href="planning-tarifs" target="_blank">PlanningTarifs[]</a></td>
                                    <td>Liste des prix par tranches horaires d'un terrain</td>
                                </tr>
                                <tr class="active">
                                    <td>ListeComissions</td>
                                    <td><a data-descr="Tableau d'objets PlanningComission : cliquez pour voir les propriétés de l'objet"
                                           href="planning-comissions" target="_blank">PlanningComission[]</a></td>
                                    <td>Liste des comissions que vous touchez par tranches horaires d'un terrain</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>

                    <section id="recup-liste">
                        <h3 class="titre-section">Récupèrer la liste des terrains d'un complexe</h3>
                        <div class="requete-description">
                            Pour récupérer la liste de tous les terrains d'un complexe donné,
                            vous devez envoyer une requete HTTP de type GET sur l'url %api_url%/complexes/{id}/terrains, ou {id} représente l'identifiant du complexe
                            dont on souhaite récupérer les terrains. Le format de données renvoyée est le JSON.
                        </div>
                        <div class="col-md-2 method">
                            <h4 class="methode-http methode-get">GET</h4>
                        </div>
                        <div class="col-md-10 method">
                            <h4 class="url">... /complexes/{id}/terrains</h4>
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

// On instancie la classe CmbApi
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // Récupère la liste des Terrains
    $Ters = $CmdApi->TerrainsAction->GetByComplexe("ID");

    // Parcours le tableau de terrains
    foreach ($Ters as $unTerrain) {
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
        "nom": "Terrain Intérieur 1",
        "type": {
            "id": 1,
            "typeNom": "5c5 Intérieur"
        },
        "complexe": {
            "id": 1,
            "nom": "Offside",
            "coordonnees": {
                "id": 2,
                "adresseLigne1": "14 rue de la Canave",
                ...
            }
        },
        "listeHoraires": [
            {
                "id": 1,
                "heureDebut": "2017-08-23 11:00:00",
                ...
            }
            ...
        ],
        "listeTarifs": [
            {
                "id": 1,
                "montant": 60,
                ...
            }
            ...
        ],
        "listeComissions": [
            {
                "id": 1,
                "montant": 10,
                ...
            }
            ...
        ]
    }
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
                        <h3 class="titre-section">Récupèrer un terrain</h3>

                        <div class="requete-description">
                            Pour récupérer un terrain, il vous faut connaitre son identifiant (récupérable lorsque vous cherchez un complexe).
                            Avec cet id, vous pouvez interroger l'URI %api_url%/terrains/{id} - où {id} représente l'identifiant du terrain.
                        </div>

                        <div class="col-md-2 method">
                            <h4 class="methode-http methode-get">GET</h4>
                        </div>
                        <div class="col-md-10 method">
                            <h4 class="url">... /terrains/{id}</h4>
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

// On instancie la classe CmbApi avec l'URL de production
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // On récupère un objet Terrain
    $Terrain = $CmdApi->TerrainsAction->Get(ID_DU_TERRAIN);

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
    "nom": "Terrain Intérieur 1",
    "type": {
        "id": 1,
        "typeNom": "5c5 Intérieur"
    },
    "complexe": {
        "id": 1,
        "nom": "Offside",
        "coordonnees": {
            "id": 2,
            "adresseLigne1": "14 rue de la Canave",
            ...
        }
    },
    "listeHoraires": [
        {
            "id": 1,
            "heureDebut": "2017-08-23 11:00:00",
            ...
        }
        ...
    ],
    "listeTarifs": [
        {
            "id": 1,
            "montant": 60,
            ...
        }
        ...
    ],
    "listeComissions": [
        {
            "id": 1,
            "montant": 10,
            ...
        }
        ...
    ]
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
