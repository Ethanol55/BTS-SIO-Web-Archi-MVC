<?php

namespace Quizz\Model;

use Quizz\Core\Service\DatabaseService;
use Quizz\Entity\Etudiant;

class EtudiantModel
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    //Cette methode permet d'ajouter un etudiant dans la base
    //il n'y a pas d'id dans la requete car cette colonne est en auto-increment
    public function addStudent(string $login, string $password, string $name , string $firstname, string $email){


        $requete = $this->bdd->prepare('INSERT INTO etudiants (login, motDePasse, nom, prenom, email) 
                                              VALUES ("' . $login . '", "' . $password . '", "' . $name . '", "' . $firstname . '", "' . $email . '");');
        //execution de la requete
        $requete->execute();
    }

    //Cette methode permet de recuperer une liste composée de tous les etudiants de la base
    public function getFetchallEtudiant(): array
    {

        $requete = $this->bdd->prepare('SELECT idEtudiant,  prenom, email, login, nom FROM etudiants');
        $requete->execute();
        $tabEtudiant=[];
        //ici on instancie une liste vide que l'on va remplir avec tous les étudiants de la base
        foreach ($requete->fetchAll() as $value)
        {
            // On parcours les données obtenues par la requete et on les ajoute à la liste
            $etudiant = new Etudiant();
            $etudiant->setIdEtudiant($value['idEtudiant']);
            $etudiant->setPrenom($value['prenom']);
            $etudiant->setEmail($value['email']);
            $etudiant->setLogin($value['login']);
            $etudiant->setNom($value['nom']);
            $tabEtudiant[] = $etudiant;
        }

        return $tabEtudiant;
    }

    //Cette methode permet de modifier un etudiant en fonction de son id
    //La modification est faite sur l'email, le mot de passe, le login, le nom et le prenom
    public function updateStudent(string $email, string $password, string $login, string $name , string $firstname , int $id){
        $requete = $this->bdd->prepare('UPDATE etudiants SET email = "' . $email . '", motDePasse = "' . $password . '", login = "' . $login . '", nom = "' . $name . '", prenom = "' . $firstname . '" WHERE idEtudiant = ' . $id );
        $requete->execute();

    }

    //Cette methode permet de supprimer un etudiant en fonction de son id
    public function deleteStudent($id){
        $requete = $this->bdd->prepare('DELETE FROM etudiants WHERE idEtudiant =' . $id);
        $requete->execute();
    }

    // Cette methode sert a retourner un etudiant en fonction de son id
    public function getFetchIdEtudiant(int $id)
    {

        $requete = $this->bdd->prepare('SELECT *  FROM etudiants where idEtudiant = ' . $id);
        $requete->execute();
        $result = $requete->fetch();
        // ici on ecrit la requete et on l'execute

        $etudiant = new Etudiant();
        $etudiant->setIdEtudiant($result["idEtudiant"]);
        $etudiant ->setLogin($result["login"]);
        $etudiant ->setNom($result["nom"]);
        $etudiant ->setPrenom($result["prenom"]);
        $etudiant ->setEmail($result["email"]);
        // ici on créé un nouvel etudiant dans lequel on met les informations recupérés par le requete

        return  $etudiant;
    }

    public function verifEmail(string $email){

        $requete = $this->bdd->prepare('SELECT email FROM etudiants WHERE email  ="' . $email . '";');
        $requete->execute();
        $result = $requete->fetch();
        if ($result["email"]==null)
        {
            return true ;
        }
        else
        {
            return false;
        }
    }

}