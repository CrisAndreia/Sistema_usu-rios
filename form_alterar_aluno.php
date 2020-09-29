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
	
    $id_usuario = $_GET['id_usuario'];
	$nome = $login = $senha = "";
	$link = mysqli_connect('localhost', 'root', '', 'sistema_login');

	$query = "SELECT * FROM usuarios WHERE id_usuario ='$id_usuario'";
	$result = mysqli_query($link, $query);
	if ($row = mysqli_fetch_row($result)) {
		$nome = $row[1];
		$login = $row[2];
		$senha = $row[3];
	}

	mysqli_close($link);


	echo "

	<form action='alterar_aluno.php' method='post'>
			<input type='hidden' value=$id_usuario'' name='id_usuario'>

            <p><span class='error'>* Campo obrigatório</span></p>
            <p>
                Nome: <input type='text' id='nome' name='nome' value='$nome'>
        
            </p>
            <p>
                Login: <input type='text' id='login' name='login' value='$login'>
        
            </p>
            <p>Senha: <input type='password' name='senha' value='$senha' id='senha'>
                
            </p>

            <input type='submit' value='Salvar Alterações'>
        </form>";

	?>

</body>

</html>