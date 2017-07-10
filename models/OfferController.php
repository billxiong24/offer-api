<?php 
abstract class OfferController {
    //data is an array 
    private $offerModel;
    private $database;

    public function __construct($database, $offerModel=null) {
        $this->offerModel = $offerModel;
        $this->database = $database;
    }

    public function insert() {
        //TODO insert
        $query = 'INSERT INTO offers (id, name, cost, country, state, max_limit) VALUES (:id, :name, :cost, :country, :state, :max_limit)';
        $stmt = $this->database->prepare($query);
        $query_result = $stmt->execute([
            "id"=> $this->offerModel->getID(),
            "name"=> $this->offerModel->getname(),
            "cost"=>$this->offerModel->getCost(),
            "country"=>$this->offerModel->getCountry(),
            "state"=>$this->offerModel->getState(), 
            "max_limit"=>$this->offerModel->getLimit()
        ]);

        if(!$query_result) {
            //exceiption handle
            echo "error";
        }
    }

    public abstract function read_id($offer_id);

    public abstract function read_name($offer_name);
    public abstract function search($query_params);

    protected function generate_search_query($query_params) {
        $query = "SELECT * FROM offers WHERE ";
        $obj = [];
        $bool = false;
        if($query_params["id"] !== null) {
            $query .= "id = :id";
            $obj['id'] = $query_params['id'];
            $bool = true;
        }

        if($query_params["name"] !== null) {
            $query .= $bool ? " AND name = :name" : " name= :name";
            $obj['name'] = $query_params['name'];
            $bool = true;
        }

        if($query_params["cost"] !== null) {
            $query .= $bool ? " AND cost < :cost" : " cost < :cost";
            $obj['cost'] = $query_params['cost'];
        }

        //echo $query;
        return $this->read_query_result($query, $obj);
    }


    public function delete_offer() {
        //TODO delete 

    }

    public function update() {
        //TODO update 

    }

    protected function get_name_result($offer_name) {
        $query = "SELECT * FROM offers WHERE offers.name=:offer_name";
        return $this->read_query_result($query, ["offer_name"=>$offer_name])->fetch();
    }

    protected function get_id_result($offer_id) {
        $query =  "SELECT * FROM offers WHERE id=:offer_id";
        return $this->read_query_result($query, ["offer_id"=>$offer_id])->fetch();
    }

    protected function read_query_result($query, $obj) {
        $stmt = $this->database->prepare($query);

        $query_result = $stmt->execute($obj);
        if($query_result) {
            return $stmt;
        }
        //throw exception or soemthing 
        return null;
    }
}
?>
