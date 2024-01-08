<?php
session_start();
require_once 'config/db_config.php';
require_once('model/PostRepository.php');

// check if user is logged in
if(!isset($_SESSION['user'])){
    $_SESSION['error'][] = 'Please log in to edit post';
    header('Location: login.php');
    die();
}
// check if post id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // select post by id
    $postRepo = new PostRepository($conn);
    $post = $postRepo->selectPostById($id);
    // check if post belong to the user and user is admin
    if($post['user_id'] !== $_SESSION['user']['user_id'] && $_SESSION['user']['role'] !== 'admin'){
        unset($post);
    }
}
if (isset($post)) {
    //set the state of the form fields for color display
    $titleState = isset($_SESSION['errorMsg']['title-post']) ? 'error' : '';
    $bodyState = isset($_SESSION['errorMsg']['article-body']) ? 'error' : '';
    $thumbnailState = isset($_SESSION['errorMsg']['thumbnail']) ? 'error' : '';
    $categoryState = isset($_SESSION['errorMsg']['category']) ? 'error' : '';
    //  set the value of the form fields
    if (isset($_SESSION['formData'])) {
        $titleValue = $_SESSION['formData']['title-post'] ?? '';
        $bodyValue = $_SESSION['formData']['article-body'] ?? '';
        $thumbnailValue = $_SESSION['formData']['thumbnail'] ?? '';
        $categoryValue = $_SESSION['formData']['category'] ?? '';
    } else {
        // set the value of the form fields from the database
        $titleValue = $post['title'];
        $bodyValue = $post['body'];
        $thumbnailValue = $post['thumbnail'];
        $categoryValue = $post['category'];
    }
    // set the error messages
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
    <?php if (!isset($post)) : ?>
        <div class="server-msg error">Cannot edit this post</div>
    <?php else : ?>
        <!-- <script src="javascript/validationWritePost.js" defer></script>
        <script src="javascript/validation.js" defer></script> -->
        <div class="container form-container add-post-container">
            <h1>Write an article</h1>
            <form action="./controller/editPostController.php" method="POST" id="form" enctype="multipart/form-data">
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
                        <option <?= $categoryValue === 'Technology' ? 'selected' : '' ?> value="Technology">Technology</option>
                        <option <?= $categoryValue === 'News' ? 'selected' : '' ?> value="News">News</option>
                        <option <?= $categoryValue === 'Review' ? 'selected' : '' ?> value="Review">Reviews</option>
                        <option <?= $categoryValue === 'Interesting facts' ? 'selected' : '' ?> value="Interesting facts">Interesting facts</option>
                    </select>
                    <small><?= $categoryErr ?></small>
                </div>
                <div class="form-field <?= $bodyState ?>">
                    <label for="article-body">Article body</label>
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
                <div>
                    <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                    <input type="hidden" name="prev-thumbnail" value="<?= $post['thumbnail'] ?>">
                    <input type="hidden" name="user-id" value="<?= $post['user_id'] ?>">
                </div>
                <button type="submit" name="submit">Publish</button>
            </form>
        </div>
    <?php endif ?>
</main>
<?php include './partials/footer.php' ?>

</body>

</html>