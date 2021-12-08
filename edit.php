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

            $temp_text = ($mysqli->query("SELECT * FROM todo_list WHERE id = $id_value "))->fetch_assoc();
            
            echo "<div>
                    <h2>User Story  {$id_value}</h2>
                    <form method='GET' action='app.php'>
                            <input class='todo_text' type='textarea' name='edit_text' autocomplete='off' value='{$temp_text['todo_text']}'>
                            <input type='hidden' name='edit_text_id' value='{$id_value}'>
                            <input type='submit' name='confirmer' value='confirmer'>
                            <input type='reset' name='annuler' value='annuler'>
                    </form>
                </div>"

    ?>  
</body>
</html>

