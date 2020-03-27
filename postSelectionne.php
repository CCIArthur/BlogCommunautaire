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

session_start();

//ajouter tout de posts,
//        tout de commentaires de CE post
//        pseudo de l'auteur


include 'postSelectionne.phtml';