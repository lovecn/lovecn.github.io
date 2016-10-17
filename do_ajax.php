<?php 

	if (empty($_POST)) {
		echo json_encode(['code' => 0, 'msg' => '数据为空']);die;
	}
	session_start();
	
	try {
		$options = array(
		  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		  PDO::ATTR_STATEMENT_CLASS => array('MyPDOStatement', array()),
		);
	    // $db = new PDO('mysql:host=115.28.173.19;dbname=centers', 'root', 'tes12345');
		$db = new PDO('mysql:host=localhost;dbname=game', 'root', null, $options);
	} catch (PDOException $e ) {
	    echo json_encode(['code' => 0, 'msg' => $e -> getMessage ()]);die;
	}

	$db->exec('set names utf8');
	// http://stackoverflow.com/questions/7716785/get-last-executed-query-in-php-pdo 
	class MyPDOStatement extends PDOStatement
	{
	  protected $_debugValues = null;

	  protected function __construct()
	  {
	    // need this empty construct()!
	  }

	  public function execute($values=array())
	  {
	    $this->_debugValues = $values;
	    try {
	      $t = parent::execute($values);
	      // maybe do some logging here?
	    } catch (PDOException $e) {
	      // maybe do some logging here?
	      throw $e;
	    }

	    return $t;
	  }

	  public function _debugQuery($replaced=true)
	  {
	    $q = $this->queryString;

	    if (!$replaced) {
	      return $q;
	    }

	    return preg_replace_callback('/:([0-9a-z_]+)/i', array($this, '_debugReplace'), $q);
	  }

	  protected function _debugReplace($m)
	  {
	    $v = $this->_debugValues[$m[1]];
	    if ($v === null) {
	      return "NULL";
	    }
	    if (!is_numeric($v)) {
	      $v = str_replace("'", "''", $v);
	    }

	    return "'". $v ."'";
	  }
	}
	if ($_POST['type'] === 'reg') {
		if ($_SESSION['reg_code'] !== $_POST['rand_code']) {
			echo json_encode(['code' => 0, 'msg' => '未知错误']);die;
		}
		$rs = $db->prepare("SELECT id FROM manager where name=:name");
		$rs->execute(array(':name'=>$_POST['account']));
		$result = $rs->fetchAll(PDO::FETCH_ASSOC);
		if (count($result)) {
			echo json_encode(['code' => 0, 'msg' => '账号已存在']);die;
		}
		$stmt = $db->prepare("INSERT INTO manager (name, password,created_at) VALUES (:name, :password,:created_at)");
		$result = $stmt->execute(array(':name'=>$_POST['account'],':password'=>password_hash($_POST['pwd'],PASSWORD_DEFAULT),':created_at'=>date('Y-m-d H:i:s')));
		$db = null;
		
		$_SESSION['game'] = $_POST['account'];
		setCookie('reg_success', $_POST['account'],time () + 3600);
		echo json_encode(['code' => 1, 'msg' => '注册成功']);die;
	} else if ($_POST['type'] === 'login') {
		if ($_SESSION['code'] !== $_POST['captcha']) {
			echo json_encode(['code' => 0, 'msg' => '验证码不正确']);die;
		}
		if ($_SESSION['rand_code'] !== $_POST['rand_code']) {
			echo json_encode(['code' => 0, 'msg' => '未知错误']);die;
		}
		$rs = $db->prepare("SELECT password,id FROM manager where name=:name");
		$rs->execute(array(':name'=>$_POST['account']));
		$result = $rs->fetchAll(PDO::FETCH_ASSOC);
		if (count($result) < 1) {
			echo json_encode(['code' => 0, 'msg' => '账号不存在']);die;
		}
		if (!password_verify($_POST['pwd'], $result[0]['password'])) {
			echo json_encode(['code' => 0, 'msg' => '账号或密码不正确']);die;
		}
		$_SESSION['game'] = $_POST['account'];
		setCookie('reg_success', $_POST['account'],time () + 3600);
		$stmt = $db->prepare("update  manager set login_ip=:ip, updated_at=:updated_at where id=:id");
		$res=$stmt->execute(array(':ip'=>$_SERVER['REMOTE_ADDR'],':updated_at'=>date('Y-m-d H:i:s'),':id'=>$result[0]['id']));//var_dump($stmt->debugDumpParams());die;//var_dump($stmt->queryString, $stmt->_debugQuery() );die;
		echo json_encode(['code' => 1, 'msg' => '登录成功']);die;
	} else if ($_POST['type'] === 'logout') {
		unset($_SESSION['game']);
		setCookie('reg_success', $_POST['account'],time () - 3600);
		echo json_encode(['code' => 1, 'msg' => '退出成功']);die;
	}
	
	



