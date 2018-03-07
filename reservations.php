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
    <title>Reservations - <?php echo $nomSite; ?> - Documentation</title>
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
                <li><a href="#">Complexes</a></li>
                <li><a href="coordonnees">Coordonnees</a></li>
                <li><a href="plages-horaires">PlagesHoraires</a></li>
                <li><a href="plages-horaires-statut">PlagesHorairesStatuts</a></li>
                <li><a href="planning-tarifs">PlanningTarifs</a></li>
                <li><a href="planning-comissions">PlanningComissions</a></li>
                <li class="active"><a href="reservations">Reservations <span class="caret"></span></a>
                    <ul class="sous-menu">
                        <li id="structure-item" class="sous-menu-item sous-menu-item-active"><a href="#structure">Structure de l'objet</a></li>
                        <li id="creer-item" class="sous-menu-item"><a href="#creer">Créer une réservation</a></li>
                        <li id="delete-item" class="sous-menu-item"><a href="#delete">Supprimer une réservation</a></li>
                        <li id="recup-item" class="sous-menu-item"><a href="#recup-liste">Récupérer la liste de vos réservations</a></li>
                        <li id="recup-one-item" class="sous-menu-item"><a href="#recup-one">Récupérer une réservation</a></li>
                    </ul>
                </li>
                <li><a href="terrains">Terrains</a></li>
                <li><a href="terrains-type">TerrainTypes</a></li>
            </ul>
        </div>

        <!-- Contenu de la page -->
        <div class="col-lg-9 cont-tool">
            <div id="contenu-doc">

                <section id="structure">
                    <h3 class="titre-section">Structure d'un objet Reservation</h3>
                    Un objet complexe correspond à un de nos complexes sportifs partenaires, proposant du soccer/futsal en France.
                    Les complexes ayant auxquels nous sommes associés remplissent en temps réel leurs planning, et valident chacune de vos réservations.<br /><br />
                    Voici comment est constitué une réservation :
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
                            <td>Identifiant du complexe</td>
                        </tr>
                        <tr class="active">
                            <td>NomClient</td>
                            <td>String</td>
                            <td>Requis</td>
                            <td>Nom complet du complexe</td>
                        </tr>
                        <tr class="active">
                            <td>Réference</td>
                            <td>String</td>
                            <td></td>
                            <td>Numéro de réference de la réservation, généré automatiquement</td>
                        </tr>
                        <tr class="active">
                            <td>PlageHoraire</td>
                            <td>
                                <a data-descr="Objet PlageHoraire:
                                    cliquez pour voir les propriétés de l'objet" href="plages-horaires" target="_blank">PlageHoraire</a>
                            </td>
                            <td>Requis</td>
                            <td>La plage horaire qui est réservée</td>
                        </tr>
                        </tbody>
                    </table>
                </section>

                <section id="creer">
                    <h3 class="titre-section">Créer une réservation</h3>

                    <div class="requete-description">
                        Pour réserver une plage horaire sur un des terrains de nos complexes partenaires, il vous faut envoyer une requête POST
                        sur l'url %api_url%/reservations avec les paramètres énumérés ci-dessous.
                        Lors de la création d'une réservation, vous pouvez choisir une plage horaire déja établie (comme dans l'exemple),
                        ce qui implique que la réservation s'étalera sur toute la plage horaire, ou d'en créer une nouvelle via un objet
                        <a href="plages-horaires">PlageHoraire</a> en veillant à bien renseigner ses HeureDebut, HeureFin et Terrain.
                    </div>

                    <div class="col-md-2 method">
                        <h4 class="methode-http methode-post">POST</h4>
                    </div>
                    <div class="col-md-10 method">
                        <h4 class="url">... /reservations</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="example">Exemple de création d'une réservation :</div>
                            <div class="select-langage">
                                <ul class="nav nav-tabs">
                                    <li class="code-select active" style="width: 25%;"><a href="#php-creer" data-toggle="tab" aria-expanded="false">PHP</a></li>
                                    <li class="code-select" style="width: 25%;"><a href="#json-creer"  data-toggle="tab" aria-expanded="false">JSON</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>.NET</a></li>
                                    <li class="code-select disabled" style="width: 25%;"><a>Java</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content tab-code">
                                    <div class="tab-pane fade active in" id="php-creer">
                                            <pre><code class="code php">
&lt;?php

include 'CmbSdk/Autoloader.php';

// On instancie la classe CmbApi avec la clé d'API
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // Création d'une Reservation
    $Reserv = new Reservation();
    // plage horaire sur laquelle réserver
    $Hor = $CmbApi->PlageHorairesAction->Get(1);
    // Attribution des valeurs de la réservation
    $Reserv->setPlageHoraire($Hor);
    $Reserv->setNomClient("Mickael Lambda");
    $Reserv->setTelephoneClient("0654789856");
    // Ajout de la réservation
    $CmbApi->ReservationsAction->Creer($Reserv);

}catch(\CmbSdk\Exceptions\ReponseException ex){
    echo "Erreur de réponse HTTP: " .
    $e->getReponse() . "&lt;br />" .
    "Message : " . $e->getMessage();
}

?&gt;
                                            </code></pre>
                                    </div>
                                    <div class="tab-pane fade in" id="json-creer">
                                        <pre><code class="code json">
# CorpsDeLaRequete :

{
    "date_debut": "2017-09-07 10:00:00",
    "date_fin": "2017-09-07 11:00:00",
    "terrain": 1,
    "nom_client": "Mickael Lambda",
    "tel_client": "0654789856",
}
                                            </code></pre>
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
    "id": 12,
    "reference": "WNDB69H583",
    "nomClient": "Mickael Lambda",
    "telephoneClient": "0654789856",
    "descriptif": null,
    "estConfirmee": false,
    "plageHoraire": {
        "id": 18,
        "terrain": {
            "id": 1,
            "nom": "Terrain Intérieur 1",
            ...
            "complexe": {
                "id": 1,
                "nom": "Offside",
                ...
            }
        },
        "heureDebut": "2017-08-23 15:00:00",
        "heureFin": "2017-08-23 16:00:00",
        "statut": {
            "id": 3,
            "statutNom": "Réservé"
        }
    }
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


                <section id="delete" class="section-doc">
                    <h3 class="titre-section">Supprimer une reservation</h3>

                    <div class="requete-description">
                        Pour supprimer une réservation que vous avez passée, vous devez envoyer une requete HTTP de type DELETE sur l'url
                        %api_url%/reservations/{id} où %api_url% représente l'URL de l'api et {id} représente l'ID de la réservation.
                        (Cela implique de connaitre l'id de la reservation)
                    </div>

                    <div class="col-md-2 method">
                        <h4 class="methode-http methode-delete">DELETE</h4>
                    </div>
                    <div class="col-md-10 method">
                        <h4 class="url">... /reservations/{id}</h4>
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
&lt;?php

include 'CmbSdk/Autoloader.php';

// On instancie la classe CmbApi avec la clé d'API
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // Supprime la réservation
    $CmdApi->ReservationsAction->Supprimer("ID");

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
        "id": 12,
        "reference": "WNDB69H583",
        "nomClient": "Mickael Lambda",
        "telephoneClient": "0654789856",
        "descriptif": null,
        "estConfirmee": false,
        "plageHoraire": {
            "id": 18,
            "terrain": {
                "id": 1,
                "nom": "Terrain Intérieur 1",
                ...
                "complexe": {
                    "id": 1,
                    "nom": "Offside",
                    ...
                }
            },
            "heureDebut": "2017-08-23 15:00:00",
            "heureFin": "2017-08-23 16:00:00",
            "statut": {
                "id": 3,
                "statutNom": "Réservé"
            }
        }
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


                <section id="recup-liste"  class="section-doc" >
                    <h3 class="titre-section">Récupèrer la liste de vos réservations</h3>

                    <div class="requete-description">
                        Pour récupérer la liste de toutes les réservations que vous avez passées,
                        il suffit d'envoyer une requete HTTP de type GET sur l'url %api_url%/reservations. Le format de données renvoyée est le JSON.
                    </div>

                    <div class="col-md-2 method">
                        <h4 class="methode-http methode-get">GET</h4>
                    </div>
                    <div class="col-md-10 method">
                        <h4 class="url">... /reservations</h4>
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
&lt;?php

include 'CmbSdk/Autoloader.php';

// On instancie la classe CmbApi avec la clé d'API
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // Récupère un tableau contenant vos réservations
    $Reservs = $CmdApi->ReservationsAction->GetAll();

    // Parcours le tableau de reserv.
    foreach ($Reservs as $uneResa) {
        // TODO : Actions sur les reservations
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
        "id": 12,
        "reference": "WNDB69H583",
        "nomClient": "Mickael Lambda",
        "telephoneClient": "0654789856",
        "descriptif": null,
        "estConfirmee": false,
        "plageHoraire": {
            "id": 18,
            "terrain": {
                "id": 1,
                "nom": "Terrain Intérieur 1",
                ...
                "complexe": {
                    "id": 1,
                    "nom": "Offside",
                    ...
                }
            },
            "heureDebut": "2017-08-23 15:00:00",
            "heureFin": "2017-08-23 16:00:00",
            "statut": {
                "id": 3,
                "statutNom": "Réservé"
            }
        }
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



                <section class="section-doc" id="recup-one">
                    <h3 class="titre-section">Récupèrer une réservation que vous avez passé</h3>

                    <div class="requete-description">
                        Pour récupérer une réservation que vous avez passé,
                        il suffit d'envoyer une requete HTTP de type GET sur l'url %api_url%/reservations/{id} ou {id} est l'identifiant de la réservation que vous souhaitez récuperer.
                        Le format de données renvoyée est le JSON.
                    </div>

                    <div class="col-md-2 method">
                        <h4 class="methode-http methode-get">GET</h4>
                    </div>
                    <div class="col-md-10 method">
                        <h4 class="url">... /reservations/{id}</h4>
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
&lt;?php

include 'CmbSdk/Autoloader.php';

// On instancie la classe CmbApi avec la clé d'API
$CmbApi = new CmbApi(CmbApi::MODE_TEST, "VOTRE_CLE_API");

try {

    // On récupère un objet Complexe par son id
    $Resa = $CmdApi->ReservationsAction->Get("ID");

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
    "id": 12,
    "reference": "WNDB69H583",
    "nomClient": "Mickael Lambda",
    "telephoneClient": "0654789856",
    "descriptif": null,
    "estConfirmee": false,
    "plageHoraire": {
        "id": 18,
        "terrain": {
            "id": 1,
            "nom": "Terrain Intérieur 1",
            ...
            "complexe": {
                "id": 1,
                "nom": "Offside",
                ...
            }
        },
        "heureDebut": "2017-08-23 15:00:00",
        "heureFin": "2017-08-23 16:00:00",
        "statut": {
            "id": 3,
            "statutNom": "Réservé"
        }
    }
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
