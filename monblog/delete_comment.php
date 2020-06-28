<?php

/*
  * Dans ce fichier on veut supprimer le commentaire dont l'Id est passé en GET.
  
 * On va donc vérifier l'existence du paramètre GET "id" et qu'il correspond bien à un commentaire existant. Puis on le supprimera !

 1. Récupération du paramètre "id" en GET
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id']))
{
  echo' Merci de préciser l\'id du commentaire !';
}

 // 2. Connexion à la base de données avec PDO
 include('db_connect.php');

// 3. Vérification de l'existence du commentaire
$req = $db->prepare('SELECT * FROM comments WHERE id = ?');
$req->execute(array($_GET['id']));
if ($req->rowCount() === 0)
{
  echo' Aucun commentaire n\'a l\'identifiant entré !';
}
 
 // 4. Suppression réelle du commentaire. On récupère l'identifiant de l'article avant de supprimer le commentaire


$comment = $req->fetch();
$post_id = $comment['post_id'];

$req = $db->prepare('DELETE FROM comments WHERE id = :id');
$req->execute(array($_GET['id']));

/**
 * 5. Redirection vers l'article en question
 */
header("Location: articleindex.php?id=" . $post_id);
$req->closeCursor();
