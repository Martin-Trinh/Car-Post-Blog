<?php 
// init session variables for notifications
if(!isset($_SESSION['success'])){
    $_SESSION['success'] = array();
}
if(!isset($_SESSION['error'])){
    $_SESSION['error'] = array();
}
?>
<nav id="navbar">
    <h2 class="page-logo">
        <a href="index.php">Car Blog</a>
    </h2>
    <ul class="menu">
        <li class="topic">
            <a href="">Topics</a>
            <ul class="dropdown">
                <li><a href="category.php?category=News">News</a></li>
                <li><a href="category.php?category=<?= rawurlencode('Interesting facts')?>">Interesting facts</a></li>
                <li><a href="category.php?category=Reviews">Reviews</a></li>
                <li><a href="category.php?category=Technology">Technology</a></li>
            </ul>
        </li>
        <li><a href="about-us.php">About us</a></li>
        <li><a href="faq.php">FAQ</a></li>
    </ul>
    <?php if(isset($_SESSION['user'])): ?>
        <div class="nav-profile">
            <div class="user-info-nav">
                <p><a class="profile-btn" href="profile.php?username=<?= rawurlencode($_SESSION['user']['username'])?>"><?= $_SESSION['user']['username'] ?></a></p>
                <p><small><?= $_SESSION['user']['role'] ?></small></p>
            </div>
            <a class="logout-btn" href="controller/logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    <?php else: ?>
        <div class="login">
            <a href="login.php" class="btn nav-btn">Log in</a>
            <a href="sign-up.php" class="btn nav-btn">Sign Up</a>
        </div>
    <?php endif ?>
    </nav>