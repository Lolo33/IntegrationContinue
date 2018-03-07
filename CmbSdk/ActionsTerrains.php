<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 05/09/2017
 * Time: 12:37
 */

namespace CmbSdk;


use CmbSdk\ClassesMetiers\Terrain;

class ActionsTerrains extends Actions
{

    public function __construct($url, $api_key, $modeProduction)
    {
        parent::__construct($url, $api_key, $modeProduction);
        $this->objet = new Terrain(true);
    }

    /**
     * Envoie une requête GET qui récupère une liste de terrains d'un complexe grâce à son ID passé en paramètre
     * @param int $id_complexe                     ID du complexe duquel on veut récupérer les terrains
     * @return array                               Objet Terrain hydraté avec les valeurs récupéés par la requête
     */
    public function GetAllFromComplexe($id_complexe){
        $url = $this->url;
        if (!$this->modeProduction)
            $url_base = CmbApi::URL_TEST;
        else
            $url_base = CmbApi::URL_PROD;
        $this->url = $url_base . Routes::URL_COMPLEXES . "/" . $id_complexe . Routes::URL_TERRAINS;
        $rep = parent::GetAll();
        $this->url = $url;
        return $rep;
    }

}