<?php
session_start();
require_once('config/db_config.php');
require_once('model/PostRepository.php');
require_once('services/convertDate.php');
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // select the post from database using post's id
    $postRepo = new PostRepository($conn);
    $post = $postRepo->selectPostById($id);
}
?>
<?php include 'partials/header.php' ?>
<main class="container">
    <?php include 'partials/toTopBtn.php';
    include 'partials/themeBtn.php'; ?>
    <script src="javascript/likePost.js" defer></script>
    <?php if (isset($post) && $post) : ?>
        <article class="container single-article">
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['user_id'] === $post['user_id'] || $_SESSION['user']['role'] === 'admin')) : ?>
                <button><a href="editPost.php?id=<?= $id ?>">Edit</a></button>
                <button><a href="controller/deletePostController.php?id=<?= $id ?>">Delete</a></button>
            <?php endif ?>
            <div class="article-info single-article-info">
                <h2 class="single-article-heading"><?= $post['title'] ?></h2>
                <a class="category-btn" href="category.php?category=<?= $post['category'] ?>"><?= $post['category'] ?></a>
                <div class="article-data">
                    <div class="author">
                        <p><a class="article-author" href="profile.php?username=<?= $post['username']?>"><?= $post['username'] ?></a></p>
                        <p class="article-date"><?= convertDate($post['publish_datetime']) ?></p>
                    </div>
                    <div class="likes" >
                        <button id="likePost" post-id="<?= $id ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                        <p><?= $post['likes'] ?> Likes</p>
                    </div>
                </div>
            </div>
            <div class="article-img">
                <img src="img/<?= $post['thumbnail'] ?>" alt="article img"  width="300" height="500">
            </div>
            <div class="article-body">
                <?= $post['body'] ?>
            </div>
        </article>
    <?php else : ?>
        <div class="server-msg error">Article not found</div>
    <?php endif ?>
</main>
<?php include 'partials/footer.php' ?>
</body>

</html>