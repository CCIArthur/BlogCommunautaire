<?php

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
//var_dump($connexionBDD);

$query = 'SELECT id, pseudo, mdpHash FROM auteurs ORDER BY id ASC';
//var_dump($query);


//var_dump($_POST);


//if(!empty($_POST['email']) && !empty($_POST['mdp'])))
if(isset($_POST['pseudo']) && isset($_POST['mdpHash']) && !empty($_POST['pseudo'] && !empty($_POST['mdpHash'])))
{
    //if($_POST['pseudo'] ==)
    $mdpHash = password_hash($_POST['mdpHash'], PASSWORD_BCRYPT);
    //var_dump($mdpHash);
    $query =
    'INSERT INTO auteurs (pseudo, mdpHash) VALUES (?, ?)';

    $queryResult = $connexionBDD->prepare($query);
    $queryResult->execute([$_POST['pseudo'], $mdpHash]);
    $inscriptionOK = $queryResult->rowCount() == 1;

    var_dump($inscriptionOK);
    echo 'gg vous vous êtes bien inscrits';
    //header('Location: ./authentification.php');
    //exit;
}
else
{
    echo 'Veuillez remplir les champs';
}

include 'inscription.phtml';

?> 