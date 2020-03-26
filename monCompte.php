<?php
    session_start();

    if(!array_key_exists('blogCommunautaire',$_SESSION))
    {
        header('Location:authentification.php');
        exit;
    }
    //var_dump('monCompte');

    else
    {
        if(isset($_SESSION['authentification']))
        {

        }
    
    $connexionBDD = new PDO
    (
        'mysql:host=localhost;dbname=blogcommunautaire;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    //var_dump($_FILES);
    
    $query = 'SELECT id, pseudo, mdpHash FROM auteurs WHERE pseudo = ?';
    $sth = $connexionBDD -> prepare($query);
    $sth -> bindValue('pseudo', $_SESSION['authentification'], PDO::PARAM_INT);
    $sth -> execute();
    $utilisateur = $sth -> fetch();
    }

    include 'monCompte.phtml';