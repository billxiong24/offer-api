<?php
class OfferControllerJSON extends OfferController {
    
    public function __construct($database, $offerModel=null) {
        parent::__construct($database, $offerModel);
    }

    //override
    public function read_id($offer_id) {
        return json_encode(parent::get_id_result($offer_id));
    }
    public function read_name($offer_name) {
        return json_encode(parent::get_name_result($offer_name));
    }

    public function search($query_params) {

        $search_result = [];
        parent::generate_search_query($query_params, function($row) use (&$search_result) {
            $search_result[] = $row;
        });

        return json_encode($search_result);
    }
}
?>
