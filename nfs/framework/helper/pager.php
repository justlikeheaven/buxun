<?php
class pager{
	protected static $tpl;
	public static $page; //当前第几页
	public static $start; //从第几个记录开始
	public static $num; //每页多少个
	public static $total; //总共有多少个记录
	public static $last; //总共多少页
	
	public function settpl($tpl){
		self::$tpl = $tpl;
	}
	
	public static function init($page, $total, $num=1){
		
		$tpl_default = array(
			'prev'=>'<li><a href=\'{$href}\'>&lt;</a></li>',
			'first'=>'<li><a href=\'{$href}\'>{$index}</a></li>',
			'head'=>'<li><a href=\'{$href}\'>{$index}</a></li>',
			'current'=>'<li><a href=\'#\' class=\'active\'>{$index}</a></li>',
			'dot'=>'<span class="dot">...</span>',
			'foot'=>'<li><a href=\'{$href}\'>{$index}</a></li>',
			'last'=>'<li><a href=\'{$href}\'>{$index}</a></li>',
			'next'=>'<li><a href=\'{$href}\'>&gt</a></li>',
			'total'=>'<div class=\'total\'> 共 {$total} 页 </div>',
			'jumpto'=>'<div class=\'form\'>
	                <span class=\'text\'>到第</span>
	                <input class=\'input\' id=\'jumpto\' type=\'number\' value=\'{$jump}\' min=\'1\' max=\'{$totalpage}\' aria-label=\'页码输入框\'>
	                <span class=\'text\'>页</span>
	                <script>
	                function jumpto(){
	                	var query = window.location.search;
	                	var pageindex = query.lastIndexOf(\'page=\');
	                	var pjf = \'\';
	                	if(pageindex!=-1){
	                		query = query.substring(0, pageindex);
	                	}else{
	                		pjf = \'&\';
		                	if(query.indexOf(\'?\')==-1){
		                		pjf = \'?\';
		                	}
	                	}
	                	location.href = query+pjf+\'page=\'+document.getElementById(\"jumpto\").value;
	                }
	                </script>
	                <a href=\'javascript:void(0);\'  onclick=\'jumpto();\' class=\'button\'>确定</a></div>',
			'visible'=>5,
		);
		(empty(self::$tpl) || !is_array(self::$tpl) ) && self::$tpl = array();
		self::$tpl = array_merge($tpl_default, self::$tpl);
		self::$page = max(1, $page);
		self::$start = $num*(self::$page-1);
		self::$num = $num;
		self::$total = $total;
		self::$last = ceil($total/$num);
	}
	
	public static function get(){
		if(self::$total<=self::$num) return;
		
		$request = $_REQUEST;
		unset($request[session_name()]);

		
		
		//展示当前页前面的页码，如果当前页大于1
		if(self::$page>1){
			//第一页
			$index = $request['page'] = 1;
			$href = '?'.http_build_query($request);
			$first = self::$tpl['first'];
			eval("\$first = \"$first\";");
		
			//上一页
			$request['page'] = self::$page-1;
			$href = '?'.http_build_query($request);
			$prev = self::$tpl['prev'];
			eval("\$prev = \"$prev\";");
			
			$start = self::$page-self::$tpl['visible'] > 1 ? self::$page-self::$tpl['visible'] : 2;
			if($start>2){
				$headdot = self::$tpl['dot'];
			}
			for($i=$start;$i<self::$page;$i++){
				$index = $request['page'] = $i;
				$href = '?'.http_build_query($request);
				$str = self::$tpl['head'];
				eval("\$head .= \"$str\";");
			}
		}

		//当前页
		$index = self::$page;
		$cur = self::$tpl['current'];
		eval("\$cur = \"$cur\";");
		
		if(self::$page<self::$last){
			//展示当前页后面的页码
			$start = self::$page+1;
			$end = self::$page+self::$tpl['visible']<self::$last ? self::$page+self::$tpl['visible'] : self::$last-1;

			if($end+1<self::$last){
				$footdot = self::$tpl['dot'];
			}
			for($i=self::$page+1;$i<=$end;$i++){
				$index = $request['page'] = $i;
				$href = '?'.http_build_query($request);
				$str = self::$tpl['foot'];
				eval("\$foot .= \"$str\";");
				//$foot .= self::$tpl['foot'];
			}
			
			//下一页
			$request['page'] = self::$page+1;
			$href = '?'.http_build_query($request);
			$next = self::$tpl['next'];
			eval("\$next = \"$next\";");
			
			//最后一页
			
			$index = $request['page'] = self::$last;
			$href = '?'.http_build_query($request);
			$last = self::$tpl['last'];
			eval("\$last = \"$last\";");
			
		}
		
		//展示共多少页
		$total = self::$last;
		$str = self::$tpl['total'];
		eval("\$total = \"$str\";");

		//跳转
		$totalpage = self::$last;
		$jump = rand(1, self::$last);
		$href = '?'.http_build_query($request);
		$jumpto = self::$tpl['jumpto'];
		eval("\$jumpto = \"$jumpto\";");
		
		//拼装显示
		$res = $prev.$first.$headdot.$head.$cur.$foot.$footdot.$last.$next.$total.$jumpto;
		return $res;
	}

}