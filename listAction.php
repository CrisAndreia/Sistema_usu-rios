<html>
<link href="style.css" rel="stylesheet" type="text/css" />
<body>

    <?php
    include("Exercicio_9.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $link = mysqli_connect("localhost", "root", "", "sistema_login");
            
        $query = "SELECT * FROM usuarios ORDER BY id_usuario";
        $result = mysqli_query($link, $query);
        
        echo "SELECT: $query<br>";
        echo "<table border=\"1\", align=center>";
        echo "<tr><td><b>Id</b></td>";
        echo "<td><b>Nome</b></td>";
        echo "<td><b>Login</b></td>";
        echo "<td><b>Senha</b></td>";
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr><td>".$row[0]."</td>";
            echo "<td>".$row[1]."</td>";
            echo "<td>".$row[2]."</td>";
            echo "<td>".$row[3]."</td>";
            
            echo "<td><a href=\"deletar_aluno.php?id_usuario=".$row[0]."\">deletar</a>";
            echo "<td><a href=\"form_alterar_aluno.php?id_usuario=".$row[0]."\">alterar</a></tr>";
        }
        echo "</table><hr>";
        
        mysqli_close($link);
        
    }


    ?>
</body>


</html>