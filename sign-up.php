<?php include 'partials/header.php' ?>
    <main class="container">
    <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; ?>
        <script src="javascript/validation.js" defer></script>
        <script src="javascript/validationSignUp.js" defer></script>
        <div class="container form-container">
            <h2>Sign Up</h2>
            <form action="controller/signUpController.php" method="POST" id="form">
                <div class="form-field">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="username" id="username" autocomplete="off" >
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small>Error message</small>
                </div>
                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="password" id="password" autocomplete="off" >
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small>Error message</small>
                </div>
                <div class="form-field">
                    <label for="confirm-password">Confirm password</label>
                    <input type="password" name="confirm-password" placeholder="confirm password" id="confirm-password" autocomplete="off">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small>Error message</small>
                </div>
                <button type="submit" name="submit">Sign Up</button>
                <p class="login-redirect">Already have an account? <a href="login.html">Log In</a></p>
            </form>
        </div>
    </main>
    <?php include './partials/footer.php' ?>
</body>
</html>