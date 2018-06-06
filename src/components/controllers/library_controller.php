<?

class LibraryController {

  function __construct() {
    include './components/models/Db.php';
    $db = new Db();

    $props = [
      'errors' => $this->create_listener($db),
      'drums' => $this->get_drums($db)
    ];
    
    if (!empty($_SESSION['current_user'])) $this->disp($props);
    else header('Location: /404');
  }

  private function disp($props) {
    $errors = $props['errors'];
    $drums = $props['drums'];

    include './components/views/partials/head.php';
    include './components/views/library.php';
    include './components/views/partials/foot.php';
  }

  private function create_listener($db) {
    $errors = [];
    if (isset($_POST['create--submit'])) {
      if (isset($_POST['create--name']) && strlen($_POST['create--name']) == 0) {
        array_push($errors, 'Vous devez donner un nom à votre gitdrum.');
      }

      if (sizeof($errors) == 0) $db->add_drum($_SESSION['current_user']['username'], $_POST['create--name']);
    }

    return $errors;
  }

  private function get_drums($db) {
    $drums = $db->get_drums();
    foreach ($drums as $drum) {
      $drum->author = $db->get_pseudo($drum->author);
    }
    return $drums;
  }
}