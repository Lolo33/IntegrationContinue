<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 29/08/2017
 * Time: 15:17
 */

namespace CmbSdk;

use CmbSdk\ClassesMetiers\Complexe;
use CmbSdk\ClassesMetiers\PlageHoraire;
use CmbSdk\ClassesMetiers\Terrain;
use CmbSdk\ClassesMetiers\UtilisateurApi;
use CmbSdk\ClassesMetiers\UtilisateurToken;

class CmbApi extends Requetes
{

    public $UtilisateursAction;
    public $TokensAction;
    public $ComplexesAction;
    public $PlageHorairesAction;
    public $TerrainsAction;
    public $PlanningTarifsAction;
    public $PlanningComissionAction;
    public $ReservationsAction;

    private $modeProduction = false;

    const URL_PROD = "http://api.connectmybooking.com/";
    const URL_TEST = "http://test.api.connectmybooking.com/";

    public function __construct($api_key)
    {
        if ($this->modeProduction)
            $url = CmbApi::URL_PROD;
        else
            $url = CmbApi::URL_TEST;
        parent::__construct($url, $api_key);
        $this->UtilisateursAction = new ActionsUtilisateurs($url . Routes::URL_USER, $api_key, $this->modeProduction);
        $this->TokensAction = new ActionsTokens(Routes::URL_TOKEN, $api_key, $this->modeProduction);
        $this->ComplexesAction = new ActionsComplexes($url . Routes::URL_COMPLEXES , $api_key, $this->modeProduction);
        $this->TerrainsAction = new ActionsTerrains($url . Routes::URL_TERRAINS, $api_key, $this->modeProduction);
        $this->PlageHorairesAction = new ActionsPlagesHoraires($url . Routes::URL_HORAIRES, $api_key, $this->modeProduction);
        $this->PlanningTarifsAction = new ActionsPlanningTarifs($url . Routes::URL_TARIFS, $api_key, $this->modeProduction);
        $this->PlanningComissionAction = new ActionsPlanningComissions($url . Routes::URL_COMISSION, $api_key, $this->modeProduction);
        $this->ReservationsAction = new ActionsReservations($url . Routes::URL_RESERVATION, $api_key, $this->modeProduction);
    }

    /**
     * @return bool
     */
    public function isModeProduction()
    {
        return $this->modeProduction;
    }
    /**
     * @param bool $modeProduction
     */
    public function setModeProduction($modeProduction)
    {
        $this->modeProduction = $modeProduction;
    }

}

