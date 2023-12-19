<?php 
session_start();
require_once('config/db_config.php');
require_once('controller/functions.php');

if(isset($_GET['id'])){
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $post = selectPostById($conn, $id);
}

?>
<?php include 'partials/header.php' ?>
      <main class="container">
      <?php include 'partials/toTopBtn.php';
            include 'partials/themeBtn.php'; ?>
        <article class="container single-article">
            <button><a href="editPost.php?id=<?= $id ?>">Edit</a></button>
            <button><a href="deletePost.php?id=<? $id ?>">Delete</a></button>
            <div class="article-info single-article-info">
                <h2 class="single-article-heading"><?= $post['title']?></h2>
                <a class="category-btn"><?= $post['category']?></a>
                <div class="article-data">
                    <div class="author">
                    <p><a class="article-author" href=""><?= $post['username'] ?></a></p>
                    <p class="article-date"><?= $post['publish_datetime'] ?></p>
                </div>
                    <div class="likes">
                        <p><?= $post['likes'] ?> Likes</p>
                    </div>
                </div>
            </div>
            <div class="article-img">
                <img
                src="img/<?= $post['thumbnail'] ?>"
                alt="article img"
                />
            </div>
            <div class="article-body">
                <?= $post['body'] ?>
            </div>
        </article>
      </main>
    <?php include 'partials/footer.php' ?>
</body>
</html>