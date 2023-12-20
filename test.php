<?php
require_once ('config/db_config.php');
require_once('controller/functions.php');
session_start();
$post = selectPostById($conn,5);
echo "id: " . $_SESSION['id'];
echo "post: ".$_SESSION['post'];

if(isset($post)){
    echo "<pre>";
    print_r ($post);
    echo "</pre>";

}
else{
    echo "nothing";
}
echo "</pre>";