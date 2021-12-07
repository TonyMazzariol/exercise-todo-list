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

        if(!isset($_GET['todo_text']) === true){
            
            $a = $mysqli->query("SELECT MAX(id) FROM todo_list");
            $b = $a->fetch_assoc();
           
            $id = 1 + intval($b['MAX(id)']);


            $mysqli->query("INSERT INTO todo_list (todo_text, id) VALUES ('$value', '$id')");
            echo"pass";
 
} else {
    echo "error";
}
 echo "###"

// $a = $mysqli->query('SELECT * FROM todo_list');

// foreach ($a as $temp){
//     print_r($temp);
// }


?>

<!-- <h2>Films Name</h2>

<form method="GET" action="./Delete.php">
<button type="submit" name="add">Add</button>
</form> -->


</body>
</html>