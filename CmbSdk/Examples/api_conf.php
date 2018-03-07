<?php
/**
 * Created by PhpStorm.
 * User: Loïc Sicaire
 * Date: 31/08/2017
 * Time: 02:12
 */

use CmbSdk\Autoloader;
use CmbSdk\CmbApi;

include "../Autoloader.php";

Autoloader::register();

$CmbApi = new CmbApi( "AA75FTahzUFznr4u2kAXsBWGDyM=");
//$CmbApi->setModeProduction(true);