<?php
session_start();
// toggle class
$usernameState =  $_SESSION['errorMsg']['username'] ? 'error' : '';
$passwordState = $_SESSION['errorMsg']['password'] ? 'error' : '';
$confirmPassState = $_SESSION['errorMsg']['confirmPass'] ? 'error' : '';
// value 
$usernameValue = $_SESSION['formData']['username'] ?? '';
$passwordValue = $_SESSION['formData']['password'] ?? '';
$confirmPassValue = $_SESSION['formData']['confirm-password'] ?? '';
// error msg
$usernameErr =  $_SESSION['errorMsg']['username'] ?? '';
$passwordErr = $_SESSION['errorMsg']['password'] ?? '';
$confirmPassErr = $_SESSION['errorMsg']['confirmPass'] ?? '';

unset($_SESSION['errorMsg']);
unset($_SESSION['formData']);
?>

<?php include 'partials/header.php' ?>
<main class="container">
    <?php include 'partials/toTopBtn.php';
         include 'partials/themeBtn.php'; ?>
    <script src="javascript/validation.js" defer></script>
    <script src="javascript/validationSignUp.js" defer></script>
    <div class="container form-container">
        <h2>Sign Up</h2>
        <form action="controller/signUpController.php" method="POST" id="form">
            <div class="form-field <?= $usernameState ?>">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username" id="username" autocomplete="off" value="<?= $usernameValue ?>">
                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-exclamation"></i>
                <small><?= $usernameErr ?></small>
            </div>
            <div class="form-field <?= $passwordState ?>">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" id="password" autocomplete="off" value="<?= $passwordValue ?>">
                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-exclamation"></i>
                <small><?= $passwordErr ?></small>
            </div>
            <div class="form-field <?= $confirmPassState ?>">
                <label for="confirm-password">Confirm password</label>
                <input type="password" name="confirm-password" placeholder="confirm password" id="confirm-password" autocomplete="off" value="<?= $confirmPassValue ?>">
                <i class="fa-solid fa-circle-check"></i>
                <i class="fa-solid fa-circle-exclamation"></i>
                <small><?= $confirmPassErr ?></small>
            </div>
            <button type="submit" name="submit">Sign Up</button>
            <p class="login-redirect">Already have an account? <a href="login.html">Log In</a></p>
        </form>
    </div>
</main>
<?php include './partials/footer.php' ?>
</body>

</html>