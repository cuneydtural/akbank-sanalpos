# akbank-sanalpos
Akbank Sanal Pos Sınıfı

### Kullanımı

`$akbank = new Akbank('100100000', 'AKTESTAPI', 'AKBANK01');
$akbank->setOrder('9898989898989')->setCurrency('949')->setPan('4938410114062912');
$akbank->setCvv('956')->setExpiry('2001')->setTotal('50.00')->setInstalment('0');
$akbank->setType('Auth');
$akbank->setXml();
$akbank->send();`
