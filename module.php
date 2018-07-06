<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
//更新主题设置
function updateThemeConfig($ini, $value,$type="string"){ 
	$file=dirname(__FILE__).'/config.php';
	$str = file_get_contents($file); 
	$str2=""; 
	if($type=="int"){ 
		$str2 = preg_replace('/' . $ini . "=(.*);/", $ini . '=' . $value . ';', $str); 
	}else{ 
		$str2 = preg_replace('/' . $ini . "=(.*);/", $ini . '=\'' . $value . '\';',$str); 
	} 
	file_put_contents($file, $str2);
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	if(!empty($log_cache_sort[$blogid])): 
		return '<a href="'.Url::sort($log_cache_sort[$blogid]['id']).'">'.$log_cache_sort[$blogid]['name'].'</a>';
	endif;
}
?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newcomment">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
/*调用热门文章*/
function getHotCommentsArticle($limit = 10){
	$index_hotlognum = Option::get('index_hotlognum');
	$db = MySql::getInstance();
    $sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog' AND top='n' order by `views` DESC limit 0,$index_hotlognum");
	while($row = $db->fetch_array($sql)){
		echo '<li class="am-serif"><a href="'.Url::log($row['gid']).'" title="'.$row['title'].'" target="_blank">'.$row['title'].'</a></li>';        
	}
}
?>
<?php 
//blog：自定义分页函数 
function my_page($count, $perlogs, $page, $url, $anchor = '') { 
	$pnums = @ceil($count / $perlogs); 
	$re = '<ul class="am-pagination">'; 
	$urlHome = preg_replace("|[?&/][^./?&=]*page[=/-]|", "", $url); 
	if($page > 1) { 
		$i = $page - 1; 
		$re .= '<li class="am-pagination-prev"><a href="'.$url.$i.'">上一页</a></li>'; 
	} 
	if($page < $pnums) { 
		$i = $page + 1; 
		$re .= '<li class="am-pagination-next"><a href="'.$url.$i.'">下一页</a></li>'; 
	} 
	$re .= '</ul>'; 
	return $re; 
} 
?>
<?php
/*缩略图调用*/
function showThumb($content){
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $content, $matches );
    $thumb = array();
    if(count($matches[1])<9&&count($matches[1])!=0){
        array_push($thumb,$matches[1][0]);//文章内容中抓到了图片 输出链接
    }else if(count($matches[1])>=9){
		array_push($thumb,$matches[1][0]);
		array_push($thumb,$matches[1][1]);
		array_push($thumb,$matches[1][2]);
		array_push($thumb,$matches[1][3]);
		array_push($thumb,$matches[1][4]);
		array_push($thumb,$matches[1][5]);
		array_push($thumb,$matches[1][6]);
		array_push($thumb,$matches[1][7]);
		array_push($thumb,$matches[1][8]);
	}
    return $thumb;
}
?>
<?php
/**
 * 判断是否通过手机访问
 */
function isMobile(){ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])){ 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])){
        $clientkeywords = array ('nokia',
            'sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod',
            'blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])){ 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))){
            return true;
        } 
    } 
    return false;
}
?>
<?php 
//解决页面标题重复
function page_tit($page) {
	if ($page>=2){ 
		echo ' _第'.$page.'页'; 
	}
}
?>