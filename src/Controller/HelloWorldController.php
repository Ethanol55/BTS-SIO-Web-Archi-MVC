<?php

namespace Quizz\Controller;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Service\TwigService;
use Quizz\Model\HelloWorldModel;

class HelloWorldController implements ControllerInterface
{

    public function outputEvent()
    {
        $twig = TwigService::getEnvironment();
        // Obj connect Mysql -> Obj Questionnaire
        $helloWorldModel = new HelloWorldModel();

        echo $twig->render('helloWorld.html.twig');
    }

    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
    }
}