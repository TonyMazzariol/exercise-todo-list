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
    <h1>TO DO List</h1>
    <?php
        require'connexion.php';

            $id_value = intval($_GET['id_temp']);

            $temp_text = ($mysqli->query("SELECT * FROM todo_list WHERE todo_list_id = $id_value "))->fetch_assoc();
            
        // JOIN TABLES

        $a = $mysqli->query("SELECT * FROM todo_list 
        INNER JOIN link ON todo_list_id = todo_id
        INNER JOIN user_list ON user_list_id = user_id");

            echo "<div>
                    <h2>User Story  {$id_value}</h2>
                    <form method='GET' action='app.php'>
                            <textarea class='todo_text' name='edit_text' autocomplete='off' value='{$temp_text['todo_text']}'></textarea>
                            <div>
                            ";
                            foreach ($a as $key) {
                                if ($key['todo_text'] == $temp_text['todo_text']) {
                                    echo "<div>{$key['user_name']}</div>
                                    <form method='GET' action='delete_modify.php'>
                                    <input name='user_id_temp' type='hidden' value='{$key['user_list_id']}'>
                                    <input type='submit' name='delete_user_link' value='Supprimer utilisateur'>
                                    </form>
                                    ";
                                }
                            };
                           echo "
                            </div>
                            <input type='hidden' name='edit_text_id' value='{$id_value}'>
                            <input type='submit' name='confirmer' value='confirmer'>
                            <input type='reset' name='annuler' value='annuler'>
                            <input type='submit' value='retour'>
                    </form>
                </div>";
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

