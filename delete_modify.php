<?php
require'connexion.php';

if(isset($_GET['deleteAll_todo']) === true){
    $mysqli->query("DELETE FROM todo_list");
    header("Refresh:0; url=app.php");
};
if(isset($_GET['deleteAll_user']) === true){
    $mysqli->query("DELETE FROM user_list");
    header("Refresh:0; url=app.php");
};

if(isset($_GET['delete_todo']) === true){
    $id_value = intval($_GET['todo_id_temp']);
    $mysqli->query("DELETE FROM todo_list WHERE todo_list_id = $id_value ");
    $mysqli->query("DELETE FROM link WHERE todo_id = $id_value ");
     header("Location: app.php");
};

if(isset($_GET['delete_user']) === true){
    $id_value = intval($_GET['user_id_temp']);
    $mysqli->query("DELETE FROM user_list WHERE user_list_id = $id_value ");
    $mysqli->query("DELETE FROM link WHERE user_id = $id_value ");
    header("Location: app.php");
};

if(isset($_GET['delete_user_link']) === true){
    $id_value = intval($_GET['user_id_temp']);
    $id_value2 = intval($_GET['todo_id_temp']);
    $mysqli->query("DELETE FROM link WHERE user_id = $id_value AND todo_id = $id_value2 ");
    header("Location: app.php");
};

if(isset($_GET['confirmer']) === true){
    $id_value = $_GET['edit_text_id'];
    $edit_text = $_GET['edit_text'];
    $mysqli->query("UPDATE todo_list SET todo_text = '$edit_text' WHERE todo_list_id = $id_value");  
    header("Location: app.php"); 
}; 

if(isset($_GET['retour']) === true){
    header("Location: app.php");    
};    
           

// ASSIGNING
$link = $mysqli->query("SELECT * FROM link");

if(isset($_GET['assign']) === true){
    $user_id = $_GET['user'];
    $todo_id = $_GET['todo'];
        
    $request = $mysqli->query("INSERT INTO link (user_id, todo_id) VALUES ('$user_id', '$todo_id')");  

    if ($request == TRUE) {
        echo "CA PASSE";
    } else {
        echo "CA CASSE";
    };
    header("Location: app.php");
};        
?>