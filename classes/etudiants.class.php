<?php 
    class Etudiants{
        
        private string $nom;
        private string $prenom;
        private int $age;
        /**
         * initialisation des atributs string $nom, string $prenom et int $age de la class Etudiant
         */
        public function __construct(string $nom,string $prenom,int $age){
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->age=$age;
            $this->nom=$nom;

        }
        /**
         * @param $etu est une chaine de caractère qui est retournée
         */
        public function afficherEtudiant(){
            $etu =  "Le nom de l'etudiant est " . $this->nom . ".Son prénom est " . $this->prenom . "Et il a " . $this->age . "ans .";
            return $etu;
        }
    }

?>