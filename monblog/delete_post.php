<?php

/**
 * Dans ce fichier on veut supprimer le post dont l'Id est passé en GET.
 
 * Il va donc falloir s'assurer du passage en GET du paramètre "id", puis de l'existence du post.
 * Ensuite, on va pouvoir effectivement supprimer le post et rediriger vers la page d'accueil
 */

/*
  1. On vérifie que le GET possède bien un paramètre "id" (delete_post.php?id=2) et que c'est bien un nombre
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id']))
{
  echo' Merci de préciser l\'id du post !';
}

  //2. Connexion à la base de données.
include('db_connect.php');

// 3. Vérification de l'existence du post.
$req = $db->prepare('SELECT * FROM posts WHERE id = ?');
$req->execute(array($_GET['id']));

if ($req->rowCount() === 0) {
    echo ' L\'article n\'existe pas, vous ne pouvez donc pas le supprimer !';
}

 // 4. Suppression effective du post.

$req = $db->prepare('DELETE FROM posts WHERE id = ?');
$req->execute(array($_GET['id']));

// 5. Redirection vers la page d'accueil
header("Location: index.php");
$req->closeCursor();
