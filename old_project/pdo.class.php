<?php
//Code highlighting produced by Actipro CodeHighlighter (freeware)http://www.CodeHighlighter.com/-->//自己写的一个PDO类

class CPdo{

protected $_dsn = "mysql:host=localhost;dbname=test";
protected $_name = "root";
protected $_pass = "";
protected $_condition = array();
protected $pdo;
protected $fetchAll;
protected $query;
protected $result;
protected $num;
protected $mode;
protected $prepare;
protected $row;
protected $fetchAction;
protected $beginTransaction;
protected $rollback;
protected $commit;
protected $char;
private static $get_mode;
private static $get_fetch_action;

/**
*pdo construct
*/
public function __construct($pconnect = false) {

   $this->_condition = array(PDO::ATTR_PERSISTENT => $pconnect); 
   $this->pdo_connect();
}
    
/**
*pdo connect
*/
private function pdo_connect() {

   try{
    $this->pdo = new PDO($this->_dsn,$this->_name,$this->_pass,$this->_condition);
   } catch(Exception $e) {
    return $this->setExceptionError($e->getMessage(), $e->getline, $e->getFile);
   } 
  
}

/**
*self sql get value action
*/
public function getValueBySelfCreateSql($sql, $fetchAction = "assoc",$mode = null) {
  
   $this->fetchAction = $this->fetchAction($fetchAction);
   $this->result = $this->setAttribute($sql, $this->fetchAction, $mode);
   $this->AllValue = $this->result->fetchAll();
   return $this->AllValue;
}

/**
*select condition can query
*/
private function setAttribute($sql, $fetchAction, $mode) {

   $this->mode = self::getMode($mode);
   $this->fetchAction = self::fetchAction($fetchAction);
   $this->pdo->setAttribute(PDO::ATTR_CASE, $this->mode);
   $this->query = $this->base_query($sql);
   $this->query->setFetchMode($this->fetchAction);
   return $this->query;
}

/**
*get mode action
*/
private static function getMode($get_style){
  
   switch($get_style) {
    case null:
     self::$get_mode = PDO::CASE_NATURAL;
    break;
    case true:
     self::$get_mode = PDO::CASE_UPPER;
    break;
    case false;
     self::$get_mode= PDO::CASE_LOWER;
    break;
   }
   return self::$get_mode;

}

/**
*fetch value action
*/
private static function fetchAction($fetchAction) {

   switch($fetchAction) {
    case "assoc":
     self::$get_fetch_action = PDO::FETCH_ASSOC; //asso array
    break;
    case "num":
     self::$get_fetch_action = PDO::FETCH_NUM;//num array
    break;
    case "object":
     self::$get_fetch_action = PDO::FETCH_OBJ; //object array
    break;
    case "both":
     self::$get_fetch_action = PDO::FETCH_BOTH;//assoc array and num array
    break;
    default:
     self::$get_fetch_action = PDO::FETCH_ASSOC;
    break;
   }

   return self::$get_fetch_action;
}

/**
*get total num action
*/
public function rowCount($sql) {

   $this->result = $this->base_query($sql);
   $this->num = $this->result->rowCount();
   return $this->num;
  
}

/*
*simple query and easy query action
*/
public function query($table, $column = "*",$condition = array(), $group = "",$order = "", $having = "", $startSet = "",$endSet = "",$fetchAction = "assoc",$params = null){

   $sql = "select ".$column." from `".$table."` ";
   if ($condition != null) {
   
    foreach($condition as $key=>$value) {
     $where .= "$key = '$value' and ";
    }
   
    $sql .= "where $where";
    $sql .= "1 = 1 ";
   }
  
   if ($group != "") {
    $sql .= "group by ".$group." ";
   }

   if ($order != "") {
    $sql .= " order by ".$order." ";
   }
   if ($having != "") {
    $sql .= "having '$having' ";
   }
   if ($startSet != "" && $endSet != "" && is_numeric($endSet) && is_numeric($startSet)) {
    $sql .= "limit $startSet,$endSet";
   }
   $this->result = $this->getValueBySelfCreateSql($sql, $fetchAction, $params);
   return $this->result;
}

/**
*execute delete update insert and so on action
*/
public function exec($sql) {
  
   $this->result = $this->pdo->exec($sql);
   $substr = substr($sql, 0 ,6);
   if ($this->result) {
    return $this->successful($substr);
   } else {
    return $this->fail($substr);
   }
  
}

/**
*prepare action
*/
public function prepare($sql) {

   $this->prepare = $this->pdo->prepare($sql);
   $this->setChars();
   $this->prepare->execute();
   while($this->rowz = $this->prepare->fetch()) {
   
    return $this->row;
   
   }
}

/**
*USE transaction
*/
public function transaction($sql) {
  
   $this->begin();
   $this->result = $this->pdo->exec($sql);
   if ($this->result) {
    $this->commit();
   } else {
    $this->rollback();
   }
}

/**
*start transaction
*/
private function begin() {

   $this->beginTransaction = $this->pdo->beginTransaction();
   return $this->beginTransaction;
}

/**
*commit transaction
*/
private function commit() {

   $this->commit = $this->pdo->commit();
   return $this->commit;
}

/**
*rollback transaction
*/
private function rollback() {

   $this->rollback = $this->pdo->rollback();
   return $this->rollback;
}
/**
*base query
*/
private function base_query($sql) {

   $this->setChars();
   $this->query = $this->pdo->query($sql);
   return $this->query;
  
}

/**
*set chars
*/
private function setChars() {
  
   $this->char = $this->pdo->query("SET NAMES 'UTF8'");
   return $this->char;
}
    
/**
*process sucessful action 
*/
private function successful($params){
  
   return "The ".$params." action is successful";
}

/**
*process fail action
*/
private function fail($params){

   return "The ".$params." action is fail";
}

/**
*process exception action
*/
private function setExceptionError($getMessage, $getLine ,$getFile) {

   echo "Error message is ".$getMessage."<br /> The Error in ".$getLine." line <br /> This file dir on ".$getFile;
    exit();
}
}


class pdomysql {
 public static $dbtype = 'mysql';
 public static $dbhost = '';
 public static $dbport = '';
 public static $dbname = '';
 public static $dbuser = '';
 public static $dbpass = '';
 public static $charset = '';
 public static $stmt = null;
 public static $DB = null;
 public static $connect = true; // 是否長连接
 public static $debug = false;
 private static $parms = array ();
 
 /**
  * 构造函数
  */
 public function __construct() {
  self::$dbtype = 'mysql';
  self::$dbhost = HOST;
  self::$dbport = '3306';
  self::$dbname = 'tion';
  self::$dbuser = 'manager';
  self::$dbpass = '123';
  self::$connect = true;
  self::$charset = 'UTF8';
  self::connect ();
  self::$DB->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
  self::$DB->setAttribute ( PDO::ATTR_EMULATE_PREPARES, true );
  self::execute ( 'SET NAMES ' . self::$charset );
 }
 /**
  * 析构函数
  */
 public function __destruct() {
  self::close ();
 }
 
 /**
  * *******************基本方法开始********************
  */
 /**
  * 作用:连結数据库
  */
 public function connect() {
  try {
   self::$DB = new PDO ( self::$dbtype . ':host=' . self::$dbhost . ';port=' . self::$dbport . ';dbname=' . self::$dbname, self::$dbuser, self::$dbpass, array (
     PDO::ATTR_PERSISTENT => self::$connect 
   ) );
  } catch ( PDOException $e ) {
   die ( "Connect Error Infomation:" . $e->getMessage () );
  }
 }
 
 /**
  * 关闭数据连接
  */
 public function close() {
  self::$DB = null;
 }
 
 /**
  * 對字串進行转義
  */
 public function quote($str) {
  return self::$DB->quote ( $str );
 }
 
 /**
  * 作用:获取数据表里的欄位
  * 返回:表字段结构
  * 类型:数组
  */
 public function getFields($table) {
  self::$stmt = self::$DB->query ( "DESCRIBE $table" );
  $result = self::$stmt->fetchAll ( PDO::FETCH_ASSOC );
  self::$stmt = null;
  return $result;
 }
 
 /**
  * 作用:获得最后INSERT的主鍵ID
  * 返回:最后INSERT的主鍵ID
  * 类型:数字
  */
 public function getLastId() {
  return self::$DB->lastInsertId ();
 }
 
 /**
  * 作用:執行INSERT\UPDATE\DELETE
  * 返回:执行語句影响行数
  * 类型:数字
  */
 public function execute($sql) {
  self::getPDOError ( $sql );
  return self::$DB->exec ( $sql );
 }
 
 /**
  * 获取要操作的数据
  * 返回:合併后的SQL語句
  * 类型:字串
  */
 private function getCode($table, $args) {
  $code = '';
  if (is_array ( $args )) {
   foreach ( $args as $k => $v ) {
    if ($v == '') {
     continue;
    }
    $code .= "`$k`='$v',";
   }
  }
  $code = substr ( $code, 0, - 1 );
  return $code;
 }
 
 
 public function optimizeTable($table) {
  $sql = "OPTIMIZE TABLE $table";
  self::execute ( $sql );
 }
 
 
 /**
  * 执行具体SQL操作
  * 返回:运行結果
  * 类型:数组
  */
 private function _fetch($sql, $type) {
  $result = array ();
  self::$stmt = self::$DB->query ( $sql );
  self::getPDOError ( $sql );
  self::$stmt->setFetchMode ( PDO::FETCH_ASSOC );
  switch ($type) {
   case '0' :
    $result = self::$stmt->fetch ();
    break;
   case '1' :
    $result = self::$stmt->fetchAll ();
    break;
   case '2' :
    
    $result = self::$stmt->rowCount ();
    
    break;
  }
  self::$stmt = null;
  return $result;
 }
 
 /**
  * *******************基本方法結束********************
  */
 
 /**
  * *******************Sql操作方法开始********************
  */
 /**
  * 作用:插入数据
  * 返回:表內記录
  * 类型:数组
  * 參数:$db->insert('$table',array('title'=>'Zxsv'))
  */
 public function add($table, $args) {
  $sql = "INSERT INTO `$table` SET ";
  
  $code = self::getCode ( $table, $args );
  $sql .= $code;

  return self::execute ( $sql );
 }
 
 /**
  * 修改数据
  * 返回:記录数
  * 类型:数字
  * 參数:$db->update($table,array('title'=>'Zxsv'),array('id'=>'1'),$where
  * ='id=3');
  */
 public function update($table, $args, $where) {
  $code = self::getCode ( $table, $args );
  $sql = "UPDATE `$table` SET ";
  $sql .= $code;
  $sql .= " Where $where";
  
  return self::execute ( $sql );
 }
 
 /**
  * 作用:刪除数据
  * 返回:表內記录
  * 类型:数组
  * 參数:$db->delete($table,$condition = null,$where ='id=3')
  */
 public function delete($table, $where) {
  $sql = "DELETE FROM `$table` Where $where";
  return self::execute ( $sql );
 }
 
 /**
  * 作用:获取單行数据
  * 返回:表內第一条記录
  * 类型:数组
  * 參数:$db->fetOne($table,$condition = null,$field = '*',$where ='')
  */
 public function fetOne($table, $field = '*', $where = false) {
  $sql = "SELECT {$field} FROM `{$table}`";
  $sql .= ($where) ? " WHERE $where" : '';
  return self::_fetch ( $sql, $type = '0' );
 }
 /**
  * 作用:获取所有数据
  * 返回:表內記录
  * 类型:二維数组
  * 參数:$db->fetAll('$table',$condition = '',$field = '*',$orderby = '',$limit
  * = '',$where='')
  */
 public function fetAll($table, $field = '*', $orderby = false, $where = false) {
  $sql = "SELECT {$field} FROM `{$table}`";
  $sql .= ($where) ? " WHERE $where" : '';
  $sql .= ($orderby) ? " ORDER BY $orderby" : '';
  return self::_fetch ( $sql, $type = '1' );
 }
 /**
  * 作用:获取單行数据
  * 返回:表內第一条記录
  * 类型:数组
  * 參数:select * from table where id='1'
  */
 public function getOne($sql) {
  return self::_fetch ( $sql, $type = '0' );
 }
 /**
  * 作用:获取所有数据
  * 返回:表內記录
  * 类型:二維数组
  * 參数:select * from table
  */
 public function getAll($sql) {
  return self::_fetch ( $sql, $type = '1' );
 }
 /**
  * 作用:获取首行首列数据
  * 返回:首行首列欄位值
  * 类型:值
  * 參数:select `a` from table where id='1'
  */
 public function scalar($sql, $fieldname) {
  $row = self::_fetch ( $sql, $type = '0' );
  return $row [$fieldname];
 }
 /**
  * 获取記录总数
  * 返回:記录数
  * 类型:数字
  * 參数:$db->fetRow('$table',$condition = '',$where ='');
  */
 public function fetRowCount($table, $field = '*', $where = false) {
   $sql = "SELECT COUNT({$field}) AS num FROM $table";
  $sql .= ($where) ? " WHERE $where" : '';
  return self::_fetch ( $sql, $type = '0' );
 }
 
 /**
  * 获取記录总数
  * 返回:記录数
  * 类型:数字
  * 參数:select count(*) from table
  */
 public function getRowCount($sql) {
  return self::_fetch ( $sql, $type = '2' );
 }
 
 /**
  * *******************Sql操作方法結束********************
  */
 
 /**
  * *******************错误处理开始********************
  */
 
 /**
  * 設置是否为调试模式
  */
 public function setDebugMode($mode = true) {
  return ($mode == true) ? self::$debug = true : self::$debug = false;
 }
 
 /**
  * 捕获PDO错误信息
  * 返回:出错信息
  * 类型:字串
  */
 private function getPDOError($sql) {
  self::$debug ? self::errorfile ( $sql ) : '';
  if (self::$DB->errorCode () != '00000') {
   $info = (self::$stmt) ? self::$stmt->errorInfo () : self::$DB->errorInfo ();
   echo (self::sqlError ( 'mySQL Query Error', $info [2], $sql ));
   exit ();
  }
 }
 private function getSTMTError($sql) {
  self::$debug ? self::errorfile ( $sql ) : '';
  if (self::$stmt->errorCode () != '00000') {
   $info = (self::$stmt) ? self::$stmt->errorInfo () : self::$DB->errorInfo ();
   echo (self::sqlError ( 'mySQL Query Error', $info [2], $sql ));
   exit ();
  }
 }
 
 /**
  * 寫入错误日志
  */
 private function errorfile($sql) {
  echo $sql . '<br />';
  $errorfile = _ROOT . './dberrorlog.php';
  $sql = str_replace ( array (
    "\n",
    "\r",
    "\t",
    "  ",
    "  ",
    "  " 
  ), array (
    " ",
    " ",
    " ",
    " ",
    " ",
    " " 
  ), $sql );
  if (! file_exists ( $errorfile )) {
   $fp = file_put_contents ( $errorfile, "<?PHP exit('Access Denied'); ?>\n" . $sql );
  } else {
   $fp = file_put_contents ( $errorfile, "\n" . $sql, FILE_APPEND );
  }
 }
 
 /**
  * 作用:运行错误信息
  * 返回:运行错误信息和SQL語句
  * 类型:字符
  */
 private function sqlError($message = '', $info = '', $sql = '') {
  
  $html = '';
  if ($message) {
   $html .=  $message;
  }
  
  if ($info) {
   $html .= 'SQLID: ' . $info ;
  }
  if ($sql) {
   $html .= 'ErrorSQL: ' . $sql;
  }
  
  throw new Exception($html);
 }
/**
 * *******************错误处理結束********************
 */
}
