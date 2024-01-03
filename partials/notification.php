<?php
$successMsg = $_SESSION['success'];
$errorMsg = $_SESSION['error'];
$_SESSION['success'] = array();
$_SESSION['error'] = array();
?>


<div class="notifications">
    <?php for ($i = 0; $i < count($successMsg); $i++) : ?>
    <div class="toast success">
        <i class="fa-solid fa-circle-check"></i>
        <p><?= $successMsg[$i] ?></p>
        <i class="fa-solid fa-xmark"></i>
    </div>
    <?php endfor ?>
    <?php for ($i = 0; $i < count($errorMsg); $i++) : ?>
        <div class="toast error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <p><?= $errorMsg[$i] ?></p>
            <i class="fa-solid fa-xmark"></i>
        </div>
    <?php endfor ?>
</div>