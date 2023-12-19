<?php 
  require_once ('config/db_config.php');
  require_once('controller/functions.php');
  // get array of posts from database
  define("IMG_WIDTH", 100);
  define("IMG_LENGTH", 300);
  $allPosts = selectAllPosts($conn);
?>
<section class="latest-article">
  <h2 class="section-heading">Latest articles</h2>
  <div class="latest-list">
    <?php for ($i = 0; $i < count($allPosts); $i++):?>
    <article class="article">
      <div class="article-img">
        <img src="img/<?= $allPosts[$i]['thumbnail'] ?>" alt="article img" />
      </div>
      <div class="article-info">
        <h3 class="article-heading">
          <a href="article.php?id=<?=$allPosts[$i]['post_id']?>">
            <?= $allPosts[$i]['title'] ?>
          </a>
        </h3>
        <a class="category-btn"><?= $allPosts[$i]['category']?></a>
        <p class="article-description">
          <?= $allPosts[$i]['body'] ?>
        </p>
        <div class="article-data">
          <div class="author">
            <p><a class="article-author" href=""><?= $allPosts[$i]['username']?></a></p>
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
</section>