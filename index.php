<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog</title>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Styling -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-print.css" media="print">
    <!-- Script -->
    <script src="javascript/themeToggle.js" defer></script>
    <script src="javascript/notificationHandle.js" defer></script>
  </head>
  <body>
    <header>
      <?php include 'partials/nav.php' ?>
      <div class="intro-text">
        <h1>Welcome to world of car's articles</h1>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
          molestias incidunt iusto aperiam. Quasi eius, veritatis neque
          inventore distinctio earum!
        </p>
        <a class="btn write-btn" href="addPost.php">Write an article</a>
      </div>
      <?php include 'partials/notification.php' ?>
    </header>
    <main class="container">
      <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; 
            include 'partials/trendingPostPreview.php';
            include 'partials/latestPostPreview.php'
      ?>
    </main>
    <?php include './partials/footer.php' ?>
  </body>
</html>
