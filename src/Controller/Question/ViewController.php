<?php

namespace Quizz\Controller\Question;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\QuestionModel;

class ViewController implements ControllerInterface
{
    private $id;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
        }
    }

    public function outputEvent()
    {
        // Obj connect Mysql -> Obj Questionnaire
        $questionModel = new QuestionModel();

        // je teste la variable GET /?id
        if (isset($this->id)) {
            return TwigCore::getEnvironment()->render(
                'question/question.html.twig',
                [
                    'question' => $questionModel->getFechId((int) $this->id)
                ]);
        } else {
            return null;
        }
    }
}