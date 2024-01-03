
<nav id="navbar">
    <h2 class="page-logo">
        <a href="index.php">Car Blog</a>
    </h2>
    <ul class="menu">
        <li class="topic">
            <a href="">Topics</a>
            <ul class="dropdown">
                <li><a href="../category.php?category=News">News</a></li>
                <li><a href="../category.php?category=Interesting facts">Interesting facts</a></li>
                <li><a href="../category.php?category=Reviews">Reviews</a></li>
                <li><a href="../category.php?category=Technology">Technology</a></li>
            </ul>
        </li>
        <li><a href="">Images</a></li>
        <li><a href="about-us.php">About us</a></li>
        <li><a href="faq.php">FAQ</a></li>
    </ul>
    <?php if(isset($_SESSION['user'])): ?>
        <div class="nav-profile">
            <a class="profile-btn" href="../profile.php?username=<?= $_SESSION['user']['username']?>"><?= $_SESSION['user']['username'] ?></a>
            <small><?= $_SESSION['user']['role'] ?></small>
            <a class="logout-btn" href="../controller/logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    <?php else: ?>
        <div class="login">
            <button class="login"><a href="login.php">Log in</a></button>
            <button class="sign-up"><a href="sign-up.php">Sign Up</a></button>
        </div>
    <?php endif ?>
</nav>