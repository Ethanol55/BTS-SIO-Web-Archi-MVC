<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\View\TwigCore;
use Quizz\Core\Controller\ControllerInterface;
use Quizz\Model\etudiantModel;

class AddStudentController implements ControllerInterface
{
    private $post;
    private $e;

    public function inputRequest(array $tabInput)
    {
        //verification que le formulaire a bien été soumis
        if (!empty($tabInput["POST"])){
            //toutes les informations saisies sont dans la variable post
            $this->post = $tabInput["POST"];
            //création d'un model afin d'appeler la methode addStudent()
            $etudiantModel = NEW etudiantModel();
            //ici on verifie la conformité de l'email
            if (filter_var($this->post["email"], FILTER_VALIDATE_EMAIL)) {
                //ici on compare les deux mots de passe saisis, il faut qu'ils soient identique
                if ($etudiantModel->verifEmail($this->post["email"]) == true){
                    //ici on verifie si l'email saisi n'est pas deja existant dans la base
                    if ($this->post["pass"] == $this->post["verifpass"]) {
                        $encryptedPassword = password_hash($this->post["pass"], PASSWORD_DEFAULT, ['cost' => 10]); // cryptage du mot de passe avec un cout de 10
                        $etudiantModel->addStudent($this->post["login"], $encryptedPassword, $this->post["nom"], $this->post["prenom"], $this->post["email"]);
                        // Cette ligne fera en sorte que lorsque l'étudiant sera ajouté, on retournera sur la page avec la liste des étudiants
                        header('Location: /etudiant');
                    }
                    else {
                        echo "Il faut saisir le meme mot de passe";
                    }
                }
                else{
                    echo "L'adresse email existe deja";
                }
            }
            else{
                echo "L'email saisi n'est pas sous la bonne forme";
            }
    }
    }

    public function outputEvent()
    {
        // Obj connect Mysql -> Obj Questionnaire
        $etudiantModel = new \Quizz\Model\EtudiantModel();

        // Si y a pas de GET alors j'affiche tout
        return TwigCore::getEnvironment()->render(
            'etudiant/ajoutEtudiant.html.twig',
            [

            ]);


    }
}