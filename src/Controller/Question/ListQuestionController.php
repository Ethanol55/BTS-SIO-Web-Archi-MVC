<?php

namespace Quizz\Controller\Question;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;

class ListQuestionController implements ControllerInterface
{

    public function inputRequest(array $tabInput)
    {
        // Nulle :)
    }

    public function outputEvent()
    {
        // Obj connect Mysql -> Obj Questionnaire
        $questionModel = new QuestionModel();

        // Si y a pas de GET alors j'affiche tout
        return TwigCore::getEnvironment()->render(
            'question/list.html.twig',
            [
                'question' => $questionModel->getFechAll()
            ]);
    }
}