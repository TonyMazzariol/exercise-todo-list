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

        // GET TEXT TO DISPLAY

            $id_value = $_GET['id_temp'] ;

            $text = ($mysqli->query("SELECT * FROM todo_list WHERE todo_list_id = $id_value "));
            
            foreach ($text as $key) {
                $temp_text = $key['todo_text'];
            };

        // JOIN TABLES

        $linked = $mysqli->query("SELECT * FROM todo_list 
        INNER JOIN link ON todo_list_id = todo_id
        INNER JOIN user_list ON user_list_id = user_id");
        ?>
 
        <!-- SHOW PAGE -->
            
    <div>
    
    <h2>To Do  <?= $id_value ?></h2>

    <div class='edit_users'>
        <?php
        foreach ($linked as $key) {
            if ($key['todo_text'] == $temp_text) { ?>
                <form action="delete_modify.php" method="GET">
                <div>
                    <div><?= $key['user_name'] ?></div>    
                    <input name='user_id_temp' type='hidden' value="<?=$key['user_list_id'] ?>">
                    <input name='todo_id_temp' type='hidden' value="<?= $key['todo_list_id'] ?>">
                    <input type='submit' name='delete_user_link' value='Supprimer utilisateur'>
                </div>
                </form>
            <?php } 
        } ?>
        </div>

        <form method='GET' action='delete_modify.php'>
            <textarea class='todo_text' name='edit_text' autocomplete='off' ><?=$temp_text?></textarea>
            <input type='hidden' name='edit_text_id' value='<?=$id_value?>'>
            <input type='submit' name='confirmer' value='confirmer'>
            <input type='reset' name='annuler' value='annuler'>                        
            <input type='submit' name='retour' value='retour'>
        </form>
    </div>
</body>
</html>

