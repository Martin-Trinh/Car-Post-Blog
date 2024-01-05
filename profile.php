<?php
session_start();
require_once('config/db_config.php');
require_once('controller/functions.php');
require_once('services/Pagination.php');



if (isset($_GET['username'])) {
  if(!isset($_GET['page']))
    $page = 1;
  else
    $page = intval(filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT));
  $postPerPage = 5;

  $username = filter_var($_GET['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $user = findUserByUsername($conn, $username);
  $totalPost = countPostFromUser($conn, $user['user_id']);
  $allPosts = selectPostsFromUser($conn, $user['user_id'], $postPerPage, ($page - 1) * $postPerPage);
  $pagination = new Pagination($postPerPage, $totalPost);
  $pageLinks = $pagination->getPageLinks($page);
}
?>
<?php
include 'partials/header.php';
include 'partials/notification.php' 
?>
<main class="container">
  <?php
  include 'partials/toTopBtn.php';
  include 'partials/themeBtn.php';
  ?>
  <section class="trending-article">
    <?php if (!isset($allPosts) || count($allPosts) === 0) : ?>
      <div class="server-msg error">Cannot find this profile</div>
    <?php else : ?>
      <h2 class="section-heading"><?= $username ?></h2>
      <div class="manage-links">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
          <a href="admin/manageUser.php">Users</a>
        <?php endif ?>
      </div>
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
      <div class="pagination">
        <ul>
          <?php if($page === 1) : ?>
            <li><a href="" class="disabled">Prev</a></li>
          <?php else: ?>
            <li><a href="?username=<?=$username?>&page=<?= $page - 1?>">Prev</a></li>
          <?php endif ?>
          <?php for($i = 0; $i < count($pageLinks); $i++): ?>
              <?php if($pageLinks[$i]['data'] === $page) : ?>
                <li><a href="?username=<?=$username?>&page=<?= $page ?>" class="active"><?=$pageLinks[$i]['data']?></a></li>
              <?php else : ?>
                <li><a href="?username=<?=$username?>&page=<?= $pageLinks[$i]['data'] ?>"><?=$pageLinks[$i]['data']?></a></li>
              <?php endif ?>
              <?php if($i < count($pageLinks) - 1 && $pageLinks[$i]['data'] + 1 !== $pageLinks[$i+1]['data']) : ?>
                  <li>...</li>
              <?php endif ?>
            <?php endfor ?>
          <?php if($page === $pagination->getTotalPage()) : ?>
            <li><a href="" class="disabled">Next</a></li>
          <?php else: ?>
            <li><a href="?username=<?=$username?>&page=<?= $page + 1?>">Next</a></li>
          <?php endif ?>
        </ul>
      </div>
    <?php endif ?>
  </section>
</main>
<?php include 'partials/footer.php'; ?>