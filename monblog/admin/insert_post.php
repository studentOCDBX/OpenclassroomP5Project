<?php
if (isset($_POST['post_author'], $_POST['post_title'], $_POST['post_introduction'], $_POST['post_content']))
{
	//connexion à la bdd 
	include('../db_connect.php'); 
	
	if(!empty($_POST['post_author']) && !empty($_POST['post_title']) && !empty($_POST['post_introduction'])&& !empty($_POST['post_content']))
	{
		$post_author = strip_tags($_POST['post_author']);
		$post_title = strip_tags($_POST['post_title']);
		$post_introduction = strip_tags($_POST['post_introduction']);
		$post_content = strip_tags($_POST['post_content']);

		//Enregistrement du commentaire.
		$ins = $db->prepare('INSERT INTO posts( author, title, introduction, content, creation_date) VALUES(?, ?, ?, ?, NOW()) ');
		$ins->execute(array( $post_author, $post_title, $post_introduction,  $post_content ));
		$ins->closeCursor(); 
			
		echo 'Votre article a bien été posté.'.'<br> Cliquez <a href="../index.php">ici</a> Pour un retour à la page des posts. ';
		/* //Redirection du visiteur vers commentaires.php
		header('Location:../index.php'); */
	}
	else
	{
		echo'Veuillez remplir tous les champs.'.'<br> Ou cliquez <a href="../index.php">ici</a> Pour un retour à la page des posts. ';; 
	}  
}
?>

<!doctype html>
<html lang="fr">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">

      <title>insert_post.php</title>
  </head>
  <body>
      	<div class="container">
          	<h1>Bienvenue sur la page de rédaction d'un blog post !</h1> <br> 
          	<div class="row">
              	<form action="" method="POST">
					<div class="form-group">
						<!-- <label for="author">Votre Pseudo: </label> -->
						<input type="text" class="form-control"  placeholder="Votre Pseudo:" name="post_author" id="author">
					</div>
					<div class="form-group">
						<!-- <label for="title">Titre:</label> -->
						<input type="text" class="form-control" placeholder="Votre titre:" name="post_title" id="title">
					</div>
					<div class="form-group">
						<!-- <label for="introduction">Introduction:</label> -->
						<textarea class="form-control" placeholder="Votre introduction:" name="post_introduction" id="introduction" cols="15" rows="3"></textarea>    
					</div>
					<div class="form-group">
						<!-- <label for="content">Contenu:</label> -->
						<textarea class="form-control" placeholder="Contenu de votre post" name="post_content" id="content" cols="30" rows="10"></textarea>    
					</div>
					<button type="submit" class= "btn, btn-success">Enregistrer votre post</button>
              	</form>
          	</div>
      	</div>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>