<?

session_start();
require './config.php';

$page = isset($_GET['q']) ? $_GET['q'] : 'home';

if ($page != 'sign-out') include './components/controllers/'.$page.'_controller.php';

switch($page) {
  case 'home':
    $drummer = new HomeController();
    break;
  case 'drummer':
    $drummer = new DrummerController();
    break;
  case 'sign-out':
    session_destroy();
    header('Location: /');
    break;
}
