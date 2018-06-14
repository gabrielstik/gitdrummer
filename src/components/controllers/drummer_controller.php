<?

class DrummerController {

  function __construct() {
    include './components/models/Db.php';
    $db = new Db();

    $props = [
      'drum_json' => $this->get_drum_json($db),
      'errors' => $this->create_listener($db)
    ];
    
    if (!empty($_SESSION['current_user'])) $this->disp($props);
    else { header('Location: /404'); exit(); }
  }

  private function disp($props) {
    $errors = $props['errors'];

    include './components/views/partials/head.php';
    include './components/views/drummer.php';
    include './components/views/partials/foot.php';
  }

  private function create_listener($db) {
    $errors = [];
    if (isset($_POST['commit--submit'])) {
      header('Location: /drummer');
    }

    return $errors;
  }

  private function get_drum_json($db, $id = 0) {
    if ($_POST['commit--json']) $json = $_POST['commit--json'];
    elseif ($id != 0) $json = $db->get_drum_json($id);
    else $json = '';
  }
}