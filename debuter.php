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
                <li class="active"><a href="#">Débuter</a></li>
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
                <li class="active">
                    <a href="debuter">Débuter avec CMB-API <span class="caret"></span></a>
                    <ul class="sous-menu">
                        <li id="acces-item" class="sous-menu-item sous-menu-item-active"><a href="#acces">Acces à l'API</a></li>
                        <li id="utilisation--item" class="sous-menu-item"><a href="#utilisation">Utilisation du SDK</a></li>
                        <li id="requetes-item" class="sous-menu-item"><a href="#requetes">Envoi de requêtes HTTP</a></li>
                    </ul>
                </li>
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
            <div id="contenu-doc">

                <section id="acces">
                    <h3 class="titre-section">Introduction - Accès à l'API</h3>
                    <h4 class="titre-page">Créer son compte</h4>
                    ConnectMyBooking API vous propose un accès aux planning et tarifs de nos différents complexes sportifs partenaires, sous réserve de quelques
                    conditions qui vont vous être citées. L'API est faite pour que vos applications puissent se connecter facilement et de manière centralisée
                    aux planning des complexes.<br /><br />

                    Pour commencer à utiliser Cmb-Api, vous devez auparavant créer un compte. Pour cela, il faut correspondre aux critères suivants:
                    <ul>
                        <li>Être un apporteur d'affaire pour les complexes sportifs, c'est à dire posséder une application qui a pour but d'organiser des matchs entre vos utilisateurs.</li>
                        <li>Présenter une pièce d'identité ainsi qu'un justificatif attestant que vous êtes bien le propriétaire de l'application et/ou de l'entreprise (immatriculation / relevés...)</li>
                        <li>Avoir lu et accepté nos <a href="conditions">conditions génerales d'utilisations</a> de l'API.</li>
                        <li>Respecter notre politique de confidentialité et ne laisser sous aucun pretexte l'accès à votre clé d'API à une personne tierce.
                            (Si la confidentialité de votre clé d'API est compromise, vous pouvez la changer à tout moment via votre <a href="api_gestion">tableau de bord</a></li>
                    </ul>
                    <br />
                    Les différentes ressources de notre service sont disponibles grâce à des requêtes HTTP avec la méthode souhaitée
                    (GET, POST, DELETE...) sur l'url <strong>https://api.connectmybooking.com</strong>, suivi du nom de la ressource au pluriel (/complexes, /reservations...)<br /><br />

                    Afin de garantir à nos utilisateur que nous ne leur fournissons pas des données érronnées, vous ne devez pas effectuer vos tests
                    sur le serveur principal (serveur de production), mais bien sur le serveur de test dédié à cela, disponible à l'adresse <strong>https://test.api.connectmybooking.com</strong>
                    <br /><br />
                    Vous devrez donc premièrement vous inscrire sur le serveur de test, et, une fois vos documents validés et le développement
                    de l'utilisation de l'API finis, sur le serveur de production.
                    <br /><br /><br />

                    <h4 class="titre-page">Authentifier ses requêtes</h4>
                    Vous pouvez communiquer avec notre service par le biais de <a href="https://openclassrooms.com/courses/les-requetes-http" target="_blank" title="Voir un cours sur les requêtes HTTP">requêtes HTTP</a>,
                    dans lesquelles les données sont présentées au format JSON.<br />
                    Afin de vous faciliter la tâche, nous mettons à votre disposition un <a href="#utilisation">kit de développement (SDK)</a> en PHP,
                    qui simplifiera la récupération des données souhaitées. Sans rentrer dans les détails, il suffit d'instancier un nouvel objet CmbApi
                    et d'apeller la classe Action souhaitée, pour récupérer un jeu de données sous formes d'objets/tableau d'objets PHP.<br /><br />

                    L'envoi de requêtes vers notre serveur nécessite une authentification grâce à votre clé d'API. Pour authentifier une requête,
                    il suffit d'ajouter un entête HTTP avec pour clé le mot "Autorisation" et pour valeur votre clé d'API.
                    Si vous utilisez notre SDK, il suffit d'instancier un nouvel objet CmbApi avec votre clé d'API en paramètre.
                    L'axemple ci-dessous vous montre comment authentifier une requête :<br /><br />

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Authentification d'une requête HTTP :</strong>
                            <pre><code class="json" style="min-height: 180px;">
#Entete de la requête

{
    "Autorisation": "VOTRE_CLE_API",
    "content-type": "application/json"
}
                            </code></pre>
                        </div>
                        <div class="col-md-6">
                            <strong>Authentification depuis le SDK PHP :</strong>
                            <pre><code class="php" style="min-height: 180px;">
&lt;?php

// Initialisation du SDK
$CmbApi = new CmbApi("VOTRE_CLE_API");

?>
                            </code></pre>
                        </div>
                    </div>
                </section>


                <section id="utilisation">
                    <h3 class="titre-section">Utilisation du SDK PHP</h3>

                    <h4 class="titre-page">Fonctionnement global</h4>
                    Le kit de développement (SDK) PHP a été conçu pour être le plus simple d'utilisation possible.
                    En effet, il permet, en quelques lignes de codes d'accéder aux données des complexes sportifs que vous êtes autorisé à consulter.
                    Les plus gros intêrets du SDK, c'est biensur que vous puissiez afficher à vos utilisateurs des plannings et des tarifs en temps réel,
                    et qu'ils puissent ainsi passer des réservations depuis vos application.<br /><br />

                    Voici les prérequis pour utiliser le SDK de ConnectMyBooking :
                    <ul>
                        <li>Une version de <strong>PHP >= 5</strong> (Version recommandée: <strong>5.6.25</strong>)</li>
                        <li>La librairie php <strong>Curl</strong> installée et configurée sur votre serveur</li>
                        <li>Un compte professionnel ConnectMyBooking, vous donnant accès à une clé d'API <strong>validée par nos soins</strong></li>
                    </ul>
                    <br />

                    Le SDK PHP est programmé de manière orienté objet (POO), et se décompose en 2 grandes parties : Les <strong>classes métiers</strong> (Complexe, PlageHoraire, Reservation...) contenant
                    la structure de chacune des informations que vous pouvez récupérer, et les <strong>classes d'action</strong> (ComplexesAction, PlageHorairesAction, ReservationsAction...),
                    que vous pouvez récupérer par le biais de la classe <strong>CmbApi</strong>, et qui vous permettent d'éffectuer des actions sur les classes dites "métier".<br />
                    Par exemple, si vous souhaitez récupérer la liste des complexes partenaires, il vous suffira d'utiliser <strong>la méthode GetAll()</strong> de la classe ComplexesAction,
                    qui est instanciée automatiquement lorsque vous instanciez un nouvel objet CmbApi pour vous authentifier.<br /><br />

                    Pour vous éviter d'inclure dans chacun de vos scripts les fichiers des classes que vous allez apeller, vous pouvez utiliser la classe Autoloader,
                    qui se chargera pour vous d'inclure les fichiers dont vous aurez besoin dans votre script. Il vous suffit simplement d'inclure le fichier <strong>"Autoloader.php"</strong> présent à la racine du SDK comme suit:<br /><br />
                    <pre style="width: 70%; margin: auto;"><code class="php" style="padding: 0 30px;">
&lt;?php
include "CmbSdk/Autoloader.php";
?>
                        </code></pre>
                    <br /><br /><br />

                    <h4 class="titre-page">Gestion des erreurs</h4>
                    Une erreur HTTP peut survenir assez fréquemment (paramètres invalides, ressource introuvable...), c'est pourquoi,
                    afin de simplifier la compréhension et le solutionnement de ces erreurs, le SDK se charge de lever une exception de type <strong>ReponseException</strong>,
                    contenant toutes les informations sur l'erreur qui s'est produite durant la récupération / l'envoi de données.<br /><br/>
                    A chaque fois que vous utilisez une méthode d'action, vous devrez gérer les différentes erreurs qui peuvent survenir, en utilisant un bloc <strong>try / catch</strong>.
                    Pour avoir les détails sur l'erreur qui s'est produite, il suffit D'utiliser la methode <strong>getReponse()</strong> de l'exception (ReponseException) qui a été levée.
                    La méthode <strong>getMessage()</strong> vous permettra d'avoir de plus amples informations sur la nature exacte de l'erreur,
                    et la methode <strong>getCode()</strong> vous renseignera sur le <a href="#requetes">statusCode HTTP</a> qui a été renvoyé par le serveur.
                    Pour bien gérer les éventuelles erreurs, il convient donc d'utiliser le SDK comme suit :<br /><br />
                    <pre style="width: 70%; margin: auto;"><code class="php" style="padding: 0 30px;">
&lt;?php

try {
    // Actions à effectuer ...
}catch(\CmbSdk\Exceptions\ReponseException ex){
    echo "Erreur de réponse HTTP: " .
    $e->getReponse() . "&lt;br />" .
    "Message : " . $e->getMessage();
}

?>
                    </code></pre>
                </section>


                <section id="requetes">
                    <h3 class="titre-section">Envoi de requetes HTTP</h3>

                    <h4 class="titre-page">Fonctionnement Global</h4>

                    <h4 class="titre-page">Gestion des erreurs</h4>
                    Les codes HTTP utilisés respectent le principe REST. L'API n'utilise pas tous les codes d'erreurs possibles du protocole HTTP,
                    voici donc une liste récapitulant les erreurs que vous pourrez trouver en utilisant Cmb-Api:<br /><br />

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Code renvoyé</th>
                            <th>Libellé</th>
                            <th>Signification</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="success"><td colspan="3"><strong>SUCCES</strong></td></tr>
                        <tr class="active">
                            <td>200</td>
                            <td>OK</td>
                            <td>La requête a bien fonctionné et a renvoyé un contenu</td>
                        </tr>
                        <tr class="active">
                            <td>201</td>
                            <td>CREATED</td>
                            <td>La requête a bien fonctionné et a crée une ressourceu</td>
                        </tr>
                        <tr class="active">
                            <td>204</td>
                            <td>NO CONTENT</td>
                            <td>La requête a bien fonctionné et n'a renvoyé aucun résultat</td>
                        </tr>
                        <tr class="danger"><td colspan="3"><strong>ERREURS CLIENT</strong></td></tr>
                        <tr class="active">
                            <td>400</td>
                            <td>BAD REQUEST</td>
                            <td>De mauvaises informations ont été envoyées au serveur</td>
                        </tr>
                        <tr class="active">
                            <td>401</td>
                            <td>UNAUTHORIZED</td>
                            <td>La requête n'a pas pu être authentifiée</td>
                        </tr>
                        <tr class="active">
                            <td>403</td>
                            <td>FORBIDDEN</td>
                            <td>L'accès à la ressource est interdit</td>
                        </tr>
                        <tr class="active">
                            <td>404</td>
                            <td>NOT FOUND</td>
                            <td>La ressource demandée est introuvable</td>
                        </tr>
                        <tr class="danger"><td colspan="3"><strong>ERREUR SERVEUR</strong></td></tr>
                        <tr class="active">
                            <td>500</td>
                            <td>INTERNAL SERVER ERROR</td>
                            <td>Erreur interne, le serveur n'est peut-être pas en état de fonctionner</td>
                        </tr>
                        </tbody>
                    </table>
                </section>

            <div></div>

            </div>
        </div>


    </div>
</div>

<script src="js/script.js"></script>
<script src="highlight/highlight.pack.js"></script>
<script src="js/coloration_syntaxique.js"></script>
<?php include 'includes/script_bas_page.php'; ?>
<script src="js/spinner.js"></script>
</body>
</html>
