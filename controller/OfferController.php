<?php 
class OfferController {
    //data is an array 
    private $offerModel;
    private $database;

    public function __construct($offerModel, $database) {
        $this->offerModel = $offerModel;
        $this->database = $database;
    }

    public function insert() {
        //TODO insert
        //$query = 'INSERT INTO offers (id, name, cost, country, state, max_limit) VALUES (:id, :name, :cost, :country, :state, :max_limit)';
        //$stmt = $this->database->prepare($query);
        //$query_result = $stmt->execute([
            //"id"=> $this->offerModel->getID(),
            //"name"=> $this->offerModel->getname(),
            //"cost"=>$this->offerModel->getCost(),
            //"country"=>$this->offerModel->getCountry(),
            //"state"=>$this->offerModel->getState(), 
            //"max_limit"=>$this->offerModel->getLimit()
        //]);

        //if(!$query_result) {
            //echo "error";
            ////exceiption handle
        //}
    }

    public function read() {
        //TODO read

    }

    public function delete_offer() {
        //TODO delete 

    }

    public function update() {
        //TODO update 

    }

}
?>


