<?php
session_start();
require_once('config/db_config.php');
require_once('model/PostRepository.php');
require_once('services/Pagination.php');

if (isset($_GET['category'])) {
  if(!isset($_GET['page']))
    $page = 1;
  else
    $page = intval(filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT));
  
  $category = filter_var($_GET['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $postPerPage = 5;

  $postRepo = new PostRepository($conn);
  $allPosts = $postRepo->selectPostsByCategory($category, $postPerPage, ($page - 1) * $postPerPage);
  $totalPost = $postRepo->countPostsByCategory($category);

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
      <div class="server-msg error">No articles in this category</div>
    <?php else : ?>
      <h2 class="section-heading"><?= $category ?></h2>
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
                  <p><a class="article-author" href="profile.php?username=<?= $allPosts[$i]['username'] ?>"><?= $allPosts[$i]['username'] ?></a></p>
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
            <li><a href="?category=<?=$category?>&page=<?= $page - 1?>">Prev</a></li>
          <?php endif ?>
          <?php for($i = 0; $i < count($pageLinks); $i++): ?>
              <?php if($pageLinks[$i]['data'] === $page) : ?>
                <li><a href="?category=<?=$category?>&page=<?= $page ?>" class="active"><?=$pageLinks[$i]['data']?></a></li>
              <?php else : ?>
                <li><a href="?category=<?=$category?>&page=<?= $pageLinks[$i]['data'] ?>"><?=$pageLinks[$i]['data']?></a></li>
              <?php endif ?>
              <?php if($i < count($pageLinks) - 1 && $pageLinks[$i]['data'] + 1 !== $pageLinks[$i+1]['data']) : ?>
                  <li>...</li>
              <?php endif ?>
            <?php endfor ?>
          <?php if($page === $pagination->getTotalPage()) : ?>
            <li><a href="" class="disabled">Next</a></li>
          <?php else: ?>
            <li><a href="?category=<?=$category?>&page=<?= $page + 1?>">Next</a></li>
          <?php endif ?>
        </ul>
      </div>
    <?php endif ?>
  </section>
</main>
<?php include 'partials/footer.php'; ?>