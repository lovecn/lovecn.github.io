<?php 

	if (empty($_POST)) {
		echo json_encode(['code' => 0, 'msg' => '数据为空']);die;
	}
	session_start();
	
	try {
	    $db = new PDO('mysql:host=118.178.132.207;dbname=centers', 'root', 'ourbestgame');
		// $db = new PDO('mysql:host=localhost;dbname=game', 'root', null);
	} catch (PDOException $e ) {
	    echo json_encode(['code' => 0, 'msg' => $e -> getMessage ()]);die;
	}

	$db->exec('set names utf8');
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
		$rs = $db->prepare("SELECT password FROM manager where name=:name");
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
		echo json_encode(['code' => 1, 'msg' => '登录成功']);die;
	} else if ($_POST['type'] === 'logout') {
		unset($_SESSION['game']);
		setCookie('reg_success', $_POST['account'],time () - 3600);
		echo json_encode(['code' => 1, 'msg' => '退出成功']);die;
	}
	
	



