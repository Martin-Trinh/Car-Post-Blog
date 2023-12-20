<?php
session_start();
require_once 'config/db_config.php';
require_once 'controller/functions.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post = selectPostById($conn, $id);
}
if ($post) {
    $titleState = isset($_SESSION['errorMsg']['title-post']) ? 'error' : '';
    $bodyState = isset($_SESSION['errorMsg']['article-body']) ? 'error' : '';
    $thumbnailState = isset($_SESSION['errorMsg']['thumbnail']) ? 'error' : '';
    $categoryState = isset($_SESSION['errorMsg']['category']) ? 'error' : '';

    if (isset($_SESSION['formData'])) {
        $titleValue = $_SESSION['formData']['title-post'] ?? '';
        $bodyValue = $_SESSION['formData']['article-body'] ?? '';
        $thumbnailValue = $_SESSION['formData']['thumbnail'] ?? '';
        $categoryValue = $_SESSION['formData']['category'] ?? '';
    } else {
        $titleValue = $post['title'];
        $bodyValue = $post['body'];
        $thumbnailValue = $post['thumbnail'];
        $categoryValue = $post['category'];
    }

    $titleErr = $_SESSION['errorMsg']['title-post'] ?? '';
    $bodyErr = $_SESSION['errorMsg']['arcticle-body'] ?? '';
    $thumbnailErr = $_SESSION['errorMsg']['thumbnail'] ?? '';
    $categoryErr = $_SESSION['errorMsg']['category'] ?? '';
    unset($_SESSION['errorMsg']);
    unset($_SESSION['formData']);
}
?>

<?php include 'partials/header.php' ?>
<main class="container">
    <?php include 'partials/toTopBtn.php';
    include 'partials/themeBtn.php'; ?>
    <script src="javascript/validationWritePost.js" defer></script>
    <script src="javascript/validation.js" defer></script>
    <?php if (!$post) : ?>
        <div class="server-msg error">Cannot edit this post</div>
    <?php else : ?>
        <div class="container form-container add-post-container">
            <h2>Write an article</h2>
            <form action="./controller/editPostController.php" method="POST" id="form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                <input type="hidden" name="prev-thumbnail" value="<?= $post['thumbnail'] ?>">
                <div class="form-field <?= $titleState ?>">
                    <label for="title-post">Title</label>
                    <input type="text" name="title-post" value="<?= $titleValue ?>" placeholder="Post title" id="title-post" autocomplete="off">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small><?= $titleErr ?></small>
                </div>
                <div class="form-field <?= $categoryState ?>">
                    <label for="category">Choose category</label>
                    <select name="category" id="category">
                        <option <?= $categoryValue === '' ? 'selected' : '' ?> value="">--Please select an option--</option>
                        <option <?= $categoryValue === 'tech' ? 'selected' : '' ?> value="tech">Technology</option>
                        <option <?= $categoryValue === 'news' ? 'selected' : '' ?> value="news">News</option>
                        <option <?= $categoryValue === 'review' ? 'selected' : '' ?> value="review">Reviews</option>
                        <option <?= $categoryValue === 'facts' ? 'selected' : '' ?> value="facts">Interesting facts</option>
                    </select>
                    <small><?= $categoryErr ?></small>
                </div>
                <div class="form-field <?= $bodyState ?>">
                    <label for="category-select">Article body</label>
                    <textarea name="article-body" id="article-body" rows="10" placeholder="Write your article"><?= $bodyValue ?></textarea>
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <small><?= $bodyErr ?></small>
                </div>
                <div class="form-field <?= $thumbnailState ?>">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <small><?= $thumbnailErr ?></small>
                </div>
                <button type="submit" name="submit">Publish</button>
            </form>
        </div>
    <?php endif ?>
</main>
<?php include './partials/footer.php' ?>

</body>

</html>