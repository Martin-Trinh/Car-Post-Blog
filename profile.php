<?php
session_start();
require_once('config/db_config.php');
require_once('model/PostRepository.php');
require_once('model/UserRepository.php');
require_once('services/Pagination.php');
require_once('services/convertDate.php');

// check if username is in GET request
if (isset($_GET['username'])) {
  // set page number to 1 if page number is not set
  if(!isset($_GET['page']))
    $page = 1;
  else
    $page = intval(filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT));
  $postPerPage = 5;


  $userRepo = new UserRepository($conn);
  $username = filter_var($_GET['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  // find user by username
  $user = $userRepo->findUserByUsername($username);
  
  $postRepo = new PostRepository($conn);
  // get total post from user
  $totalPost = $postRepo->countPostFromUser($user['user_id']);
  // get all posts from user using pagination
  $allPosts = $postRepo->selectPostsFromUser($user['user_id'], $postPerPage, ($page - 1) * $postPerPage);
  // create pagination
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
    <h2 class="section-heading">User profile</h2>
    <article class="article user-manage">
            <div class="user-info">
              <p>Username: <a href="profile.php?username=<?= $user['username']?>"><?= $user['username'] ?></a></p>
              <div class="user-role-update">
                <p>Role: <?= $user['role']?></p>
              </div>
            </div>
              <div class="user-analytic">
                <div class="total">
                  <p>Total posts: </p>
                  <p><?= $postRepo->countPostFromUser($user['user_id']) ?></p>
                </div>
                <div class="total">
                  <p>Total likes: </p>
                  <p><?= $postRepo->getLikeFromUser($user['user_id']) ?></p>
                </div>
              </div>
      </article>
    <?php if (!isset($allPosts) || count($allPosts) === 0) : ?>
      <div class="server-msg error">Cannot find any post from this user</div>
    <?php else : ?>
      <div class="manage-links">
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin' && $_SESSION['user']['user_id'] === $user['user_id']): ?>
          <a class="logout-btn" href="manageUser.php">Manage users</a>
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
                  <p class="article-date"><?= convertDate($allPosts[$i]['publish_datetime']) ?></p>
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