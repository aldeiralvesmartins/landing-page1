
<?php
require_once "includes/header2.php";

        if (!empty($_POST['emailCliente']) || !empty($_POST['senha'])) {

            if (strlen($_POST['emailCliente']) == 0) {
                echo "Usuario ou senha invalidas";
            } else if (strlen($_POST['senha']) == 0) {
                echo "Usuario ou senha invalidas";
            } else {

                $email = $pdo->real_escape_string($_POST['emailCliente']);
                $senha = $pdo->real_escape_string($_POST['senha']);

                $sql = "SELECT  idCliente  FROM cliente  WHERE emailCliente = '$email' AND senha = '$senha'";
                $sql_query = $pdo->query($sql);

                $quantidade = $sql_query->num_rows;

                if ($quantidade == 1) {

                    $usuario = $sql_query->fetch_assoc();
                    $user_dado = mysqli_fetch_assoc($sql_query);
                    if (!$_SESSION) {
                        session_start();
                    }
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];

                    header("location:cliente.php");
                } else {
                    echo "falha ao logar";
                }
            }
        }else{
            echo "Preencha todos campos";
        }


        ?>
<section id="grid-one" class="grid-one main-bg section">
    <div class="main-content grid-one-content"><a href="index.php"><button>Voltar</button></a>

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
                                <input type="password" placeholder="" name="senha" id="codBarras">
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