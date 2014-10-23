<?php
/**
* MemInfo.php
* 
* Developed by Simon.Zhao <zhaoyong@playcrab.com>
* Copyright (c) 2014 www.playcrab.com
* 
* Changelog:
* 2014-01-09 - created
* 
*/
class MemInfo{
	private $memcache   = null;
	private $connected  = false;
	
	/*
	* memcache connect function
	*/
	private function connect(){
		if(!$this->connected){
			$config = Yii::app()->params['memConfig'];			
			$this->memcache = new Memcache();
			try{
				$this->memcache->connect($config['host'],$config['port']);	
			}catch(Exception $e){
				error_log($e->code.":".$e->message);
			}
			$this->connected = true;
		}
		return $this->memcache;
	} 
	
	public function set($key,$value,$expire = 0){
		if(empty($key) || empty($value)) return false;
		
		if(!$this->connected){
			$this ->connect();
		}
		try{
			$this->memcache->set($key,$value,false,$expire);
			return true;
		}catch(Exception $e){
			error_log($e->code.":".$e->message);
		}
		return false;
	}

	public function get($key){
		if(empty($key)) return false;
	
		if(!$this->connected){
			$this->connect();
		}

		try{
			$res = $this->memcache->get($key);
			return $res;
		}catch(Exception $e){
			error_log($e->code.":".$e->message);
		}
		return false;
	}
	public function delete($key){
		if(empty($key)) return false;

        if(!$this->connected){
            $this->connect();
        }

        try{
            $res = $this->memcache->delete($key);
            return $res;
        }catch(Exception $e){
            error_log($e->code.":".$e->message);
        }
        return false;
	}
	public function flush(){
    
        if(!$this->connected){
            $this->connect();
        }
    
        try{
            $this->memcache->flush();
            return true;
        }catch(Exception $e){
            error_log($e->code.":".$e->message);
        }
        return false;
	}	
}
?>
