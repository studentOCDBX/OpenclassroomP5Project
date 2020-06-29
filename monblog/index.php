    <?php
    include('db_connect.php');
    $post_perPage = 4;
    $current_page = 1;
    $post_numberReq = $db->query('SELECT id FROM posts');
    $post_number = $post_numberReq->rowCount();
    $page_number = ceil($post_number/$post_perPage);
    
    if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] >0 && $_GET['page'] <= $page_number)
    {
        $current_page = $_GET['page'];
        $_GET['page'] = intval($_GET['page']);
    }
    else
    { 
        $current_page = 1;
    }
    $start_entry = ($current_page-1)*$post_perPage;
    //On récupère les cinqs derniers billets
    $req = $db->query('SELECT id, title, introduction, content, DATE_FORMAT(creation_date, \'%e/%m/%Y à %Hh%imin%ss\') AS creation_date FROM posts ORDER BY creation_date DESC LIMIT '.$start_entry.','.$post_perPage);
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
        <h1>Bienvenue sur mon Super Blog !</h1>  <br> 
        <p>Derniers billets du blog :</p>
        <?php
        while ($data = $req->fetch())
         {
        ?>
        <div class="news"> <!--- On affiche les cinq derniers billets. -->
            <?php include('post_view.php');?>
            <br>
                <em>
                    <a href="post_details.php?post=<?= $data['id'] ;?> ">Lire la suite</a> | <a href="delete_post.php?post=<?= $data['id'] ;?> ">Supprimer</a>
                </em>
            </p>  
        </div>          
        <?php
        } // Fin de la boucle des billets.
        $req->closeCursor(); //On libère le curseur pour la prochaine requête.
        //On fait une boucle pour écrire les liens vers chacune des pages.
        echo 'Page :';
        for ($i=1; $i <= $page_number; $i++)
        { 
            if ($i == $current_page)
            {
                echo $i. ' '. '/';
            }
            else
            {
                echo ' <a href="index.php?page='.$i.'">'.$i.'</a> /';
            }
        }
        ?>        
        </body>
    </html>





