<?php
/**
 * ado 数据库抽象
 */
//RC::require_core('RcDb/extend/adodb.inc');
include('adodb.inc.php');
//include('adodb-time.inc.php');
class RcAdoSlave {

	//缓存类型
	public static $cacheMode;

	//开启ado缓存

	//调试开关
	protected $debug = null;

	//db对象
	protected $db = null;

	protected $dbslaves = null;
	//class name
	protected static $className = __CLASS__;

    /**
     * 初始化数据库配置
     */
    public function initialization($dbconfig, $predefine) {
    	$this->dbslaves = $dbconfig[$predefine];
    	$totalSlaves = sizeof($this->dbslaves);
    	if (!isset($totalSlaves{5})) {
    		return array('Database configuration file error', 404);
    	}
    	$ADODB_CACHE_DIR = RC::conf()->SITE_PATH . RC::conf()->PROTECTED_FOLDER . 'cache/adodb';
    	$ADODB_FETCH_MORE = ADODB_FETCH_ASSOC;
    }

    //数据库装载
    public function setup($dbconfig=false, $predefine=false) {

    	if (false !== $dbconfig && false !== $predefine) {
    		$this->initialization($dbconfig, $predefine);
    	}
    	$this->db = NewADOConnection($this->dbslaves{4});

    	$this->db->debug = $this->dbslaves{5};
    	$this->db->Connect($this->dbslaves{0}, $this->dbslaves{2}, $this->dbslaves{3}, $this->dbslaves{1});
    	if (!$this->db->IsConnected()) {
			return array('The database connection error', 404);
		}
		$this->db->Execute('SET NAMES UTF8');
    }
    /*
    public function select($sql, $order='', $limit='') {
		$temp_sql = $sql;
		$temp_sql = empty($order)?$temp_sql:$temp_sql." ORDER BY {$order} {$this->order}";
		//获取limit 必须的参数，如果没有请留空
		if (!empty($limit)) {
			$temp_limit_array = explode(',',$limit);
			$temp_star = $temp_limit_array[1];
			$temp_end = $temp_limit_array[0];
		}

		if (isset($temp_star) && isset($temp_end)) {
			$temp_db =$this->db->SelectLimit($temp_sql,$temp_star,$temp_end);
		}else {
			$temp_db =$this->db->Execute($temp_sql);
		}
		if (!$temp_db) {
			$this->db->ErrorMsg();
		}
		else {
			$firlds = array();
			while (!$temp_db->EOF) {
				$firlds[] = $temp_db->fields;
				$temp_db->MoveNext();
			}
			return $firlds;
		}
	}
	*/
	/**
	 * 简化查询 支持连表 暂不支持子查询
	 */
	public function Select($Largearrays, $gettype='list') {
		//判断是否存在表明和显示字段
		if (isset($Largearrays['table']) && isset($Largearrays['show'])) {
			$query_sql = 'select '.$Largearrays['show'];
			if (is_array($Largearrays['table']) && count($Largearrays['table']) > 0) {
				foreach ($Largearrays['table'] as $key => $value) {
					$temp_sql_table_array[] = $value.' as '.$key;
				}
				$temp_sql_table = '';
				//加入left join
				if (isset($Largearrays['join'])) {
					foreach ($Largearrays['on'] as $key => $value) {
						$joinarray[] = $key.' = '.$value;
					}

					$tk_member = 0;
					foreach ($temp_sql_table_array as $tk => $tv) {
						if ($tk > 0) {
							$temp_sql_table_array[$tk] .= ' on '.$joinarray[$tk_member];
							$tk_member++;
						}
					}
					$temp_sql_table = implode(" {$Largearrays['join']} ", $temp_sql_table_array);

					/*
					$temp_sql_table = implode(" {$Largearrays['join']} ", $temp_sql_table_array);
					if (is_array($Largearrays['on'])) {
						foreach ($Largearrays['on'] as $key => $value) {
							$joinarray[] = $key.' = '.$value;
						}
						$joinonarray = implode(' and ', $joinarray);
						$temp_sql_table .= ' on '.$joinonarray;
					}*/
				} else {
					$temp_sql_table = implode(', ', $temp_sql_table_array);
				}

			} else {
				$temp_sql_table = $Largearrays['table'];
			}
			$query_sql .= ' from '.$temp_sql_table;
			//处理条件
			$temp_sql_where = '';
			if (isset($Largearrays['where']) && is_array($Largearrays['where'])) {
				foreach ($Largearrays['where'] as $key1 => $value1) {
					if (is_array($value1)) {
                        $truevalue = $value1[1];
						$trueformula = $value1[0];
						switch($trueformula) {
							case 'like':
								$truevalue = "%{$truevalue}%";
								break;
							case 'in':
								$truevalue = "({$truevalue})";
								break;
							case 'not in':
								$truevalue = "({$truevalue})";
								break;
							case 'index':
								$truevalue = "$key1 $truevalue";
								break;
						}

					} else {
						$truevalue = $value1;
						$trueformula = '=';
					}
					$filtering = addslashes($truevalue);

					if ((strpos($filtering, '.') && count(explode('.', $filtering)) <= 2 ) || $filtering == 'NULL' || is_array($value1)) {
						$filtering = ''.$filtering;
					} else {
						$filtering = ' \''.$filtering.'\'';
					}
					//多重验证
					if (is_array($value1) && count($value1) === 4) {
						$filtering = $value1[1].' and '.$key1.' '.$value1[2].' '.$value1[3];
					}


					$temp_sql_where_array[] = $key1.' '.$trueformula.$filtering;
				}
				$temp_sql_where = ' where '.implode(' and ', $temp_sql_where_array);
			} else if(isset($Largearrays['where']) && $Largearrays['where'] != ''){
				$temp_sql_where = ' where '.$Largearrays['where'];
			}
			$query_sql .= $temp_sql_where;

			//群组
			$temp_sql_group_groupby = '';
			if (isset($Largearrays['group'])) {
				$temp_sql_group_groupby = ' group by '.$Largearrays['group'];
			}
			$query_sql .= $temp_sql_group_groupby;

			//排序
			$temp_sql_order_orderby = '';
			if (isset($Largearrays['order'])) {
				$temp_sql_order_orderby = array_keys($Largearrays['order']);
				$temp_sql_order_orderby = $temp_sql_order_orderby[0];//desc 或asc
				$temp_sql_order_orderby_array = $Largearrays['order'][$temp_sql_order_orderby];
				if (is_array($temp_sql_order_orderby_array)) {//分割数组成字符串
					$temp_sql_order_orderby_array = implode(',', $temp_sql_order_orderby_array);
				}
				$temp_sql_order_orderby = ' order by '.$temp_sql_order_orderby_array.' '.$temp_sql_order_orderby;
			}
			$query_sql .= $temp_sql_order_orderby;
			//limit
			if (isset($Largearrays['limit'])) {
				if (!is_array($Largearrays['limit'])) {
					$Largearrays = array($Largearrays['limit'], 0);
				}
				$temp_db =$this->db->SelectLimit($query_sql,$Largearrays['limit'][1],$Largearrays['limit'][0]);
			} else {

				if ($gettype == 'row') {
					return $this->db->GetRow($query_sql);
				} else if ($gettype == 'one') {
					return $this->db->GetOne($query_sql);
				}
				$temp_db =$this->db->Execute($query_sql);
			}
//echo $query_sql.'<br/>';
			//处理sql
			if (!$temp_db) {
				exit($this->db->ErrorMsg());
			} else {
				$firlds = array();
				while (!$temp_db->EOF) {
					$firlds[] = $temp_db->fields;
					$temp_db->MoveNext();
				}
				return $firlds;
			}
		} else {
			exit('not table');
		}
	}

	//这个需要改！！！！
    public function Execute($sql, $transaction = false) {
    	if (true === $transaction) {
    		if ($rs = $this->db->Execute($sql)) {
    			$reslut = array();
				while (!$rs->EOF) {
					$reslut[] = $rs->fields;
					$rs->MoveNext();
				}
				$rs->Close();
				return $reslut;
    		}
    		return $this->db->Execute($sql);
    	} else {
    		if ( ! $rs = & $this->db->Execute($sql)) {
				echo $this->db->ErrorMsg();
				$this->db->close();
				return false;
			} else {
				$reslut = array();
				while (!$rs->EOF) {
					$reslut[] = $rs->fields;
					$rs->MoveNext();
				}
				$rs->Close();
				return $reslut;
			}
    	}
	}


	public function Insert($table, $queue_array, $index) {
	 	 $sql = "select * from {$table} where {$index} = -1";
		//exit;
	  	$rs = $this->db->Execute($sql);
		//echo '<pre>';print_r($queue_array).'<br>';
	  	$insertSQL = $this->db->GetInsertSQL($rs, $queue_array, true);
		//echo $insertSQL,'<br>';exit;
	  	$this->db->Execute($insertSQL);
		return $this->db->Insert_ID();
    }

	public function Update($table, $sqlarr, $where) {
		$updateSQL = "UPDATE {$table} set ".$this->changeArray($sqlarr, ',')." where ".$this->changeArray($where, ' and ');
//       echo $updateSQL;
		return $this->db->Execute($updateSQL);
	}

	//删除数据
	public function Delete($table, $where) {
		if (!is_array($where)) {
			exit('不能删除整个表的内容');
		}
		$deleteSQL = "DELETE FROM {$table} WHERE ".$this->changeArray($where, ' and ');
		$reslut = $this->db->Execute($deleteSQL);
		if ($reslut->EOF == 1) {
			return true;
		} else {
			return false;
		}
	}


    public function getOne($Largearrays) {
    	return $this->Select($Largearrays, 'one');
		//return $this->db->GetOne($sql);
	}

	public function getRow($Largearrays) {
		return $this->Select($Largearrays, 'row');
    	//return $this->db->GetRow($sql);
    }

    protected static function changeArray($array, $type) {
		if ( is_array($array)) {
			foreach( $array as $key => $value ) {
				if (is_array($value)) {
					$truevalue = $value[1];
					$trueformula = $value[0];
					switch($trueformula) {
						case 'like':
							$truevalue = "%{$truevalue}%";
							break;
						case 'in':
							$truevalue = "({$truevalue})";
							break;
						case 'not in':
							$truevalue = "({$truevalue})";
							break;
						case '+':
							$truevalue = "$key + {$truevalue}";
							$trueformula = '=';
							break;
						case '-':
							$truevalue = "$key - {$truevalue}";
							$trueformula = '=';
							break;
					}
					if ($trueformula == 'key') {
						$changestr[] = $key.' = '.$truevalue;
					} else {
						$changestr[] = $key.' '.$trueformula."{$truevalue}";
					}

				} else {
					$changestr[] = $key.'='."'{$value}'";
				}
			}
			$changestr = implode($type, $changestr);
			return $changestr;
		} else {
			return false;
		}
	}

    public static function getCache($id) {
        if(self::$cacheMode===null || self::$cacheMode=='file') {
            if($rs = RC::cache()->getIn('mdb_'.self::$className, $id)) {
                //echo '<br>File cached version<br>';
                return $rs;
            }
        } else{
            if($rs = RC::cache(self::$cacheMode)->get(RC::conf()->SITE_PATH . RC::conf()->PROTECTED_PATH . $id)) {
                if($rs instanceof ArrayObject)
                    return $rs->getArrayCopy();
                return $rs;
            }
        }
    }

    public static function setCache($id, $value) {
        if(self::$cacheMode === null || self::$cacheMode=='file') {
            RC::cache()->setIn('mdb_'.self::$className, $id, $value);
        } else {
            //need to store the list of Model cache to be purged later on for Memory based cache.
            $keysId = RC::conf()->SITE_PATH . 'mdb_'.self::$className;
            if($keys = RC::cache(self::$cacheMode)->get($keysId)) {
                $listOfModelCache = $keys->getArrayCopy();
                $listOfModelCache[] = RC::conf()->SITE_PATH . RC::conf()->PROTECTED_PATH . $id;
            } else {
                $listOfModelCache = array();
                $listOfModelCache[] = RC::conf()->SITE_PATH . RC::conf()->PROTECTED_PATH . $id;
            }
            if(is_array($value))
                RC::cache(self::$cacheMode)->set(RC::conf()->SITE_PATH . RC::conf()->PROTECTED_PATH . $id, new ArrayObject($value));
            else
                RC::cache(self::$cacheMode)->set(RC::conf()->SITE_PATH . RC::conf()->PROTECTED_PATH . $id, $value);
            RC::cache(self::$cacheMode)->set($keysId, new ArrayObject($listOfModelCache));
        }
    }

}
?>