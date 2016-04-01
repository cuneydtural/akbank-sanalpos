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
$akbank->setOrder('9898989898989')->setCurrency('949')->setPan('4938410114062912');
$akbank->setCvv('956')->setExpiry('2001')->setTotal('50.00')->setInstalment('0');
$akbank->setType('Auth');
$akbank->setXml();
$akbank->send();

/* Gelen Sonuca göre işlem yap  */
if ($akbank->return_code == '00') {
    echo 'ödeme başarılı';
} else {
    echo 'ödeme başarısız. (' . $akbank->error_message . ')';
}



