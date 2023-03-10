<link rel="stylesheet" href="style.css">
<?php
    include 'includes/spl_autoload_register.inc.php';
?>

<?php
    class  form_contact extends formulaire{
           //aucune méthode définie ici 
    }
    $form = new form_contact;
    
    $form->initialiser()
        ->ajoutLabelFor('Email', 'Sender Mail :',['class' => ' label'])
        ->ajoutInput('email', 'email1', ['id' => 'email1', 'class' => 'form-control  form_input','placeholder'=>'Enter mail adresse...'])

        ->ajoutLabelFor('Email', 'Receiver mail :',['class' => ' label'])
        ->ajoutInput('email', 'email2', ['id' => 'email2', 'class' => 'form-control form_input ','placeholder'=>'Enter mail adresse...'])

        ->ajoutLabelFor('Oject', 'Oject :',['class' => ' label'])
        ->ajoutTextarea('msg', ['class' => 'form-control form_input_text ','placeholder'=>'Enter objec'])

        ->ajoutBouton('Envoyer', ['class' => 'btn btn-primary','type'=>'submit'])
        ->terminer()
        
    ;
    echo $form->afficher();

?>
