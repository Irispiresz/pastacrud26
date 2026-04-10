<?php 
    //esse é o logout.php
    include("../config.php");
    try {
        session_start(); //inicai a sessao ou acessa a sessao existente
        session_destroy(); //destroi a sessao limpando todos os valores salvos
        //direciona para o index do site
        header("Location: " . BASEURL . "index.php");
    } catch (Exception $e) {
        $_SESSION['message'] = "Ocorreu um erro:"  . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
?>