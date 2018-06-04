<?

class HomeController {

  function __construct() {
    include './components/models/Db.php';
    $db = new Db();
    
    $errors_sign_in = $this->sign_in_listener($db);
    $errors_sign_up = $this->sign_up_listener($db);
    
    $this->disp($errors_sign_in, $errors_sign_up);
  }

  private function disp($errors_sign_in, $errors_sign_up) {
    include './components/views/partials/head.php';
    include './components/views/home.php';
    include './components/views/partials/foot.php';
  }

  private function sign_in_listener($db) {
    $errors_mail = [];
    $errors_pass = [];
    if (isset($_POST['sign-in--submit'])) {
      if (isset($_POST['sign-in--mail']) && strlen($_POST['sign-in--mail']) == 0) {
        array_push($errors_mail, 'Vous devez renseigner votre adresse email.');
      }
      else {
        if (!strpos($_POST['sign-in--mail'], '@')) {
          array_push($errors_mail, 'Ceci n\'est pas une adresse email.');
        }
      }

      if (isset($_POST['sign-in--password']) && strlen($_POST['sign-in--password']) == 0) {
        array_push($errors_pass, 'Vous devez renseigner votre mot de passe.');
      }
      else {
        if (sizeof($errors_mail) == 0 && sizeof($errors_pass) == 0){
          if (!password_verify($_POST['sign-in--password'], $db->get_hashed_password($_POST['sign-in--mail']))) {
            array_push($errors_pass, 'Mot de passe incorrect.');
          }
          else {
            $_SESSION['current_user']['username'] = $_POST['sign-in--mail'];
          }
        }
      }
    }

    return [
      'mail' => $errors_mail,
      'password' => $errors_pass
    ];
  }

  private function sign_up_listener($db) {
    $errors_mail = [];
    $errors_pass = [];
    $errors_pass_confirm = [];
    if (isset($_POST['sign-up--submit'])) {
      if (strlen($_POST['sign-up--mail']) == 0) {
        array_push($errors_mail, 'Vous devez renseigner votre adresse email.');
      }
      else {
        if (!strpos($_POST['sign-up--mail'], '@')) {
          array_push($errors_mail, 'Ceci n\'est pas une adresse email.');
        }
        if (!$db->check_account($_POST['sign-up--mail'])) {
          array_push($errors_mail, 'Cette adresse email est déjà utilisée.');
        }
      }

      if (isset($_POST['sign-up--password']) && strlen($_POST['sign-up--password']) == 0) {
        array_push($errors_pass, 'Vous devez renseigner votre mot de passe.');
      }
      else {
        if (strlen($_POST['sign-up--password']) < 6) {
          array_push($errors_pass, 'Le mot de passe doit avoir au moins 6 caractères.');
        }
        else {
          if (isset($_POST['sign-up--password-confirm']) && strlen($_POST['sign-up--password-confirm']) == 0) {
            array_push($errors_pass_confirm, 'Vous devez confirmer votre mot de passe.');
          }
          else {
            if ($_POST['sign-up--password'] != $_POST['sign-up--password-confirm']) {
              array_push($errors_pass_confirm, 'Vous n\'avez pas confirmé le bon mot de passe.');
            }
          }
        }
      }

      
      if (sizeof($errors_mail) == 0 && sizeof($errors_pass) == 0){
        $db->create_account($_POST['sign-up--mail'], $_POST['sign-up--password']);
        $_SESSION['current_user']['username'] = $_POST['sign-up--mail'];
      }
    }

    return [
      'mail' => $errors_mail,
      'password' => $errors_pass,
      'password-confirm' => $errors_pass_confirm
    ];
  }
}