<?php
require_once ('config/db_config.php');
require_once('controller/functions.php');

echo "<pre>";
$post = selectPostById($conn,10);
if(isset($post))
    echo "something";
else
    echo "nothing";
echo "</pre>";