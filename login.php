    <?php include 'partials/header.php' ?>
    <main class="container">
        <script src="javascript/validation.js" defer></script>
        <script src="javascript/validationLogin.js" defer></script>
        <div class="container form-container">
            <h2>Log In</h2>
            <form action="/" method="POST" id="form">
                <div class="form-field">
                    <label for="username">Username</label>
                    <input type="text" placeholder="username" id="username" autocomplete="off" autofocus>
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small>Error message</small>
                </div>
                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" placeholder="password" id="password" autocomplete="off">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small>Error message</small>
                </div>
                <button type="submit">Log In</button>
                <p class="login-redirect">Don't have an account? <a href="sign-up.html">Sign Up</a></p>
            </form>
        </div>
    </main>
    <?php include './partials/footer.php' ?>

</body>

</html>