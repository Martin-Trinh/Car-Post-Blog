 <?php 
 session_start();

$usernameState = isset($_SESSION['errorMsg']['username']) ? 'error': '';
$passwordState = isset($_SESSION['errorMsg']['password']) ? 'error': '';

 $usernameValue = $_SESSION['formData']['username'] ?? '';
 $passwordValue = $_SESSION['formData']['password'] ?? '';

 $usernameErr = $_SESSION['errorMsg']['username'] ?? '';
 $passwordErr = $_SESSION['errorMsg']['password'] ?? '';
 
unset($_SESSION['errorMsg']);
unset($_SESSION['formData']);

 ?>   
    
    
    <?php include 'partials/header.php' ?>
    <main class="container">
    <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; ?>
        <!-- <script src="javascript/validation.js" defer></script>
        <script src="javascript/validationLogin.js" defer></script> -->
        <div class="container form-container">
            <h2>Log In</h2>
            <form action="./controller/logInController.php" method="POST" id="form">
                <div class="form-field <?= $usernameState?>">
                    <label for="username">Username</label>
                    <input type="text" placeholder="username" value="<?= $usernameValue?>" name="username" id="username" autocomplete="off" autofocus>
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small><?= $usernameErr ?></small>
                </div>
                <div class="form-field <?= $passwordState ?>">
                    <label for="password">Password</label>
                    <input type="password" placeholder="password" value="<?= $passwordValue ?>" name="password" id="password" autocomplete="off">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small><?= $passwordErr ?></small>
                </div>
                <button type="submit" name="submit">Log In</button>
                <p class="login-redirect">Don't have an account? <a href="sign-up.php">Sign Up</a></p>
            </form>
        </div>
    </main>
    <?php include './partials/footer.php' ?>

</body>

</html>