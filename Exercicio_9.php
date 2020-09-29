<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Formulario</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <header>
      <h1>Php + MySql</h1>
    </header>
    <section>
    <div>
    <body>

        <?php


        $erroNome = $erroLogin = $erroSenha = "";
        $nome = $login = $senha = "";



        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (empty($_POST["nome"])) {
                $erroNome = getRequiredErrorMessage("Nome");
            } else {
                $nome = test_input($_POST["nome"]);
                if (!preg_match("/^[a-zA-Z ]*$/", $nome)) {
                    $erroNome = "Apenas letras e espaços são permitidos";
                }
            }

            if (empty($_POST["login"])) {
                $erroLogin = getRequiredErrorMessage("Login");
            } else {
                $login = test_input($_POST["login"]);
            }

            if (empty($_POST["senha"])) {
                $erroSenha = getRequiredErrorMessage("Senha");
            } else {
                $senha = test_input($_POST["senha"]);
                if (!preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){5,20}$/", $senha)) {
                    $erroSenha = "A senha deve conter letras maiúsculas e minúsculas, números, caracteres especiais e entre 5 a 20 caracteres";
                }
            }
            
            if (canSave($erroNome, $erroLogin, $erroSenha)) {
                save($nome, $login, $senha);
            }
        }



        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function getRequiredErrorMessage($fieldName)
        {
            return $fieldName . " é obrigatório";
        }

        function canSave($erroNome, $erroLogin, $erroSenha)
        {
            return (empty($erroNome) && empty($erroLogin) && empty($erroSenha));
        }

        function save($nome, $login, $senha)
        {
            $link = mysqli_connect("localhost", "root", "", "sistema_login");
            $query = "INSERT INTO usuarios (nome, logins, senha) VALUES ('$nome', '$login', '$senha')";
            echo "INSERT: $query<br><hr>";
            mysqli_query($link, $query);
            mysqli_close($link);
        }

        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <p><span class="error">* Campo obrigatório</span></p>
            <p>
                Nome: <input type="text" name="nome" id="nome">
                <span class="error">* <?php echo $erroNome; ?></span>
            </p>
            <p>
                Login: <input type="text" name="login" id="login">
                <span class="error">* <?php echo $erroLogin; ?></span>
            </p>
            <p>Senha: <input type="password" name="senha" id="senha">
                <span class="error">* <?php echo $erroSenha; ?></span>
            </p>

            <input type="submit" value="Submit">
            <input type="reset" value="Limpar campos">
        </form>

        <?php
        echo "<h2>Seus Dados:</h2>";
        echo "Nome: " . $nome;
        echo "<br>";
        echo "Login: " . $login;
        echo "<br>";
        echo "Senha: " . $senha;
        echo "<br>";
        ?>

        <br>
        <br>
        <br>


        <form action="listAction.php" method="POST">
            <fieldset>
                <legend>Listar cadastros</legend>
                <input type="submit" value="Listar">
            </fieldset>
        </form>


    </body>
      </div>
      <div>
      </div>
    </section>
    <footer>
      <p>&copy; CristianeAndreiaPereira</p>
    </footer>
  </body>
</html>

