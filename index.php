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
    <div>
        <h2>User Story</h2>
        <form method="POST" action="get.php">
            <input class="todo_text" type="text" name="todo_text" autocomplete="off">
            <div>
                <input formtarget="blank" type="submit" name="annuler" value="annuler">
                <input type="submit" name="valider" value="valider">
            </div>
        </form>
    </div>
    <?php
        require'connexion.php';
        
        
    ?>  
</body>
</html>