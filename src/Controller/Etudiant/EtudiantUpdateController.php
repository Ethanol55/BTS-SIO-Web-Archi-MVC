<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class EtudiantUpdateController implements ControllerInterface
{
    private $post;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])) {
            $this->id = $tabInput["VARS"]["id"];
            // ici on recupere l'id qui est dans l'url
        }
        // on verifie que des informations ont été saisies
        if (!empty($tabInput["POST"])){
            //toutes les informations saisies sont dans la variable post
            $this->post = $tabInput["POST"];
            //création d'un model afin d'appeler la methode updateStudent()
            $etudiantModel = NEW etudiantModel();
            //ici on verifie la conformité de l'email
            if (filter_var($this->post["email"], FILTER_VALIDATE_EMAIL)) {

                    $encryptedPasssword = password_hash($this->post["pass"], PASSWORD_DEFAULT, ['cost' => 10]); // cryptage du mot de passe avec un cout de 10

                    $etudiantModel->updateStudent($this->post["email"], $encryptedPasssword, $this->post["login"], $this->post["nom"], $this->post["prenom"], $this->id);
                }
            else {
                echo "L'email saisi n'est pas sous la bonne forme";
            }
                }
            }


    public function outputEvent()
    {
        // Obj connect Mysql -> Obj Questionnaire
        $etudiantModel = new EtudiantModel();
        // Cette ligne fera en sorte que lorsque l'etudiant sera modifié, on retournera sur la page avec la liste des etudiants
//        header('Location: /etudiant');
        // Si y a pas de GET alors j'affiche tout
        return TwigCore::getEnvironment()->render(
            'etudiant/updateEtudiant.html.twig',
            [
                'etudiant' => $etudiantModel->getFetchIdEtudiant($this->id)

            ]);

    }
}