<?php
class WT_Loader extends CI_Loader{
	
	var $page_name;
	var $page_path=array();
	function CheckSubstrs($substrs,$text){  
		foreach($substrs as $substr)  
			if(false!==strpos($text,$substr)){  
				return true;  
			}  
			return false;  
	}
	function is_mobile(){
		$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
		$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';  	  
		$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
		$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  
			  
		$found_mobile=$this->CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||  
				  $this->CheckSubstrs($mobile_token_list,$useragent);  
			  
		if ($found_mobile){  
			return true;  
		}else{  
			return false;  
		}  
	}
	function __construct() {
		parent::__construct();
		if($this->is_mobile()){
	        $this->_ci_view_paths = array(FCPATH.'application/views/'=> TRUE);
		}else{
	        $this->_ci_view_paths = array(FCPATH.'application/viewspc/'=> TRUE);
		}
	}
	/**
	 * 在view中载入js的简写
	 * @param string $js_file_path js文件的路径文件名（不含"web/js/"和".js"）
	 */
	function javascript($js_file_path){
		$path='js/'.$js_file_path.'.js';
		
		if(!is_file($path)){
			//找不到文件？我们看看这个文件是不是需要根据其他文件合并
			$this->config('minify');
			$sources=$this->config->item('minify_source');
			if(!array_key_exists($path, $sources)){
				//配置文件中没有发现合并列表？放弃吧
				return;
			}
			else{
				if(ENVIRONMENT==='development'){
					//开发环境下，直接根据合并列表分别载入所有文件
					$html='';
					foreach($sources[$path] as $source){
						$hash=filemtime($source);
						$html.='<script type="text/javascript" src="/'.$source.'?'.$hash.'"></script>'."\n";
					}
					return $html;
				}else{
					//测试或生产环境下，合并并保存文件
					$this->driver('minify');
					$CI=&get_instance();
					$combined = $CI->minify->combine_files($sources[$path], 'js', false);
					$CI->minify->save_file($combined, $path);
				}
			}
		}
		
		$hash=filemtime($path);
		return '<script type="text/javascript" src="/'.$path.'?'.$hash.'"></script>'."\n";
	}

	/**
	 * 在view中载入外部css链接的简写
	 */
	function stylesheet($js_file_path){
		$path=$js_file_path.'.css';
		
		if(!is_file($path)){
			//找不到文件？我们看看这个文件是不是需要根据其他文件合并
			$this->config('minify');
			$sources=$this->config->item('minify_source');
			if(!array_key_exists($path, $sources)){
				//配置文件中没有发现合并列表？放弃吧
				return;
			}
			else{
				if(ENVIRONMENT==='development'){
					//开发环境下，直接根据合并列表分别载入所有文件
					$html='';
					foreach($sources[$path] as $source){
						$hash=filemtime($source);
						$html.='<link rel="stylesheet" href="/'.$source.'?'.$hash.'" type="text/css" />'."\n";
					}
					return $html;
				}else{
					//测试或生产环境下，合并并保存文件
					$this->driver('minify');
					$CI=&get_instance();
					$combined = $CI->minify->combine_files($sources[$path], 'css', false);
					$CI->minify->save_file($combined, $path);
				}
			}
		}
		
		$hash=filemtime($path);
		return '<link rel="stylesheet" href="/'.$path.'?'.$hash.'" type="text/css" />'."\n";
	}
	
	/**
	 * 输出一个上传的图片资源的img html
	 * @param 图片类型 avatar, project, product...
	 * @param int $id
	 * @param int $size 图片资源尺寸
	 * @param int $display_size 显示尺寸
	 * @return string img html
	 */
	function image($type,$id,$size=false,$display_size=false,$attrs=array()){
		$suffix='';
		if($size){
			$suffix='_'.$size;
		}

		$attr_string='';
		if($display_size){
			if(is_array($display_size)){
				$attr_string.=' width="'.$display_size[0].'" height="'.$display_size[1].'"';
			}else{
				$attr_string.=' width="'.$display_size.'" height="'.$display_size.'"';
			}
		}
		
		foreach($attrs as $attr_name => $attr_value){
			$attr_string.=' '.$attr_name.'="'.$attr_value.'"';
		}
		
		$path='uploads/images/'.$type.'/'.$id.$suffix.'.jpg';
		if(file_exists($path)){
			return '<img src="/uploads/images/'.$type.'/'.$id.$suffix.'.jpg?_='.filemtime($path).'"'.$attr_string.' />';
		}
		else{
			return '<img src="/uploads/images/'.$type.'/0'.$suffix.'.jpg"'.$attr_string.' />';
		}
		
	}

	
}
?>
