<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon Blog</title>
    </head>
    <body>

    </body>
</html>

<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <title>Mon blog!</title>
    </head>
    <body>
        <div class="container">
            <h1>Bienvenue sur mon Super Blog !</h1>  <br> 
            <div class="row">
                <?php

                    $_POST['author'] = strip_tags($_POST['author']);
                    $_POST['comment'] = strip_tags($_POST['comment']);
                    $_GET['post'] = strip_tags($_GET['post']); 
            
                if(!empty($_POST['author'] && $_POST['comment']) && $_GET['post'] > 0 )
                {        
                    //connexion à la bdd 
                    include('db_connect.php');
                
                    //Enregistrement du commentaire.
                    $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW()) ');
                    $req->execute(array($_GET['post'], $_POST['author'], $_POST['comment'] ));
                    $req->closeCursor();
                    
                    echo 'Votre commentaire a bien été ajouté.';
                    
                    header('Location:comments.php?post='.$_GET['post']); //Redirection du visiteur vers commentaires.php
                }
                else
                {
                ?>
                    <p>
                        Veuillez entrer votre pseudo, suivi de votre message. <br>
                        Cliquez <a href="comments.php?post=<?= $_GET['post'] ;?> "> ici </a> pour un retour sur la page des commentaires.
                    </p>
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