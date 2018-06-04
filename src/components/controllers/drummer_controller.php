<?

class DrummerController {

  function __construct() {
    include './components/models/Db.php';
    include './components/views/partials/head.php';
    include './components/views/drummer.php';
    include './components/views/partials/foot.php';
  }
}