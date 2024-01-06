<?php
function convertDate($date){
    $datetime = new DateTime($date);
    return $datetime->format('d F Y, H:i:s');
}