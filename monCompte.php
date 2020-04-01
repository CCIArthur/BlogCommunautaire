<?php


//var_dump($_SESSION['authentification']);
/*if(!array_key_exists('authentification',$_SESSION))
{
    header('Location:authentification.php');
    exit;
}*/

//else
//{

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
    if(!empty($_POST))
    {
        $titre = trim($_POST['titre']);
        $contenu = trim($_POST['contenu']);
        

        if(array_key_exists('fichier', $_FILES))
        {
            if($_FILES['fichier']['error'] === 0)
            {
                if(in_array(mime_content_type($_FILES['fichier']['tmp_name']), ['image/png', 'image/jpeg']))
                {
                    if($_FILES['fichier']['size'] < 3000000)
                    {
                        $image = $_SESSION['authentification'] . "-" . uniqid() . "." . pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES['fichier']['tmp_name'], 'img/' . $image);
                    }
                }
            }
        }
    }
    //var_dump($_FILES);
    

    $query = 'SELECT * from posts WHERE idAuteur = ? ORDER BY datePublication DESC';
    $sth = $connexionBDD -> prepare($query);
    $sth -> execute([1 => $_SESSION[/*id de l'utilisateur*/]]);
    $posts = $sth -> fetchAll();
    var_dump($posts);


    //ajouter un post
    if(isset($_POST['ajouter']))
    {
        $query = 'INSERT INTO posts (titre, contenu, image, idAuteur) VALUES(?, ?, ?, ?)';
        $sth = $connexionBDD -> prepare($query);
        $sth -> bindValue(1, $titre, PDO::PARAM_STR);
        $sth -> bindValue(2, $contenu, PDO::PARAM_STR);
        $sth -> bindValue(3, $image, PDO::PARAM_STR);
        $sth -> bindValue(4, $_SESSION['authentification'], PDO::PARAM_STR);
        $sth -> execute();
    }


    //supprimer un post
    if(isset($_POST['supprimer']))
    {
        foreach($posts as $post)
        {
            $idPost = $post['id'];
        }
        $query 'DELETE * FROM posts WHERE id = ?';
        $sth = $connexionBDD -> prepare($query);
        $sth -> bindParam('?', $idPost, PDO::PARAM_STR);
        $sth -> execute();
    }

    //modifier un post
    if(isset($_POST['modifier']))
    {
        //ouvrir une page pour avec toutes les infos necessaire a la création de l'article ?
        // quand tout OK, bouton submit -> supprime l'ancien post, et crée celui ci.
    }

//} fin du else
    include 'monCompte.phtml';

