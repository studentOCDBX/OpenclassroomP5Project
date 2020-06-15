<!doctype html>
<html lang="fr">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Mon Blog</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Mon super blog!</h1>
                    <p>
                        <a href="index.php">Retour à la liste des billets :</a> 
                    </p>
                    <?php
                    //connexion à la bdd 
                    include('db_connect.php');

                    //recupération du billet sélectionné.
                    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%e/%c/%Y à %Hh%imin%Ss\') AS creation_date FROM posts WHERE id = ? ');
                    
                    $req->execute(array($_GET['post']));
                    $data = $req->fetch(); 

                    if(!empty($data))
                    {
                    ?>
                        <div class="news">
                            <h3> 
	                            <?= strip_tags($data['title']); ?> 
	                            <em>le <?= $data['creation_date']; ?></em>
                            </h3>
                            <p>
	                        <?= nl2br(strip_tags($data['content'])); ?>
                        </p> 
                        </div>
                        
                        <h2>Commentaires :</h2>
                    <?php
                    }
                    else
                    {
                        echo 'Désolé mais ce billet n\'existe pas.';  
                        die;                 
                    }
                    
                    $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

                    // Récupération des commentaires liés au billet.
                    $req = $db->prepare('SELECT author, comment, DATE_FORMAT(comment_date, \'%e/%c/%Y à %Hh%imin%Ss\') AS comment_date FROM comments WHERE post_id = ? ORDER BY comment_date ');

                    $req->execute(array($_GET['post']));

                    while($data = $req->fetch())
                    { 
                    ?>                 
                        <p>
                            <strong> <?= strip_tags($data['author']). ':' ;?></strong> le <?= $data['comment_date']; ?>
                        </p>
                        <p>
                            <?= nl2br(strip_tags( $data['comment'])); ?>   
                        </p> 
                    <?php
                    } // Fin de la boucle des commentaires. 
                    $req->closeCursor();
                    ?>
                     
                    <form action="comments_post.php?post=<?= $_GET['post'] ;?>" method="POST"> <!--formulaire pour ajout d'un commentaire -->
                        <div class= "form-group col-md-3"> 
                             <label for= "author" >Pseudo : </label> 
                             <input type= "text" class= "form-control" name="author" id= "author" placeholder= "Votre Pseudo :" > 
                        </div>
                        <div class= "form-group col-md-6" >
                            <label for= "comment" >Commentaire : </label>
                            <textarea  class= "form-control" name="comment" id="comment" placeholder= "Votre commentaire:"  cols="30" rows="10"></textarea>
                        </div> 
                        <button type="submit" class="btn btn-success" >Envoyer</button>
                    </form>                               
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>