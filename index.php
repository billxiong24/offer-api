<?php

    use \Slim\Views\PhpRenderer as View;

    require 'vendor/autoload.php';

    use Offer\Router as Router;
    
    //too lazy to hide db credentials, these should be in php.ini
    $config = [];
    $config['db']['host'] = 'localhost';
    $config['db']['user'] = 'root';
    $config['db']['pass'] = 'Chem1313#';
    $config['db']['db_name'] = 'offers';

    
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

    $router = new Router($app);
    $router->set_get_routes();
    $router->set_post_routes();

    $app->run();
?>
