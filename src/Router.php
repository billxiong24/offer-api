<?php
namespace Offer;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Offer\controller\OfferControllerJSON as OfferControllerJSON;
use Offer\controller\OfferController as OfferController;
use Offer\model\OfferModel as OfferModel;
use Offer\database\Database as Database; 

class Router {
    private $app;
    //$app should be Slim instance
    public function __construct($app) {
        $this->app = $app;
    }

    public function set_get_routes() {
        $app = $this->app;

        $app->get('/', function(Request $req, Response $res) {
            return $this->view->render($res, "index.phtml");
        });

        $app->get('/offers', function(Request $req, Response $res) {

            $offerController = new OfferControllerJSON(new Database($this->db));
            $results = $offerController->read_all();
            return $this->view->render($res, "index.phtml", ["offerModel"=>$results]);
        });


        //enter some information
        $app->get('/offer_form', function(Request $req, Response $res) {
            return $this->view->render($res, "offers.phtml", []);
        });

        $app->get('/offers/offer_search', function(Request $req, Response $res) {
            $params = $req->getQueryParams();
            $offerController = new OfferControllerJSON(new Database($this->db));
            $search_results = $offerController->search($params);
            return $this->view->render($res, "offer_search.phtml", ["offerModel"=>$search_results]);
        });

        //get specific offer id
        $app->get('/offers/id/{offer_id}', function(Request $req, Response $res, $args) {

            $offerController = new OfferControllerJSON(new Database($this->db));
            $offerModel = $offerController->read_id($args['offer_id']);
            
            return $this->view->render($res, "offer_id.phtml", ["offerModel"=>$offerModel]);
        });

        //get all offers with specific name, if there are multiple
        $app->get('/offers/name/{offer_name}', function(Request $req, Response $res, $args) {
            $offerController = new OfferControllerJSON(new Database($this->db));
            $offerModel = $offerController->read_name($args['offer_name']);
            return $this->view->render($res, "offer_name.phtml", ["offerModel"=>$offerModel]);
        });
    }

    public function set_post_routes() {
        $this->app->post('/offers/post_offer', function(Request $req, Response $res) {
            $offerModel = new OfferModel();

            $data = $req->getParsedBody();
            $offerModel->setID();
            $offerModel->setName($data['name']);
            $offerModel->setCost($data['cost']);
            $offerModel->setCountry($data['country']);
            $offerModel->setState($data['state']);
            $offerModel->setLimit($data['max_limit']);

            $offerController = new OfferControllerJSON(new Database($this->db), $offerModel);
            $offerController->insert();
            return $res->withRedirect("/offer/index.php/offers");
        });
    }
}
?>
