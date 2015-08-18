<?php
class pager{
	
	public static $page; //当前第几页
	public static $start; //从第几个记录开始
	public static $num; //每页多少个
	public static $total; //总共有多少个记录
	public static $last; //总共多少页
	
	public static function init($page, $num, $total){
		self::$page = max(1, $page);
		self::$start = $num*(self::$page-1);
		self::$num = $num;
		self::$total = $total;
		self::$last = ceil($total/$num);
	}
	
	public static function get(){
		$request = $_REQUEST;
		$request['page'] = 1;
		$first_href = http_build_query($request);
		
		$first=<<<EOF
		<li><a href="?{$first_href}">&laquo;</a></li>
EOF;
		if(self::$page>1){
			$request['page'] = self::$page-1;
			$prev_href = http_build_query($request);
			$prev=<<<EOF
			<li><a href="?{$prev_href}">&lt;</a></li>
EOF;

			for($i=1;$i<self::$page;$i++){
				$request['page'] = $i;
				$head_href = http_build_query($request);
				$head.=<<<EOF
				<li><a href="?{$head_href}">{$i}</a></li>
EOF;
			}
		}

		
		$curpage = self::$page;
		$cur = <<<EOF
		<li><a href="#" class="active">{$curpage}</a></li>
EOF;
		if(self::$page<self::$last){
			for($i=self::$page+1;$i<=self::$total;$i++){
				$request['page'] = $i;
				$foot_href = http_build_query($request);
				$foot.=<<<EOF
				<li><a href="?{$foot_href}">{$i}</a></li>
EOF;
			}
			
			$request['page'] = self::$page+1;
			$next_href = http_build_query($request);
			$next=<<<EOF
			<li><a href="?{$next_href}">&gt;</a></li>
EOF;

		}
		
		$request['page'] = self::$last;
		$last_href = http_build_query($request);
		$last=<<<EOF
		<li><a href="?{$last_href}">&raquo;</a></li>
EOF;

		$res = $first.$prev.$head.$cur.$foot.$next.$last;
		return $res;
	}
	
	
	public function tpl(){/*
		<li><a href="#">&laquo;</a></li>
  <li><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">&raquo;</a></li>
  */
	}
}