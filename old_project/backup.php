<?php
	header('content-type:text/html;charset=utf-8');	
	//include('config.php');
	//$conn= mysql_connect($config['db']['host'],$config['db']['name'],$config['db']['pass']);
    //mysql_select_db($config['db']['dbname']);
	//mysql_query("set names utf8");

$host="localhost";
$user="root";
$password="root";
$dbname="blog";

mysql_connect($host,$user,$password);
mysql_select_db($dbname);
$mysql= "set names utf8;";
mysql_query($mysql);
$q1=mysql_query("show tables");
while($t=mysql_fetch_array($q1)){
	$table=$t[0];
	$q2=mysql_query("show create table `$table`");
	$sql=mysql_fetch_array($q2);
	$mysql.=$sql['Create Table'].";\n";

	$q3=mysql_query("select * from `$table`");
	while($data=mysql_fetch_assoc($q3)){
		$keys=array_keys($data);
		$keys=array_map('addslashes',$keys);
		$keys=join('`,`',$keys);
		$keys="`".$keys."`";
		$vals=array_values($data);
		$vals=array_map('addslashes',$vals);
		$vals=join("','",$vals);
		$vals="'".$vals."'";
		$mysql.="insert into `$table`($keys) values($vals);\n";
	}
$mysql.="\n";
}
$filename=date('Ymj').".sql";
$fp = fopen($filename,'w');
fputs($fp,$mysql);
fclose($fp);
echo "数据备份成功,生成备份文件".$filename;


//backup_tables('localhost','username','password','blog');

/* backup the db OR just a table */
/*function backup_tables($host,$user,$pass,$name,$tables = '*')
{
  
  $link = mysql_connect($host,$user,$pass);
  mysql_select_db($name,$link);
  
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysql_query('SHOW TABLES');
    while($row = mysql_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  
  //cycle through
  foreach($tables as $table)
  {
    $result = mysql_query('SELECT * FROM '.$table);
    $num_fields = mysql_num_fields($result);
    
    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";
    
    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";
  }
  
  //save file
  $handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
  fwrite($handle,$return);
  fclose($handle);
}
*/









