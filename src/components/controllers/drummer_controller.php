<?

class DrummerController {

  function __construct() {
    include './components/models/Db.php';
    $db = new Db();

    $drum_id = $_GET['id'] ? $_GET['id'] : false;
    $props = [
      'drum_json' => $this->get_drum_json($db, $drum_id),
      'errors' => $this->create_listener($db)
    ];
    
    if (!empty($_SESSION['current_user'])) $this->disp($props);
    else { header('Location: /404'); exit(); }
  }

  private function disp($props) {
    $errors = $props['errors'];
    $json = $props['drum_json'];

    include './components/views/partials/head.php';
    include './components/views/drummer.php';
    include './components/views/partials/foot.php';
  }

  private function create_listener($db) {
    $errors = [];
    if (isset($_POST['commit--submit'])) {
      if (isset($_POST['commit--name'])) {
        if (isset($_GET['id'])) {
          $db->add_drum(
            $db->get_id($_SESSION['current_user']['username']),
            $_POST['commit--name'],
            $_POST['commit--json']
          );
        }
        else {
          $db->commit(
            $_GET['id'],
            $_POST['commit--name'],
            $_POST['commit--json']
          );
        }
      }
      else {
        array_push($errors, 'Vous devez donner un nom à votre version.');
      }
    }

    return $errors;
  }

  private function get_drum_json($db, $id = 0) {
    if (isset($_POST['commit--json'])) $json = $_POST['commit--json'];
    elseif ($id != 0) $json = $db->get_drum($id)->json;
    else $json = '';
    return $json;
  }
}