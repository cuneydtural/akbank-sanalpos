<?php
/**
 * Created by PhpStorm.
 * User: cuneyd.tural
 * Date: 31.03.2016
 * Time: 14:48
 */
require 'vendor/autoload.php';
use Virtualpos\Akbank;

/* Mağaza Kodu, Kullanıcı Adı, Şifre */
$akbank = new Akbank('100100000', 'AKTESTAPI', 'AKBANK01');

/* Sipariş Numarası  */
$akbank->setOrder('9898989898989');

/* Para Birimi  */
$akbank->setCurrency('949');

/* Kredi Kartı Numarası  */
$akbank->setPan('4938410114062912');

/* 3 Haneli güvenlik numarası  */
$akbank->setCvv('956'); //

/* Son Kullanma Tarihi  */
$akbank->setExpiry('2001');

/* Çekilecek Tutar  */
$akbank->setTotal('50.00');

/* Taksit  */
$akbank->setInstalment('0');

/* Provizyon  */
$akbank->setType('Auth');

/* XML formatına hazırla  */
$akbank->setXml();

/* Bankaya Gönder  */
$akbank->send();


/* Gelen Sonuca göre işlem yap  */
if ($akbank->return_code == '00') {
    echo 'ödeme başarılı';
} else {
    echo 'ödeme başarısız. (' . $akbank->error_message . ')';
}


