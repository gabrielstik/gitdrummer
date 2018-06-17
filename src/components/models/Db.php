<?

class Db {

	function __construct() {    
		try {
			$this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
		}
		catch (Exception $e) {
			die('La base de donnée n\'est pas connectée. Veuillez contacter l\'administrateur.');
		}
  }

  public function get_pseudo($id) {
    $query = $this->pdo->query("SELECT * FROM users WHERE id = '$id'");
    $user = $query->fetch();
    return !empty($user->pseudo) ? $user->pseudo : false;
  }

  public function get_id($mail) {
    $query = $this->pdo->query("SELECT * FROM users WHERE username = '$mail'");
    $user = $query->fetch();
    return !empty($user->id) ? $user->id : false;
  }


  public function get_hashed_password($user) {
    $query = $this->pdo->query("SELECT * FROM users WHERE username = '$user'");
    $user = $query->fetch();
    return !empty($user->password) ? $user->password : false;
  }

  public function check_account($user) {
    $query = $this->pdo->query("SELECT * FROM users WHERE username = '$user'");
    $user = $query->fetch();
    return empty($user) ? true : false;
  }

  public function create_account($user, $password, $pseudo) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $exec = $this->pdo->prepare("INSERT INTO users (username, password, pseudo) VALUES ('$user', '$password', '$pseudo')");
    $exec->execute();
  }


  public function add_drum($user, $name, $json) {
    $exec = $this->pdo->prepare("INSERT INTO drums (author, name, date, json) VALUES ('$user', '$name', NOW(), '$json')");
    $exec->execute();
  }

  public function commit($master, $name, $json) {
    $exec = $this->pdo->prepare("INSERT INTO commits (master, name, date, json) VALUES ('$master', '$name', NOW(), '$json')");
    $exec->execute();
  }


  public function get_drums() {
    $query = $this->pdo->query("SELECT * FROM drums");
    $drums = $query->fetchAll();
    return !empty($drums) ? $drums : false;
  }

  public function get_drum($id) {
    $query = $this->pdo->query("SELECT * FROM drums WHERE id = '$id'");
    $drum = $query->fetch();
    return $drum;
  }
}