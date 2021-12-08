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
    <?php
        require'connexion.php';
    ?>  
    <h1>TO DO List</h1>
    <div>
        <h2>User Story</h2>
        <form method="GET" action="app.php">
            <textarea class="todo_text" name="todo_text" autocomplete="off"></textarea>
            <input type="submit" name="valider" value="valider">
            <input type="reset" name="annuler" value="annuler">
        </form>
    </div>
</body>
</html>