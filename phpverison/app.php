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
    <h2>TO DO LIST </h2>
    <button class="add_story"><a href="index.php">Ajouter une User Story</a></button>
    <?php
        require'connexion.php';
        if(isset($_GET['todo_text']) === true){
            $value = $_GET['todo_text'];

            $max_id = $mysqli->query("SELECT MAX(id) FROM todo_list");

            $new_id = 1 + intval(($max_id->fetch_assoc())['MAX(id)']);

            $mysqli->query("INSERT INTO todo_list (todo_text, id) VALUES ('$value', '$new_id')");  
            header("Location: app.php");
        }

        $all = $mysqli->query('SELECT * FROM todo_list');
        // var_dump($all);
        // $all = $all->fetch_array();
        
        echo "<table>
        <tr>
            <th>ID</th>
            <th colspan='2' >User Story</th>
            
        </tr>";
        foreach ($all as $temp) {
            echo " 
            <tr >
                <th>id : {$temp['id']}</th>
                <th>{$temp['todo_text']}</th>
                <th>
                    <form method='GET' action=''>
                        <input name='id_temp' type='hidden' value='{$temp['id']}'>
                        <input type='submit' name='Delete' value='Supprimer'>
                    </form>
                    <form method='GET' action='edit.php'>
                        <input name='id_temp' type='hidden' value='{$temp['id']}'>
                        <input type='submit' name='modifier' value='Modifier'>
                    </form>
                </th>
            </tr>
            ";     
        };
        if (isset($all)) {
            echo "
                <tr>
                    <th>##</th>
                    <th>empty</th>
                </tr>
            ";
        }
        echo "</table>";
        
        echo "<br>
        <form method='GET'>
            <input type='submit' name='deleteAll' value='Supprimer tout'>
        </form>
        ";

        if(isset($_GET['deleteAll']) === true){
            $mysqli->query("DELETE FROM todo_list");
            header("Refresh:0; url=app.php");
            echo "ERASE ALL";
        };

        if(isset($_GET['Delete']) === true){
            $id_value = intval($_GET['id_temp']);
            $mysqli->query("DELETE FROM todo_list WHERE id = $id_value ");
            header("Location: app.php");
        };

        if(isset($_GET['confirmer']) === true){
            $text_value = $_GET['edit_text'];
            $text_id_value = intval($_GET['edit_text_id']);
            var_dump($text_id_value);
            var_dump($text_value);
            $mysqli->query("UPDATE todo_list SET todo_text = ('$text_value') WHERE id = $text_id_value"); 
            header("Location: app.php");    
        };

        ?>

</body>
</html>