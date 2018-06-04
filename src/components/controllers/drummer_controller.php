<?

class DrummerController {

  function __construct() {
    include './components/models/Db.php';
    include './components/views/head.php';
    include './components/views/drummer.php';
    include './components/views/foot.php';
  }
}