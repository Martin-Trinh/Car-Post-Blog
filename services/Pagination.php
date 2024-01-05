<?php 
class Pagination{
  private $rowPerPage;
  private $totalRow;
  private $page;
  private $totalPage;

  public function __construct($rowPerPage, $totalRow) {
    $this->rowPerPage = $rowPerPage;
    $this->totalRow = $totalRow;
    $this->totalPage = intval(ceil($this->totalRow / $this->rowPerPage));
  }

  private function addLink(&$links, $page){
    $pageLink = array(
      'data' => $page,
    );
    if($this->page === $page){
      $pageLink['class'] = 'active';
    }
    $links[] = $pageLink;
  }

  public function getPageLinks($page){
    $this->page = $page;
    $links = array();
    $this->addlink($links, 1);
    for($i = max(2, $this->page - 2); $i <= min($this->totalPage - 1, $this->page + 2); $i++){
      $this->addLink($links, $i);
    }
      
    if($this->totalPage !== 1)
      $this->addlink($links, $this->totalPage);
    return $links; 
  }
  public function getTotalPage(){
    return $this->totalPage;
  }
}