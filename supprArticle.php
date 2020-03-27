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

/*$query = 'DELETE FROM posts WHERE id = ?';
            $sth = $connexionBDD -> prepare($query);
            $sth -> bindValue(1, $_GET['id'], PDO::PARAM_INT);
            $sth->execute();*/

include "monCompte.phtml";