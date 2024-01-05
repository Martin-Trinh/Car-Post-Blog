<?php
session_start();
require_once('config/db_config.php');
require_once('controller/functions.php');
require_once('services/Pagination.php');



if (!isset($_SESSION['user']) && $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'][] = 'Cannot access this page!';
    header('Location: ../index.php');
    die();
}
  if(!isset($_GET['page']))
    $page = 1;
  else
    $page = intval(filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT));
  $postPerPage = 5;

  $totalUser = countUsers($conn);
  $allUsers = selectAllUser($conn, $user['user_id'], $postPerPage, ($page - 1) * $postPerPage);
  $pagination = new Pagination($postPerPage, $totalUser);
  $pageLinks = $pagination->getPageLinks($page);
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
    <?php if (!isset($allUsers) || count($allUsers) === 0) : ?>
      <div class="server-msg error">Cannot find this profile</div>
    <?php else : ?>
        <h2 class="section-heading">Manage users</h2>
    <div class="">
        <a href="">Posts</a>
        <a href="">Users</a>
      </div>
      <div class="trending-list">
        <?php for ($i = 0; $i < count($allUsers); $i++) : ?>
          <article class="article">
            <section class="user-info">
                <div class="">
                    <?= $allUsers['username'] ?>
                </div>
                <div>
                    <?= $allUsers['role'] ?>
                </div>
                <div>
                    Total 0 Likes
                </div>
                <div>
                    Total 0 Posts
                </div>
            </section>
            <aside class="manage-user-button">
                <div>
                    
                </div>
            </aside>
          </article>
        <?php endfor ?>
      </div>
      <div class="pagination">
        <ul>
          <?php if($page === 1) : ?>
            <li><a href="" class="disabled">Prev</a></li>
          <?php else: ?>
            <li><a href="?page=<?= $page - 1?>">Prev</a></li>
          <?php endif ?>
          <?php for($i = 0; $i < count($pageLinks); $i++): ?>
              <?php if($pageLinks[$i]['data'] === $page) : ?>
                <li><a href="?page=<?= $page ?>" class="active"><?=$pageLinks[$i]['data']?></a></li>
              <?php else : ?>
                <li><a href="?page=<?= $pageLinks[$i]['data'] ?>"><?=$pageLinks[$i]['data']?></a></li>
              <?php endif ?>
              <?php if($i < count($pageLinks) - 1 && $pageLinks[$i]['data'] + 1 !== $pageLinks[$i+1]['data']) : ?>
                  <li>...</li>
              <?php endif ?>
            <?php endfor ?>
          <?php if($page === $pagination->getTotalPage()) : ?>
            <li><a href="" class="disabled">Next</a></li>
          <?php else: ?>
            <li><a href="?page=<?= $page + 1?>">Next</a></li>
          <?php endif ?>
        </ul>
      </div>
    <?php endif ?>
  </section>
</main>
<?php include 'partials/footer.php'; ?>