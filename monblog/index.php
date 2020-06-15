<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <title>Mon blog</title>
    </head>
    <body>
        <div class="container">
            <h1>Bienvenue sur mon Super Blog !</h1>  <br> 
            <p>Derniers billets du blog :</p>
            <div class="row">
                <?php
                    include('db_connect.php');
                    //On récupère les cinqs derniers billets
                    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%e/%m/%Y à %Hh%imin%ss\') AS creation_date FROM posts ORDER BY creation_date LIMIT 0,5');
                
                while ($data = $req->fetch())
                {
                ?>
                    <div class="news"> <!--- On affiche les cinq derniers billets. -->
                        <h3> 
	                        <?= strip_tags($data['title']); ?> 
	                        <em>le <?= $data['creation_date']; ?></em>
                        </h3>
                        <p>
	                        <?= nl2br(strip_tags($data['content'])); ?>
                            <br>
                            <em>
                                <a href="comments.php?post=<?= $data['id'] ;?> ">Commentaires</a>
                            </em>
                        </p>  
                    </div>
                <?php
                } // Fin de la boucle des billets.
                $req->closeCursor(); //On libère le curseur pour la prochaine requête
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