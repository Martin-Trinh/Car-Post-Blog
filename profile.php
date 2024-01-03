<?php
session_start();
require_once('config/db_config.php');
require_once('controller/functions.php');
include 'partials/header.php';
?>
<?php include 'partials/notification.php' ?>
<main class="container">
  <?php
  include 'partials/toTopBtn.php';
  include 'partials/themeBtn.php';
  ?>
  <?php
  // get array of posts from database
  if (isset($_GET['username'])) {
    $username = filter_var($_GET['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user = findUserByUsername($conn, $username);
    $allPosts = selectPostsFromUser($conn, $user['user_id'], 5, 0);
  }
  ?>
  <section class="trending-article">
    <?php if (!isset($allPosts) || count($allPosts) === 0) : ?>
      <div class="server-msg error">Cannot find this profile</div>
    <?php else : ?>
      <h2 class="section-heading"><?= $username ?></h2>
      <div class="trending-list">
        <?php for ($i = 0; $i < count($allPosts); $i++) : ?>
          <article class="article">
            <div class="article-img">
              <img src="img/<?= $allPosts[$i]['thumbnail'] ?>" alt="article img" width="100" height="350" />
            </div>
            <div class="article-info">
              <h3 class="article-heading">
                <a href="article.php?id=<?= $allPosts[$i]['post_id'] ?>">
                  <?= $allPosts[$i]['title'] ?>
                </a>
              </h3>
              <a class="category-btn" href="category.php?category=<?= $allPosts[$i]['category'] ?>"><?= $allPosts[$i]['category'] ?></a>
              <p class="article-description">
                <?= substr($allPosts[$i]['body'], 0, 300) . '  ...' ?>
              </p>
              <div class="article-data">
                <div class="author">
                  <p><a class="article-author" href="profile.php?username=<?= $allPosts[$i]['username']?>"><?= $allPosts[$i]['username'] ?></a></p>
                  <p class="article-date"><?= $allPosts[$i]['publish_datetime'] ?></p>
                </div>
                <div class="likes">
                  <p><?= $allPosts[$i]['likes'] ?> Likes</p>
                </div>
              </div>
            </div>
          </article>
        <?php endfor ?>
      </div>
    <?php endif ?>
  </section>
</main>
<?php include 'partials/footer.php'; ?>