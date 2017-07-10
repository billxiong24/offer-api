<?php
class OfferControllerJSON extends OfferController {
    
    public function __construct($database, $offerModel=null) {
        parent::__construct($database, $offerModel);
    }

    //override
    public function read_id($offer_id) {
        $query = parent::generate_id_read_query();
        $result = parent::read_query_result($query, $offer_id);
        return json_encode($result);
    }
}
?>
