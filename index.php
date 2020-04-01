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

$query =
    'SELECT posts.id, posts.titre, posts.contenu, posts.datePublication, posts.image, posts.idAuteur, auteurs.id, auteurs.pseudo
    FROM posts INNER JOIN auteurs ON posts.idAuteur = auteurs.id
    ORDER BY posts.datePublication DESC';

$sth = $connexionBDD -> query($query);
$posts = $sth -> fetchAll();
//var_dump($posts);

session_start();

include 'index.phtml';