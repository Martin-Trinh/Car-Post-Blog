<?php
require_once ('../config/db_config.php');
require_once('../model/PostRepository.php');
require_once('../services/Pagination.php');
require_once('../services/convertDate.php');
/**
 * This controller provide data for lastest posts fetch() by page
 * Get the posts from database and generate html content from it
 * Return HTML in string to frontend
 * Html consist of post's content and links for pagination
 */

// check if id page is set
if(!isset($_GET['page'])){
  echo json_encode( array(
    'postsHtml' => '<div class="server-msg error">Error cannot get pages!</div>',
    'pageLinks' => ''
  ));
  die();
}
// sanitize data
$pageNum = intval(filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT));
$postPerPage = 6;

$postRepo = new PostRepository($conn);
// get total record of all posts in database
$totalPosts = $postRepo->countAllPosts();
$pagination = new Pagination($postPerPage, $totalPosts);
// check id page number is valid
if(!is_int($pageNum) || $pageNum > $pagination->getTotalPage()){
  echo json_encode( array(
    'postsHtml' => '<div class="server-msg error">Error cannot get pages!</div>',
    'pageLinks' => ''
  ));
  die();
}
// generate html for pagination links
$prevLink = $pageNum === 1 ? '<li><a class="disabled">Prev</a></li>' : '<li><a>Prev</a></li>';
$nextLink = $pageNum === $pagination->getTotalPage() ? '<li><a class="disabled">Next</a></li>': '<li><a>Next</a></li>';
$pageLinks = $pagination->getPageLinks($pageNum);

$paginationHtml = '<ul>'. $prevLink;
for($i = 0; $i < count($pageLinks); $i++){
  if($pageLinks[$i]['data'] === $pageNum)
    $paginationHtml .= '<li><a class="active" >' . $pageLinks[$i]['data'] . '</a></li>';
  else
    $paginationHtml .= '<li><a>' . $pageLinks[$i]['data'] . '</a></li>';
  if($i < count($pageLinks) - 1 && $pageLinks[$i]['data'] + 1 !== $pageLinks[$i + 1]['data'])
    $paginationHtml .= '<li>...</li>';

}
$paginationHtml .= $nextLink . '</ul>';
// select posts by page
$data = $postRepo->selectPostsPagination($postPerPage, ($pageNum - 1) * $postPerPage);
$postsHtml = '';
// generate html for post's content
foreach($data as $post){

  $postsHtml .= '<article class="article">
        <div class="article-img">
          <img src="img/' .  $post['thumbnail'] .  '" alt="article img" width="100" height="200" />
        </div>
        <div class="article-info">
          <h3 class="article-heading">
            <a href="article.php?id=' . $post['post_id'] .'">'.
              $post['title'] .
            '</a>
          </h3>
          <a class="category-btn" href="category.php?category='. $post['category'] .'">' . $post['category'] . '</a>
          <p class="article-description">
            '. substr($post['body'], 0, 150) . '  ...' .
          '</p>
          <div class="article-data">
            <div class="author">
              <p><a class="article-author" href="../profile.php?username=' . $post['username'] . '">'. $post['username'] . '</a></p>
              <p class="article-date">' . convertDate($post['publish_datetime']) . '</p>
            </div>
            <div class="likes">
              <p>'. $post['likes'] .' Likes</p>
            </div>
          </div>
        </div>
      </article>';
}
if($postsHtml === ''){
  $postsHtml = '<div class="server-msg error">No latest article</div>';
  $paginationHtml = '';
}
// store generated data
$response = array(
'postsHtml' => $postsHtml,
'pageLinks' => $paginationHtml,
'pageNum' => $pageNum
);
// send data back to the user as json
echo json_encode($response);

