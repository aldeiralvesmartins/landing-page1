<?php
require_once "config.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Open+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/elementes.css">
    <link rel="stylesheet" href="assets/css/classes.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/menu.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>


<section id="grid-one" class="grid-one main-bg section">
    <div class="main-content grid-one-content">
        <?php

        if (isset($_POST["sumit"])) {



            $email = $_POST['emailCliente'];
            $senha = $_POST['senha'];

                $sq = "SELECT  idCliente  FROM cliente  WHERE emailCliente ='$email' AND senha = '$senha'";
                $res = $pdo->query($sql);

            if (!empty($senha) && !empty($email)) {



                header('location:index.php');
                return true;
            }else{
                echo "senha ou email incorreto";
            }
        }
        ?>
        <form method="post">
            <section id="home" met class=" main-bg ">
                <div class="intro-content">
                    <div class="">
                        <h2>login</h2>
                        <fieldset class="">



                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" placeholder="" name="emailCliente" id="email">
                            </div>

                            <div class="form-group ">
                                <label>Senha</label>
                                <input type="password" placeholder="" name="codBarras" id="codBarras">
                            </div>

                            <div class="form-group full-width">
                                <button type="submit" value="Cadastrar">Cadastrar</button>
                            </div>

                        </fieldset>
                    </div>
                </div>
        </form>
</section>
</div>
</section>



</body>

</html>