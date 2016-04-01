<?php
/**
 * Created by PhpStorm.
 * User: cuneyd.tural
 * Date: 31.03.2016
 * Time: 14:48
 */

require 'vendor/autoload.php';

use Virtualpos\Akbank;

$akbank = new Akbank('100100000', 'AKTESTAPI', 'AKBANK01');
$akbank->setOrder('9898989898989');
$akbank->setCurrency('949');
$akbank->setPan('4938410114062912');
$akbank->setCvv('956');
$akbank->setExpiry('2001');
$akbank->setTotal('50.00');
$akbank->setInstalment('0');
$akbank->setType('Auth');
$akbank->setXml();
$akbank->getXml();
$akbank->send();


