<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h2>TO DO LIST</h2>
    <button class="add_story"><a href="index.php">Ajouter une User Story</a></button>
    <?php
        require'connexion.php';

        if(isset($_POST['todo_text']) === true){
            $value = $_POST['todo_text'];

            $max_id = $mysqli->query("SELECT MAX(id) FROM todo_list");

            $new_id = 1 + intval(($max_id->fetch_assoc())['MAX(id)']);

            $mysqli->query("INSERT INTO todo_list (todo_text, id) VALUES ('$value', '$new_id')");  
        }

        $all = $mysqli->query('SELECT * FROM todo_list');
        // var_dump($all);
        // $all = $all->fetch_array();
        
        echo "<table>
        <tr>
            <th>ID</th>
            <th>User Story</th>
            <th></th>
        </tr>";
        foreach ($all as $temp) {
            echo " 
            <tr>
                <th>id : {$temp['id']}</th>
                <th>{$temp['todo_text']}</th>
                <th><form method='GET' action=''>
                <input type='submit' name='Supp' value='Supprimer'>
                </form>
            
                </th>
            </tr>
            ";     
        };
        echo "</table>";
        
        echo "<br>
        <form method='GET'>
            <input type='submit' name='SuppAll' value='Supprimer tout'>
        </form>
        ";

        if(isset($_GET['SuppAll']) === true){
            $mysqli->query("DELETE FROM todo_list");
            header("Refresh:0; url=get.php");
            echo "ERASE ALL";
        };
        if(isset($_GET['Supp']) === true){
            $mysqli->query("DELETE FROM todo_list WHERE id = {$temp['id']}");
            echo "Bye bye";
            header("Refresh:0; url=get.php");
        }
?>
</body>
</html>