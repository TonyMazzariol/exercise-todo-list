<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require'connexion.php';

        $value = $_POST['todo_text'];

        if(isset($_POST['todo_text']) === true){
            
            $max_id = $mysqli->query("SELECT MAX(id) FROM todo_list");

            $new_id = 1 + intval(($max_id->fetch_assoc())['MAX(id)']);

            $mysqli->query("INSERT INTO todo_list (todo_text, id) VALUES ('$value', '$new_id')");
           
            echo"pass <br>";
        } else {
            echo "error <br>";
        }

        $all = $mysqli->query('SELECT * FROM todo_list');
        // var_dump($all);
        // $all = $all->fetch_array();
        var_dump($all);
        echo "<table>";
        foreach ($all as $temp) {
            echo " 
            <tr>
                <th>{$temp['id']}</th>
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
        <form method='GET' action='index.php'>
            <input type='submit' name='SuppAll' value='Supprimer tout'>
        </form>
        ";

        if(isset($_GET['SuppAll']) === true){
            $mysqli->query("DELETE FROM todo_list");
            echo "ERASE ALL";
        };
        if(isset($_GET['Supp']) === true){
            $mysqli->query("DELETE FROM todo_list WHERE id = {$temp['id']}");
            echo "ERASED";
        }
?>

<!-- <h2>Films Name</h2>

<form method="GET" action="./Delete.php">
<button type="submit" name="add">Add</button>
</form> -->


</body>
</html>