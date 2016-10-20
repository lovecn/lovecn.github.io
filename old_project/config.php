<?php
  
  
  
  
  $config['db']['host']="222.35.101.188";
  $config['db']['name']="destiny";
  $config['db']['pass']="yellow8751";
  $config['db']['dbname']="destiny";
//查看pdo执行语句
  	function showQuery($query, $params)
    {
        $keys = array();
        $values = array();
        
        # build a regular expression for each parameter
        foreach ($params as $key=>$value)
        {
            if (is_string($key))
            {
                $keys[] = '/:'.$key.'/';
            }
            else
            {
                $keys[] = '/[?]/';
            }
            
            if(is_numeric($value))
            {
                $values[] = $value;
            }
            else
            {
                $values[] = '"'.$value .'"';
            }
        }
        
        $query = preg_replace($keys, $values, $query, 1, $count);
        return $query;
    }
	//echo showQuery($sql,array($p));
	function check() {
		if(!isset($_SESSION['user_agent'])){
			$_SESSION['user_agent'] = $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'];
		}
		/* 如果用户session ID是伪造 */
		elseif ($_SESSION['user_agent'] != $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']) {
			session_regenerate_id();//重新分配session ID
		}
		if(!isset($_SESSION['sec']) || $_SESSION['sec']!=md5('mingyun'.$_SESSION['mb'])){
			echo("<script>alert('请先登录');location.href='index.php';</script>");die;
		
		}
	}

?>