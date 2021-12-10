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
    <nav>
        <div>
            <h2>TO DO LIST </h2>
            <button class="add_story"><a href="index.php">Ajouter un To Do</a></button>
        </div>
        <div>
        <form method="GET" action="app.php">
            <input type="text" class="user_text" name="user_add" autocomplete="off"></input>
            <input type="submit" name="user" value="Ajouter un utilisateur">
            <input type="reset" name="annuler" value="annuler">
        </form>
        </div>
    </nav>  
    <?php

        require'connexion.php';

        // GRAB ALL
        
        $all_todo = $mysqli->query('SELECT * FROM todo_list');
        $all_user = $mysqli->query('SELECT * FROM user_list');
                
        // JOIN TABLES
        
        $linked = $mysqli->query("SELECT * FROM todo_list 
        INNER JOIN link ON todo_list_id = todo_id
        INNER JOIN user_list ON user_list_id = user_id");
        
    ?>
    
    <!-- 
    // SHOW PAGE
    // ASSIGN PART
    -->        

    <div class='assign'>
        <label>Choisir une tache à assigner :</label>
        <form method='GET' action='delete_modify.php'>
            <select name='todo'>
            <?php
                foreach ($all_todo as $temp) {
                    echo "<option value='{$temp['todo_list_id']}'>{$temp['todo_text']}</option>";
                }?>
            </select>
            <label>à :</label>
            <select name='user'>
            <?php
                foreach ($all_user as $temp) {
                    echo "<option value='{$temp['user_list_id']}'>{$temp['user_name']}</option>";
                }?>
            </select>
            <input type='submit' name='assign' value='Assigner une tache'>
        </form>
    </div> 

    <?php    
        // GET NEW TASK (FROM index.php)
        
        if(isset($_GET['todo_text']) === true){
            $id = 1;
            $value = $_GET['todo_text'];
            $all = $mysqli->query('SELECT todo_list_id FROM todo_list');
            foreach ($all as $temp) {
                if ($temp['todo_list_id'] != $id) {
                    break;
                }
                $id++ ;
            }
            $mysqli->query("INSERT INTO todo_list (todo_text, todo_list_id) VALUES ('$value', '$id')");  
            header("Location: app.php");
        }
        
        // GET NEW USER (from HERE)
        
        if(isset($_GET['user_add']) === true && $_GET['user_add'] != NULL ){
            $id = 1;
            $value = $_GET['user_add'];
            $all = $mysqli->query('SELECT user_list_id FROM user_list');
            foreach ($all as $temp) {
                if ($temp['user_list_id'] != $id) {
                    break;
                }
                $id++ ;
            }
            $mysqli->query("INSERT INTO user_list (user_name, user_list_id) VALUES ('$value', '$id')");  
            header("Location: app.php");
        }
        ?>
        
        <!-- 
        // SHOW PAGE
        // TAB ALL TASK
        -->

        <table>
        <tr>
            <th>ID</th>
            <th colspan='3' >To Do</th>
        </tr>
        <?php
        foreach ($all_todo as $temp) { ?> 
            <tr>
                <th>numéro <?= $temp['todo_list_id'] ?></th>
                <th class='text'><?= $temp['todo_text']?></th>
                <th>
                <?php
                    foreach ($linked as $key) {
                        if ($key['todo_text'] == $temp['todo_text']) {
                            ?>
                            <div><?= $key['user_name'] ?></div>
                            <?php
                        }   
                    }?>
                </th>
                <th class='list_button'>
                    <form method='GET' action='delete_modify.php'>
                        <input name='todo_id_temp' type='hidden' value="<?=$temp['todo_list_id']?>">
                        <input type='submit' name='delete_todo' value='Supprimer'>
                    </form>
                    <form method='GET' action='edit.php'>
                        <input name='id_temp' type='hidden' value="<?=$temp['todo_list_id']?>">
                        <input type='submit' name='modifier' value='Modifier'>
                    </form>
                </th>
            </tr>
            <?php
            }?>
        </table>
        <form method='GET' action='delete_modify.php'>
            <input type='submit' name='deleteAll_todo' value='Supprimer tout'>
        </form>

        <!-- // TAB ALL USER -->
        
        <table>
            <tr>
                <th>numéro de l'utilisateur</th>
                <th colspan='1' >Nom de l´utilisateur</th> 
            </tr>
                <?php
                foreach ($all_user as $temp) {?>
                <tr>
                    <th><?= $temp['user_list_id']?></th>
                    <th><?= $temp['user_name']?></th>
                    <th class='list_button'>
                        <form method='GET' action='delete_modify.php'>
                            <input name='user_id_temp' type='hidden' value="<?= $temp['user_list_id']?>">
                            <input type='submit' name='delete_user' value='Supprimer'>
                        </form>
                    </th>
                </tr>
                <?php    
                }?>
            
        </table>
            
        <br>

        <form method='GET' action='delete_modify.php'>
            <input type='submit' name='deleteAll_user' value='Supprimer tout'>
        </form> 
</body>
</html>