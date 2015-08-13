<?php
class index_m extends model{
	protected $table='seller';
    
    public function __init(){
         
        //$this->cache = NFS::helper('Cache/CacheMongo', 'mongodb://localhost:27017', array('timeout'=>1000, 'socketTimeoutMS'=>2));
    }
    
	public function get(){
		$res = $this->getOne(array('id'=>1));
		return $res;
	}
	
	
	
}