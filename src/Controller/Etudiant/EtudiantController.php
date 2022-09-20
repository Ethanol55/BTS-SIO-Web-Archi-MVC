<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\etudiantModel;
use Quizz\Service\TwigService;

class EtudiantController implements ControllerInterface
{

    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
    }


    public function outputEvent()
    {
        $twig = TwigService::getEnvironment();
        // Obj connect Mysql -> Obj Questionnaire
        $etudiantModel = new etudiantModel();

        return TwigCore::getEnvironment()->render('/etudiant/listEtudiant.html.twig', [
            'etudiants' => $etudiantModel->getFetchallEtudiant(),

        ]);

    }
}