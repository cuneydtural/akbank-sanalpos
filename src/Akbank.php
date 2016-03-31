<?php

namespace Virtualpos;

class Akbank {

    protected $post_url = 'https://www.sanalakpos.com/fim/api';
    protected $shop_code;
    protected $user_code;
    protected $user_pass;
    protected $card_name;
    protected $order_id;
    protected $total;
    protected $currency;
    protected $pan;
    protected $cvv;
    protected $expiry;
    protected $instalment;
    protected $xml;


    /**
     * Akbank constructor.
     *
     * @param $shop_code
     * @param $user_code
     * @param $user_pass
     */

    public function __construct($shop_code, $user_code, $user_pass) {

        $this->shop_code = $shop_code;
        $this->user_code = $user_code;
        $this->user_pass = $user_pass;

    }

    /**
     * @param $order_id
     *
     * @return bool|int (0) VISA
     * (0) VISA
     * (1) MASTERCARD
     */

    public function setOrder($order_id) {
        return $this->order_id = $order_id;
    }

    /**
     * @param $total
     *
     * @return mixed
     */

    public function setTotal($total) {
        return $this->total = $total;
    }

    /**
     * @param $currency
     *
     * @return mixed
     */

    public function setCurrency($currency) {
        return $this->currency = $currency;
    }

    /**
     * @param $pan
     *
     * @return mixed
     */

    public function setPan($pan){
        return $this->pan = $pan;
    }

    /**
     * @param $cvv
     *
     * @return mixed
     */

    public function setCvv($cvv) {
        return $this->cvv = $cvv;
    }

    /**
     * @param $expiry
     *
     * @return mixed
     */

    public function setExpiry($expiry) {
        return $this->expiry = $expiry;
    }

    /**
     * @param $instalment
     *
     * @return mixed
     */

    public function setInstalment($instalment) {
        return $this->instalment = $instalment;
    }

    /**
     * @return bool|string
     */

    public function cardType() {

        $pan = substr($this->pan, 0, 1);

        switch ($pan) {
            case "4":
                return '0';
                break;
            case "5":
                return '1';
                break;
            default:
                return false;
        }
    }

    public function setXml() {

        $dom = new \DOMDocument('1.0', 'utf-8');
        $root = $dom->createElement('CC5Request');

        $x['OrderId'] = $dom->createElement('OrderId', $this->order_id);
        $x['Name'] = $dom->createElement('Name', $this->user_code);
        $x['Password'] = $dom->createElement('Password', $this->user_pass);
        $x['ClientId'] = $dom->createElement('ClientId', $this->shop_code);
        $x['Type'] = $dom->createElement('ClientId', 'Auth');
        $x['Total'] = $dom->createElement('Total', $this->total);
        $x['Currency'] = $dom->createElement('Currency', $this->currency);
        $x['Number'] = $dom->createElement('Number', $this->pan);
        $x['Expires'] = $dom->createElement('Expires', $this->expiry);
        $x['Cvv2Val'] = $dom->createElement('Cvv2Val', $this->cvv);
        $x['Email'] = $dom->createElement('Email', 'name@domain.com');
        $x['Instalment'] = $dom->createElement('Instalment', $this->instalment);

        foreach($x as $node) {
            $root->appendChild($node);
        }

        $dom->appendChild($root);
        $this->xml =  $dom->saveXML();

    }

    public function getXml() {
        print $this->xml;
    }

    public function send() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->post_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->xml);

        echo $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo curl_error($ch);
        }
    }

}
