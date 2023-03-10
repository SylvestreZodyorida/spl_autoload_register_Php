<link rel="stylesheet" href="../style.css">

<?php
    
    class formulaire {
    
        private string $contenu='';
        private string $type;
        private string $traitement;

        /**
         * Génère le formulaire HTML
         * @return string 
         */
        public function afficher()
        {
            return $this->contenu;
            return $this->type;
            return $this->traitement;
        }

        /**
         * Valide si tous les champs proposés sont remplis
         * @param array $form Tableau issu du formulaire ($_POST, $_GET)
         * @param array $champs Tableau listant les champs obligatoires
         * @return bool 
         */
        public static function validate(array $form, array $champs)
        {
            // On parcourt les champs
            foreach($champs as $champ){
                // Si le champ est absent ou vide dans le formulaire
                if(!isset($form[$champ]) || empty($form[$champ])){
                    // On sort en retournant false
                    return false;
                }
            }
            return true;
        }


        /**
         * Ajoute les attributs envoyés à la balise
         * @param array $attributs Tableau associatif ['class' => 'form-control', 'required' => true]
         * @return string Chaine de caractères générée
         */
        private function ajoutAttributs(array $attributs): string
        {
            // On initialise une chaîne de caractères
            $str = '';

            // On liste les attributs "courts"
            $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

            // On boucle sur le tableau d'attributs
            foreach($attributs as $attribut => $valeur){
                // Si l'attribut est dans la liste des attributs courts
                if(in_array($attribut, $courts) && $valeur == true){
                    $str .= " $attribut";
                }else{
                    // On ajoute attribut='valeur'
                    $str .= " $attribut=\"$valeur\"";
                }
            }

            return $str;
        }

        /**
         * Balise d'ouverture du formulaire
         * @param string $methode Méthode du formulaire (post ou get)
         * @param string $action Action du formulaire
         * @param array $attributs Attributs
         * @return Form 
         */
        public function initialiser(string $type = 'POST', string $traitement = 'traitement.php', array $attributs = []): self
        {
            // On crée la balise form
            $this->contenu .= "<form enctype='multipart/form-data' action='$traitement' method='$type'";

            // On ajoute les attributs éventuels
            $this->contenu .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
            //$this->contenu .= "<br>";
            return $this;
        }

        /**
         * Balise de fermeture du formulaire
         * @return Form 
         */
        public function terminer():self
        {
            $this->contenu .= '</form>';
            return $this;
        }

        /**
         * Ajout d'un label
         * @param string $for 
         * @param string $texte 
         * @param array $attributs 
         * @return Form 
         */
        public function ajoutLabelFor(string $for, string $texte, array $attributs = []):self
        {
            // On ouvre la balise
            $this->contenu .= "<label for='$for'";

            // On ajoute les attributs
            $this->contenu .= $attributs ? $this->ajoutAttributs($attributs) : '';

            // On ajoute le texte
            $this->contenu .= ">$texte</label>";
            
            return $this;
        }


        /**
         * Ajout d'un champ input
         * @param string $type 
         * @param string $nom 
         * @param array $attributs 
         * @return Form 
         */
        public function ajoutInput(string $type, string $nom, array $attributs = []):self
        {
            // On ouvre la balise
            $this->contenu .= "<input type='$type' name='$nom'";

            // On ajoute les attributs
            $this->contenu .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
            $this->contenu .= "<br>";
            return $this;
        }

        /**
         * Ajoute un champ textarea
         * @param string $nom Nom du champ
         * @param string $valeur Valeur du champ
         * @param array $attributs Attributs
         * @return Form Retourne l'objet
         */
        public function ajoutTextarea(string $nom, array $attributs = []):self
        {
            // On ouvre la balise
            $this->contenu .= "<textarea name='$nom'";

            // On ajoute les attributs
            $this->contenu .= $attributs ? $this->ajoutAttributs($attributs) : '';

            // On ajoute le texte
            $this->contenu .= "></textarea>";
            $this->contenu .= "<br><br>  ";
            return $this;
            
        }
        
        public function ajouterChamp(string $nomChamp):self
        {
            switch ($nomChamp) {
                case 'text':
                    $this->contenu .= "<input type='$nomChamp' name='text'";
                    $this->contenu .=  '>';
                    $this->contenu .= "<br>";
                    return $this;

                    break;
                case 'password':
                    $this->contenu .= "<input type='$nomChamp' name='password'";
                    $this->contenu .=  '>';
                    $this->contenu .= "<br>";
                    return $this;
                    break;
                case 'textarea':
                    $this->contenu .= "<$nomChamp name='textarea'";
                    $this->contenu .= "></textarea>";
                    $this->contenu .= "<br>";
                    return $this;
                case 'checkbox':
                    $this->contenu .= "<input type='$nomChamp' name='checkbox'";
                    $this->contenu .=  '>';
                    $this->contenu .= "<br>";
                    return $this;
                    break;
                case 'email':
                    $this->contenu .= "<input type='$nomChamp' name='email'";
                    $this->contenu .=  '>';
                    $this->contenu .= "<br>";
                    return $this;
                    break;
                case 'radio':
                    $this->contenu .= "<input type='$nomChamp' name='radio'";
                    $this->contenu .=  '>';
                    return $this;
                    break;
                case 'select':
                    
                    $options = array();
                    $this->contenu .= "<select name='$nomChamp'";

                    // On ajoute les options
                    foreach($options as $valeur => $texte){
                        $this->contenu .= "<option value=\"$valeur\">$texte</option>";
                    }

                    // On ferme le select
                    $this->contenu .= '</select>';
                    $this->contenu .= "<br>";
                    return $this;
                    break;
                default:
                    
                    break;
            }
            
        }

        /**
         * Liste déroulante
         * @param string $nom Nom du champ
         * @param array $options Liste des options (tableau associatif)
         * @param array $attributs 
         * @return Form
         */
        public function ajoutSelect(string $nom, array $options, array $attributs = []):self
        {
            // On crée le select
            $this->contenu .= "<select name='$nom'";

            // On ajoute les attributs
            $this->contenu .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
            $this->contenu .= "<option value=> une valeur</option>";
            // On ajoute les options
            foreach($options as $valeur => $texte){
                $this->contenu .= "<option value=\"$valeur\">$texte</option>";
            }

            // On ferme le select
            $this->contenu .= '</select>';
            $this->contenu .= "<br>";

            return $this;
        }


        /**
         * Ajoute un bouton
         * @param string $texte 
         * @param array $attributs 
         * @return Form
         */
        public function ajoutBouton(string $texte, array $attributs = []):self
        {
            // On ouvre le bouton
            $this->contenu .= '<button ';

            // On ajoute les attributs
            $this->contenu .= $attributs ? $this->ajoutAttributs($attributs) : '';

            // On ajoute le texte et on ferme
            $this->contenu .= ">$texte</button>";
            $this->contenu .= "<br>";
            return $this;
        }

    }
    
    $form = new formulaire;
    
    $form->initialiser()
        ->ajoutLabelFor('nom', 'Nom :',['class' => ' label'])
        ->ajoutInput('text', 'text', ['id' => 'name', 'class' => 'form-control  form_input ','placeholder'=>'Enter name...'])

        ->ajoutLabelFor('prenom', 'Prenom :',['class' => ' label'])
        ->ajoutInput('text', 'text', ['id' => 'surname', 'class' => 'form-control form_input','placeholder'=>'Enter surname...'])

        ->ajoutLabelFor('email', 'E-mail :',['class' => ' label'])
        ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control form_input form_input','placeholder'=>'Enter mail adresse...'])

        ->ajoutLabelFor('pass', 'Mot de passe :',['class' => ' label'])
        ->ajoutInput('password', 'password', ['id' => 'pass', 'class' => 'form-control form_input','placeholder'=>'Enter password...'])

        ->ajoutBouton('Envoyer', ['class' => 'btn btn-primary'])
        ->terminer() ;
   // echo $form->afficher();

?>
