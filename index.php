<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    use \Slim\Views\PhpRenderer as View;
    require 'vendor/autoload.php';
    //require '../vendor/autoload.php';
    
    $config = [];
    $config['db']['host'] = 'localhost';
    $config['db']['user'] = 'root';
    $config['db']['pass'] = 'Chem1313#';
    $config['db']['db_name'] = 'offers';
    $config['displayErrorDetails'] = true;
    
    
    $app = new \Slim\App([
        "db_settings" =>$config
    ]);

    //dependency injection container
    $container = $app->getContainer();

    //add database connection using prepared statements
    $container['db'] = function($con) {

        $db_settings = $con['db_settings']['db'];
        $settings = "mysql:host=" . $db_settings['host'] . ";dbname=" . $db_settings['db_name'];
                    
        $pdo = new PDO($settings, $db_settings['user'], $db_settings['pass']);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    };

    $container['view'] = new View('views/');


    $app->get('/', function(Request $req, Response $res) {
        return $this->view->render($res, "index.phtml", ["welcome" => "welcome to offers page"]);
    });


    //enter some information
    $app->get('/offers', function(Request $req, Response $res) {
        return $this->view->render($res, "offers.phtml", []);
    });

    //submit information for offer
    $app->post('/offers/post_offer', function(Request $req, Response $res) {
        $offerModel = new OfferModel();

        $data = $req->getParsedBody();
        $offerModel->setID();
        $offerModel->setName($data['name']);
        $offerModel->setCost($data['cost']);
        $offerModel->setCountry($data['country']);
        $offerModel->setState($data['state']);
        $offerModel->setLimit($data['max_limit']);

        $offerController = new OfferController($offerModel, $this->db);
        $offerController->insert();
        return $res->withRedirect("/offer/index.php/offers");
    });

    //get specific offer id
    $app->get('/offers/id/{offer_id}', function(Request $req, Response $res, $args) {
        return $this->view->render($res, "offer_id.phtml", []);
    });

    //get all offers with specific name, if there are multiple
    $app->get('/offers/name/{offer_name}', function(Request $req, Response $res, $args) {
        return $this->view->render($res, "offer_name.phtml", []);
    });


    $app->run();
?>
