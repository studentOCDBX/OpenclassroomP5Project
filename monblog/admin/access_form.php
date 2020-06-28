<!doctype html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<title>formulaire d'accès</title>
	</head>
	<body>
		<div class="container">
			<h1>Formulaire d'accès à la page d'Administration !</h1><br>
			<div class="row">
			<?php
			if(!empty($_POST['login']) && !empty($_POST['pass']))
			{
				$login = $_POST['login'];
				$pass_crypte = crypt($_POST['pass']);
				echo '<p> Ligne à copier dans le .htpasswd : <br/>'.$login . ':'.$pass_crypte.'</p>';
			}
			else //On n'a pas encore rempli le formulaire.
			{
			?>
			<form action="" method="POST">
				<div class="form-group">
					<!-- <label for="login">Login :</label> -->
					<input type="text" class="form-control" name="login" placeholder="Login: " id="login">
				</div>
				<div class="form-group">
					<!-- <label for="password">Mot de passe : </label> -->
					<input type="password" class="form-control" placeholder="Mot de passe:" name="pass" id="password">
				</div>
				<button class="btn btn-success" type="submit" >Crypter</button>
			</form>
			<?php
			}
			?>
			</div>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>