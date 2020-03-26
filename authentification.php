<?php

	if(!empty($_POST))
	{
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

		$query = 'SELECT id, pseudo, mdpHash  FROM auteurs WHERE pseudo = ?';
		$sth = $connexionBDD -> prepare($query);
		$sth -> bindValue(1, $_POST['pseudo'], PDO::PARAM_STR);
		$sth->execute();
		$utilisateur = $sth->fetch();

		if($utilisateur !== false AND password_verify(trim($_POST['mdpHash']), $utilisateur['mdpHash']))
		{
			session_start();

			$_SESSION['authentification'] = intval($utilisateur['id']);
                    
			header('Location: ./monCompte.php');
			exit;
		}
		else
		{

			header('Location: ./');
			exit;
		}
	}

include 'authentification.phtml';