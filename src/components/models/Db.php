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

  public function get_hashed_password($user) {
    $query = $this->pdo->query("SELECT * FROM users WHERE username = '$user'");
    $user = $query->fetch();
    return !empty($user->password) ? $user->password : false;
  }

  function check_account($user) {
    $query = $this->pdo->query("SELECT * FROM users WHERE username = '$user'");
    $user = $query->fetch();
    return empty($user) ? true : false;
  }

  public function create_account($user, $password) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $exec = $this->pdo->prepare("INSERT INTO users (username, password) VALUES ('$user', '$password')");
    $exec->execute();
  }
}