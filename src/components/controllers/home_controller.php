<?

class HomeController {

  function __construct() {
    include './components/models/Db.php';
    $db = new Db();

    include './components/views/partials/head.php';

    $errors_sign_in = $this->sign_in_listener();
    

    include './components/views/home.php';
    include './components/views/partials/foot.php';
  }

  private function sign_in_listener() {
    $errors_mail = [];
    $errors_pass = [];
    if (isset($_POST['sign-in--submit'])) {
      if (strlen($_POST['sign-in--mail']) == 0) {
        array_push($errors_mail, 'Vous devez renseigner votre adresse email.');
      }
      else {
        if (!strpos($_POST['sign-in--mail'], '@')) {
          array_push($errors_mail, 'Ceci n\'est pas une adresse email.');
        }
        if (!$db->check_account($_POST['sign-in--mail'])) {
          array_push($errors_mail, 'Cette adresse email est déjà utilisée.');
        }
      }

      if (strlen($_POST['sign-in--password']) == 0) {
        array_push($errors_pass, 'Vous devez renseigner votre mot de passe.');
      }
      else {
        if (strlen($_POST['sign-in--password']) < 6) {
          array_push($errors_pass, 'Le mot de passe doit avoir au moins 6 caractères.');
        }
      }
      if (sizeof($errors_mail) == 0 && sizeof($errors_pass) == 0){
        $db->create_account($_POST['sign-in--mail'], $_POST['sign-in--password']);
      }
    }

    return [
      'mail' => $errors_mail,
      'password' => $errors_pass
    ];
  }
}