<?php
/**
 * oo
 * 负责调度各种类，实现对象的实例化，支持单例模式
 */
class oo extends Component {
	private static $_obj = null;//对象容器
	private static $_f = null;//文件容器
	const SINGLETON_TAG = '_s_';//单例标记
	
    
    /**
     * 实例化对象
     * @param string $class
     * @param string $args
     * @param string $singleton 是否单例
     * @return object
     * @example oo::obj(NFS_BASE_ROOT.'file')->get('data/pics.log');
     */
    public static function obj($file='', $args=null, $singleton=true){
    	if(empty($file))	return self::$_obj;//获取已实例化的所有对象
    	
    	$class = basename($file);
    	$singleton && $prefix = self::SINGLETON_TAG;//单例的标志
    	$k = $prefix.$class;//对象缓存容器的key
    	if(!is_object(self::$_obj[$k]) || !$singleton){//如果不是单例模式或者没有缓存
    		if(!self::include_file($file.PHP_EXT))	return false;
    		self::$_obj[$k] = new $class($args);
    	}
    	return self::$_obj[$k];
    }
    
    public static function base($class, $args=null, $singleton=true){
    	return self::obj(NFS_BASE_ROOT.$class, $args, $singleton);
    }
    

    public static function helper($class, $args=null, $singleton=true){
    	return self::obj(NFS_HELPER_ROOT.$class, $args, $singleton);
    }
    
    /**
     * mongo实例化
     *
     * @param string $server 格式：mongodb://[username:password@]host1[:port1][,host2[:port2:],...]/db
     * @return obj
     */
    public static function cache($cache){
    	return oo::base('cache'.$cache, self::cfg('db.'.$cache));
    }
    
    /**
     * 利用魔术方法的特性动态加载NFS下的类库
     * e.g:
     * NFS::helper('Socket')，helper是未定义的静态方法，那么就会通过__callStatic()去调度helper文件夹的Socket类
     */
    /*
    public static function __callStatic($folder, $arg) {
    	if(!is_object(self::$_obj[$arg[0]])){
    		$class = explode('/', $arg[0]);
    		self::include_file(NFS_ROOT.$folder.DS.$arg[0].PHP_EXT);
    		$arg = null && count($class)>1 && $arg = implode(',', array_slice($class, 1));
    		self::$_obj[$arg[0]] = new $class[count($class)-1]($arg);
    	}
    
    	return self::$_obj[$arg[0]];
    }
    */
	
    /**
     * model加载
     * @param string $model
     * @return Ambigous <boolean, object>
     */
	public static function m($model=''){
		empty($model) && $model = NFS::$controller;
		$res = false;
		if(!$res = self::obj(MODEL_ROOT.$model.MODEL_EXT)){
			$res = self::base('model');
			$res->table($model);
		}
		return $res;
	}
	
	/**
	 * controller加载
	 * @param string $controller
	 * @return Ambigous <object, boolean>
	 */
	public static function c($controller=''){
		if(empty($controller))	$controller = NFS::$controller;	
		$path = explode('.', $controller);
		$c = APP_ROOT.DS;
		if(count($path)>1){
			$class = array_pop($path);
			$c.=implode(DS, $path).DS;
		}else{
			$class = $controller;
			$c .= APP_DIR.DS;
		}
		
		
		$c.=CONTROLLER_FOLDER_NAME.DS.$class.CONTROLLER_EXT;
		$form = self::cfg("form.{$class}");//自动表单
		if($res = self::obj($c)){
			return $res;
		}else if($form){
			return self::base('controller_form');
		}else{
			return self::base('controller');
		}
	}
	
	//加载文件
	public static function include_file($file=''){
		if(empty($file)){
			return self::$_f;
		}else if(isset(self::$_f[$file])){

		}else if(!is_file($file)){
			return false;
		}else{
			self::$_f[$file] = include $file;
		}
		return self::$_f[$file];
	}

	//获取/设置app下cfg目录的配置文件
	public static function cfg($key, $value=null){
		$apath = explode('.', $key);
		$filename = array_shift($apath);
		
		$env = ENV;
		if(!empty($env)){
			if(file_exists(CONFIG_ROOT.$filename.'_'.$env.'.php')){ //不同环境不同配置
				$filename .= "_{$env}";
			}
		}
		
		
		$file = CONFIG_ROOT.$filename.'.php';
		$cfg = self::include_file($file);
		!is_array($cfg) && $cfg = array();
		foreach ($apath as $v){
			$k.= is_numeric($v) ? "[{$v}]" : "['{$v}']";
		}
		$res = null;
		if(is_null($value)){
			eval("\$res = \$cfg$k;");
		}else{
			eval("\$cfg$k = \$value;");
			$res = oo::base('file')->put($file, '<?php return '.var_export($cfg, true).';');
		}
		return $res;
	}
	
	public static function autoload($class){

		if($res = self::base($class)){
			
		}else if($res = self::helper($class)){
			
		}else if(false!==strpos($class, '_c') && $res = self::c(str_replace('_c', '', $class))){
			return $res;
		}
		return $res;
	}
	
}
spl_autoload_register(array('oo', 'autoload'));
class app extends oo{}