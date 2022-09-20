<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Quizz\Core\Controller\FastRouteCore;

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Couche Controller
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', 'Quizz\Controller\HomeController');
    $route->addRoute('GET', '/lister', 'Quizz\Controller\Questionnaire\ListController');
    $route->addRoute('GET', '/detail/{id:\d+}', 'Quizz\Controller\Questionnaire\ViewController');
    $route->addRoute('GET', '/hello', 'Quizz\Controller\HelloWorldController');
    $route->addRoute('GET', '/listQuestion', 'Quizz\Controller\Question\ListController');
    $route->addRoute('GET', '/question/{id:\d+}', 'Quizz\Controller\Question\ViewController');
    $route->addRoute('GET', '/titre/titre={titre:\w+}', 'Quizz\Controller\Question\ViewController');
    $route->addRoute(['GET' , 'POST'], '/etudiant/add', 'Quizz\Controller\Etudiant\AddStudentController');
    $route->addRoute('GET', '/etudiant', 'Quizz\Controller\Etudiant\EtudiantController');
    $route->addRoute(['GET' , 'POST'], '/etudiant/{id:\d+}', 'Quizz\Controller\Etudiant\EtudiantUpdateController');
    $route->addRoute(['GET' , 'POST'], '/etudiant/{id:\d+}/del', 'Quizz\Controller\Etudiant\EtudiantDeleteController');

});
// Dispatcher -> Couche view
echo FastRouteCore::getDispatcher($dispatcher);

