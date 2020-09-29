<html>

<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<link href="style.css" rel="stylesheet" type="text/css" />
<body>


    <?php

    $id_usuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $erroNome = $erroLogin = $erroSenha = "";

    $link = mysqli_connect('localhost', 'root', '', 'sistema_login');

    
    if (empty($_POST["nome"])) {
        echo "if nome",
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
        save($link, $nome, $login, $senha, $id_usuario);
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

    function save($link, $nome, $login, $senha, $id_usuario)
    {

        $query = "UPDATE usuarios SET nome = '$nome', logins = '$login', senha = '$senha' WHERE id_usuario = '$id_usuario'";
        echo "UPDATE: $query<br><hr>";

        mysqli_query($link, $query);

        //$query = "SELECT * FROM `usuarios` WHERE 1";
        //$result = mysqli_query($link, $query);

        mysqli_close($link);
    }

    ?>

    <span class="error"> <?php echo $erroNome; ?></span>
    <span class="error"> <?php echo $erroLogin; ?></span>
    <span class="error"> <?php echo $erroSenha; ?></span>

    <form action="listAction.php" method="POST">
        <fieldset>
            <legend>Listar cadastros</legend>
            <input type="submit" value="Listar">
        </fieldset>
    </form>
</body>

</html>