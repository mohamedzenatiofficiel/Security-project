<?php
    // code source de connexion.php
    $host = "localhost";
    $user_mysql = "root";    // nom de l'utilisateur MySQL 
    $password_mysql = "";    // mot de passe de l'utilisateur MySQL
    $database = "securite";

    $db = mysqli_connect($host, $user_mysql, $password_mysql, $database);
    
    if(!$db)
    {
        echo "Echec de la connexion\n";
        exit();
    }

    mysqli_set_charset($db, "utf8");
 
?>

<!DOCTYPE>
<html>
    <head>
        <title></title>
        <style>
            input
            {
                display: block;
            }
        </style>
    </head>
    <body>
        <h1>Connexion au site d'administration</h1>

        <?php
        if(!empty($_GET['username']) && !empty($_GET['password']))
        {
            $username = $_GET['username'];
            $password = $_GET['password'];

            #$query = "SELECT id, username FROM users WHERE username = '".$username."' AND password = '".$password."'";
            $query = "SELECT * FROM `users` WHERE username = '".$username."' AND password = '".$password."' ";
            $rs = mysqli_query($db, $query);
           
            if(mysqli_num_rows($rs) == 1)
            {
                $user = mysqli_fetch_assoc($rs);

                echo "Bienvenue ".htmlspecialchars($_GET['username']);
            }
            else
            {
                echo "Mauvais nom d'utilisateur et/ou mot de passe !";
            }

            mysqli_free_result($rs);
            mysqli_close($db);
        }
        ?>

        <form action="index.php" method="GET">
            <b>Nom d'utilisateur :</b> <input type="text" name="username"/>
            <b>Mot de passe :</b> <input type="text" name="password" />
            <input type="submit" value="Connexion" />
        </form>
    </body>
</html>





