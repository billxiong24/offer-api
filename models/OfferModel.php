<?php
    
class OfferModel {
    //data is an array 
    private $offer_id;
    private $name;
    private $cost;
    private $country;
    private $state;
    private $max_limit; 

    public function __construct($data = null) {
        if($data === null) {
            return;
        }

        //for retrieving
        $this->offer_id = $data['id'];
        $this->name = $data['name'];
        $this->cost = $data['cost'];
        $this->country = $data['country'];
        $this->state = $data['state'];
        $this->max_limit = $data['max_limit'];
    }

    //getters
    public function getID() {
        return $this->offer_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCost() {
        return $this->cost;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getState() {
        return $this->state;
    }

    public function getLimit() {
        return $this->max_limit;
    }

    //setters
    public function setID() {
        //just generates random id, can change this implementation
        $this->offer_id = uniqid();
        return $this;
    }

    public function setName($name) {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
        return $this;
    }

    public function setCost($cost) {
        $this->cost = filter_var($cost, FILTER_SANITIZE_STRING);
        return $this;
    }

    public function setCountry($country) {
        $this->country = filter_var($country, FILTER_SANITIZE_STRING);
        return $this;
    }

    public function setState($state) {
        $this->state = filter_var($state, FILTER_SANITIZE_STRING);
        return $this;
    }

    public function setLimit($max_limit) {
        $this->max_limit = filter_var($max_limit, FILTER_SANITIZE_STRING);
        return $this;
    }

}
?>
