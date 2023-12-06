<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Blog</title>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Styling -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Script -->
    <script src="javascript/themeToggle.js" defer></script>
  </head>
  <body>
    <header>
      <?php include 'partials/nav.php' ?>
      <div class="intro-text">
        <h2>Welcome to world of car's articles</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
          molestias incidunt iusto aperiam. Quasi eius, veritatis neque
          inventore distinctio earum!
        </p>
        <button class="write-btn"><a href="writePost.php">Write an article</a></button>
      </div>
    </header>
    <main class="container">
      <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; ?>
      <section class="trending-article">
        <h2 class="section-heading">Trending articles</h2>
        <div class="trending-list">
          <?php
            for ($i = 0; $i < 3; $i++){
              include 'partials/trendingPostPreview.php';
            } 
          ?>
        </div>
      </section>
      <section class="latest-article">
        <h2 class="section-heading">Latest articles</h2>
        <div class="latest-list">
        <?php
            for ($i = 0; $i < 6; $i++){
              include 'partials/latestPostPreview.php';
            } 
        ?>
        </div>
      </section>
    </main>
    <?php include './partials/footer.php' ?>
  </body>
</html>
