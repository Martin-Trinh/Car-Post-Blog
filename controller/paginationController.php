<?php
require_once ('../config/db_config.php');
require_once('../controller/functions.php');

$pageNum = intval(filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT));

$postPerPage = 6;
$totalPosts = countAllPosts($conn);
$lastPage = intval(ceil($totalPosts / $postPerPage));

if(is_int($pageNum) && $pageNum > 0 && $pageNum <= $lastPage){

    $prevLink = $pageNum === 1 ? '<li><a class="disabled">Prev</a></li>' : '<li><a>Prev</a></li>';
    $nextLink = $pageNum === $lastPage ? '<li><a class="disabled">Next</a></li>': '<li><a>Next</a></li>';
    $threeDots = '<li>...</li>';
    $pages = '';
    $pageLinkCnt = 5;

    if($lastPage <= $pageLinkCnt){
        for($i = 1; $i <= $lastPage; $i++){
            if($i === $pageNum){
                $pages .= '<li><a class="active"' . ">{$i}</a></li>";
            }else{
                $pages .= "<li><a>{$i}</a></li>";
            }
        }
    }else{
        if($pageNum - 3 > 1){
            $pages .= "<li><a>1</a></li>" . $threeDots;
            for($i = $pageNum - 2; $i <= min($lastPage,$pageNum + 2); $i++){
                if($i === $pageNum){
                    $pages .= '<li><a class="active"' . ">{$i}</a></li>";
                }else{
                    $pages .= "<li><a>{$i}</a></li>";
                }
            }
        }else{
          for($i = 1; $i <= $pageLinkCnt; $i++){
            if($i === $pageNum){
                $pages .= '<li><a class="active"' . ">{$i}</a></li>";
            }else{
                $pages .= "<li><a>{$i}</a></li>";
            }
          }
        }
        if($pageNum + 3 < $lastPage){
            $pages .= $threeDots . "<li><a>{$lastPage}</a></li>" ;
        }
    }

    $paginationHtml = '<ul>' . $prevLink . $pages . $nextLink . '</ul>';

    $data = selectPostsPagination($conn, $postPerPage, ($pageNum - 1) * $postPerPage);
    $postsHtml = '';

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
                <a class="category-btn">' . $post['category'] . '</a>
                <p class="article-description">
                  '. substr($post['body'], 0, 150) . '  ...' .
                '</p>
                <div class="article-data">
                  <div class="author">
                    <p><a class="article-author" href="">'. $post['username'] . '</a></p>
                    <p class="article-date">' . $post['publish_datetime'] . '</p>
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
    $response = array(
        'postsHtml' => $postsHtml,
        'pageLinks' => $paginationHtml,
        'pageNum' => $pageNum
    );
    echo json_encode($response);
}else{
    echo json_encode( array(
        'postsHtml' => '<div class="server-msg error">Error cannot get pages!</div>',
        'pageLinks' => ''
    ));
}