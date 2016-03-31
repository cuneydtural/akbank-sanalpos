<?php
/**
 * Created by PhpStorm.
 * User: cuneyd.tural
 * Date: 31.03.2016
 * Time: 14:48
 */

require 'vendor/autoload.php';

use Virtualpos\Akbank;
use Virtualpos\DOMDocument;

$akbank = new Akbank('000094797', 'admina', 'KUTU8954');
$akbank->setOrder('9898989898989');
$akbank->setCurrency('222');
$akbank->setPan('22');
$akbank->setCvv('222');
$akbank->setExpiry('22');
$akbank->setTotal('22');
$akbank->setInstalment('222');
$akbank->setxml();
$akbank->send();




