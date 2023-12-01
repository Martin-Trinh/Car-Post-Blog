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
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1685097879207-1a897190300f?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="article.php">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1685097879207-1a897190300f?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
        </div>
      </section>
      <section class="latest-article">
        <h2 class="section-heading">Latest articles</h2>
        <div class="latest-list">
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="article-img">
              <img
                src="https://images.unsplash.com/photo-1493238792000-8113da705763?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="article img"
              />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="">
                  Stála u zrodu Tinderu, pak založila seznamku vyladěnou pro
                  ženy. Teď se stahuje, byznys drhne
                </a>
              </h3>
              <a class="category-btn">Technology</a>
              <p class="article-description">
                Společnost Bumble zažívá akciový pád podobně jako některé další
                startupové hvězdy. Změny čekají i zakladatelku Whitney Wolfe
                Herdovou.
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="">Author</a></p>
                  <p class="article-date">13 January 2023</p>
                </div>
                <div class="likes">
                  <p>10 Likes</p>
                </div>
              </div>
            </div>
          </article>
        </div>
      </section>
    </main>
    <?php include './partials/footer.php' ?>
  </body>
</html>
