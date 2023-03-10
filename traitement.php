<?php
    include_once "connexion.php";
    $email1 = mysqli_real_escape_string($conn, $_POST['email1']);
    $email2 = mysqli_real_escape_string($conn, $_POST['email2']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);

    $sql=mysqli_query($conn,"INSERT INTO message(email1,email2,msg) values ('{$email1}' ,'{$email2}','{$msg}')");

    if($sql){
        echo 'MESSAGE ENVOYE AVEC SUCCES ✔   ';

        include ("form_contact.class.php");
    }
    ?>