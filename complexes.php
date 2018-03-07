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
    <title>Complexes - <?php echo $nomSite; ?> - Documentation</title>
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
                    <li class="active">
                        <a href="#">Complexes <span class="caret"></span></a>
                        <ul class="sous-menu">
                            <li id="structure-item" class="sous-menu-item sous-menu-item-active"><a href="#structure">Structure de l'objet</a></li>
                            <li id="recup-item" class="sous-menu-item"><a href="#recup-liste">Récupérer la liste des complexes</a></li>
                            <li id="recup-one-item" class="sous-menu-item"><a href="#recup-one">Récupérer un complexe</a></li>
                        </ul>
                    </li>
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


                    <section id="structure">
                    <h3 class="titre-section">Structure d'un objet Complexe</h3>
                        Un objet complexe correspond à un de nos complexes sportifs partenaires, proposant du soccer/futsal en France.
                        Les complexes ayant auxquels nous sommes associés remplissent en temps réel leurs planning, et valident chacune de vos réservations.<br /><br />
                        Voici comment est constitué un complexe :
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
                                    <td>Identifiant du complexe</td>
                                </tr>
                                <tr class="active">
                                    <td>Nom</td>
                                    <td>String</td>
                                    <td>Nom complet du complexe</td>
                                </tr>
                                <tr class="active">
                                    <td>Coordonnees</td>
                                    <td>
                                        <a data-descr="Objet coordonnées: cliquez pour voir les propriétés de l'objet"
                                           href="coordonnees" target="_blank">Coordonnee</a>
                                    </td>
                                    <td>Coordonnées pour joindre le complexe</td>
                                </tr>
                                <tr class="active">
                                    <td>ListeTerrains</td>
                                    <td>
                                        <a data-descr="Liste d'objets Terrains (ArrayCollection):
                                    cliquez pour voir les propriétés de l'objet" href="terrains" target="_blank">Terrains[]</a>
                                    </td>
                                    <td>Liste des terrains que comporte le complexe</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>


                    <section id="recup-liste"  class="section-doc" >
                        <h3 class="titre-section">Récupèrer la liste des complexes</h3>

                        <div class="requete-description">
                            Pour récupérer la liste de tous les complexes partenaires, et leurs terrains, horaires, tarifs, comissions...
                            il suffit d'envoyer une requete HTTP de type GET sur l'url %api_url%/complexes. Le format de données renvoyée est le JSON.
                        </div>

                        <div class="col-md-2 method">
                            <h4 class="methode-http methode-get">GET</h4>
                        </div>
                        <div class="col-md-10 method">
                            <h4 class="url">... /complexes</h4>
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

    // Récupère un tableau de tous les complexes
    $Complexes = $CmdApi->ComplexesAction->GetAll();

     // Parcours le tableau de complexes
    foreach ($Complexes as $unComplexe) {
        // TODO : Actions sur les complexes
        // ...
    }

}catch(\CmbSdk\Exceptions\ReponseException ex){
    echo "Erreur de réponse HTTP: " .
    $e->getReponse() . "&lt;br />" .
    "Message : " . $e->getMessage();
}



?&gt;

                                            </pre></code>
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
        "nom": "Offside",
        "coordonnees": {
            "id": 2,
            "adresseLigne1": "14 rue de la Canave",
            "adresseLigne2": null,
            "ville": "Martillac",
            "codePostal": "33640"
            "mail": "contact@offside33.fr",
            "telephone": "0556728992"
        },
        "listeTerrains": [
            {
                "id": 1,
                "nom": "Terrain Intérieur 1",
                ...
            }
            ...
        ]
    },
    {
        "id": 2,
        "nom": "Foot Factory",
        ...
    },
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



                    <section class="section-doc" id="recup-one">
                        <h3 class="titre-section">Récupèrer un complexe</h3>

                        <div class="requete-description">
                            Pour récupérer un complexe partenaire, et ses terrains, horaires, tarifs, comissions...
                            il suffit d'envoyer une requete HTTP de type GET sur l'url %api_url%/complexes/{id} ou {id} est l'identifiant du complexe que vous souhaitez récuperer.
                            Le format de données renvoyée est le JSON.
                        </div>

                        <div class="col-md-2 method">
                            <h4 class="methode-http methode-get">GET</h4>
                        </div>
                        <div class="col-md-10 method">
                            <h4 class="url">... /complexes/{id}</h4>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="example">Exemple de code : </div>
                                <div class="select-langage">
                                    <ul class="nav nav-tabs">
                                        <li class="code-select active" style="width: 25%;"><a href="#php-recup-one" data-toggle="tab" aria-expanded="false">PHP</a></li>
                                        <li class="code-select disabled" style="width: 25%;"><a>Javascript</a></li>
                                        <li class="code-select disabled" style="width: 25%;"><a>.NET</a></li>
                                        <li class="code-select disabled" style="width: 25%;"><a>Java</a></li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content tab-code">
                                        <div class="tab-pane fade active in" id="php-recup-one">
                                            <pre><code class="code php">
&lt;php

include 'CmbSdk/Autoloader.php';

// On instancie la classe CmbApi avec la clé d'API
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // On récupère un objet Complexe par son id
    $Complexe = $CmdApi->ComplexesAction->Get("ID");

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
                                            <div class="code">
                                                fzejzieozjez
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="example">Exemple de réponse</div>
                                <div class="select-langage">
                                    <ul class="nav nav-tabs">
                                        <li class="code-select active" style="width: 25%;"><a href="#json-recup-one" data-toggle="tab" aria-expanded="false">JSON</a></li>
                                        <li class="code-select disabled" style="width: 25%;"><a>XML</a></li>
                                        <li class="code-select disabled" style="width: 25%;"><a>HTML</a></li>
                                        <li class="code-select disabled" style="width: 25%;"><a>YML</a></li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content tab-code">
                                        <div class="tab-pane fade active in" id="json-recup-one">
                                            <pre><code class="code json">
{
    "id": 1,
    "nom": "Offside",
    "coordonnees": {
        "id": 2,
        "adresseLigne1": "14 rue de la Canave",
        "adresseLigne2": null,
        "ville": "Martillac",
        "codePostal": "33640"
        "mail": "contact@offside33.fr",
        "telephone": "0556728992"
    },
    "listeTerrains": [
        {
            "id": 1,
            "nom": "Terrain Intérieur 1",
            ...
        }
        ...
    ]
}
                                        </code></pre>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <div class="code">
                                                fzejzieozjez
                                            </div>
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
