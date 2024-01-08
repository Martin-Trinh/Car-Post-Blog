<?php
session_start();
require_once('config/db_config.php');
require_once('model/UserRepository.php');
require_once('model/PostRepository.php');
require_once('services/Pagination.php');


// check if user is logged in and if user is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  $_SESSION['error'][] = 'Cannot access this page!';
  header('Location: index.php');
  die();
}
// set the page to 1 if page parameter is not set
if (!isset($_GET['page']))
  $page = 1;
else
  $page = intval(filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT));
// number of posts to display on 1 page
$postPerPage = 5;
$userRepository = new UserRepository($conn);
// count all users from database
$totalUser = $userRepository->countUsers();
// select users using limit and offset
$allUsers = $userRepository->selectAllUser($postPerPage, ($page - 1) * $postPerPage);
// create pagination links
$pagination = new Pagination($postPerPage, $totalUser);
$pageLinks = $pagination->getPageLinks($page);

$postRepo = new PostRepository($conn);

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
  <h2 class="section-heading">Manage User</h2>
    <?php if (!isset($allUsers) || count($allUsers) === 0) : ?>
      <div class="server-msg error">Cannot find this profile</div>
    <?php else : ?>
      <div class="trending-list">
        <?php for ($i = 0; $i < count($allUsers); $i++) : ?>
          <?php if ($allUsers[$i]['user_id'] !== $_SESSION['user']['user_id']) : ?>
            <div class="user-manage">
              <div class="user-info">
                <p>Username: <a href="profile.php?username=<?= rawurlencode($allUsers[$i]['username'])?>"><?= $allUsers[$i]['username'] ?></a></p>
                <div class="user-role-update">
                  <p>Role: <?= $allUsers[$i]['role']?></p>
                  <?php if ($allUsers[$i]['role'] === 'admin') : ?>
                    <a class="logout-btn" href="controller/updateRole.php?username=<?= rawurlencode($allUsers[$i]['username']) ?>&role=user">Demote to user</a>
                  <?php else : ?>
                    <a class="logout-btn" href="controller/updateRole.php?username=<?= rawurlencode($allUsers[$i]['username']) ?>&role=admin">Promote to admin</a>
                  <?php endif ?>
                </div>
              </div>
                <div class="user-analytic">
                  <div class="total">
                    <p>Total posts: </p>
                    <p><?= $postRepo->countPostFromUser($allUsers[$i]['user_id']) ?></p>
                  </div>
                  <div class="total">
                    <p>Total likes: </p>
                    <p><?= $postRepo->getLikeFromUser($allUsers[$i]['user_id']) ?></p>
                  </div>
                </div>
            </div>
          <?php endif ?>
        <?php endfor ?>
      </div>
      <div class="pagination">
        <ul>
          <?php if ($page === 1) : ?>
            <li><a href="" class="disabled">Prev</a></li>
          <?php else : ?>
            <li><a href="?page=<?= $page - 1 ?>">Prev</a></li>
          <?php endif ?>
          <?php for ($i = 0; $i < count($pageLinks); $i++) : ?>
            <?php if ($pageLinks[$i]['data'] === $page) : ?>
              <li><a href="?page=<?= $page ?>" class="active"><?= $pageLinks[$i]['data'] ?></a></li>
            <?php else : ?>
              <li><a href="?page=<?= $pageLinks[$i]['data'] ?>"><?= $pageLinks[$i]['data'] ?></a></li>
            <?php endif ?>
            <?php if ($i < count($pageLinks) - 1 && $pageLinks[$i]['data'] + 1 !== $pageLinks[$i + 1]['data']) : ?>
              <li>...</li>
            <?php endif ?>
          <?php endfor ?>
          <?php if ($page === $pagination->getTotalPage()) : ?>
            <li><a href="" class="disabled">Next</a></li>
          <?php else : ?>
            <li><a href="?page=<?= $page + 1 ?>">Next</a></li>
          <?php endif ?>
        </ul>
      </div>
    <?php endif ?>
  </section>
</main>
<?php include 'partials/footer.php'; ?>