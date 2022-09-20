<?php

namespace Quizz\Controller\Etudiant;

use phpDocumentor\Reflection\Types\This;
use Quizz\Model\EtudiantModel;

class EtudiantDeleteController implements \Quizz\Core\Controller\ControllerInterface
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
        $etudiantModel = NEW etudiantModel();
        $etudiantModel->deleteStudent($this->id);
        header('Location: /etudiant');
    }
}