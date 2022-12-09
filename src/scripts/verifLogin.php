<?php

$idValide = 'root';
$passwordValide = 'root';

    if (isset($_POST['id']) && isset($_POST['password'])) {
        if ($_POST['id']==$idValide && $_POST['password']=$passwordValide) {
            session_start();
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['password'] = $_POST['password'];

            header('location: ../pagePrincipale.php');
        }
        else {
            header('location: index.html');            
        }
    }
    else{
        header('location: index.html');            
    }
?>