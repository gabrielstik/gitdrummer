<?

class LibraryController {

  function __construct() {
    include './components/models/Db.php';
    $db = new Db();
    
    if (!empty($_SESSION['current_user'])) $this->disp();
    else header('Location: /404');
  }

  private function disp() {
    include './components/views/partials/head.php';
    include './components/views/library.php';
    include './components/views/partials/foot.php';
  }
}