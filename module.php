<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
global $userData;
$Link_Model=new Link_Model();
$User_Model=new User_Model();
?>
<?php
function curPageURL(){
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on"){
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	}else{
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
?>
<?php
//更新主题设置（已废弃）
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
//获取显示的友情链接
function getShowLinks($hide='n'){
	$db = MySql::getInstance();
	$res = $db->query("SELECT * FROM ".DB_PREFIX."link WHERE hide='".$hide."' ORDER BY taxis ASC");
	$links = array();
	while($row = $db->fetch_array($res)) {
		$row['sitename'] = htmlspecialchars($row['sitename']);
		$row['description'] = subString(htmlClean($row['description'], false),0,80);
		$row['siteurl'] = $row['siteurl'];
		$links[] = $row;
	}
	return $links;
}
?>
<?php
//输出友情链接
function printLinks(){
	?>
	<style>
	.friendlink{margin:0 auto;width:calc(100% - 100px);}
	@media screen and (max-width:calc(100% - 100px);) {
		.friendlink{width: calc(100% - 100px);}
	}
	</style>
	<?php
	$friendlinks='';
	$friends=getShowLinks();
	if(count($friends)>0){
		$friendlinks.='<div class="friendlink"><marquee direction="up" behavior="scroll" scrollamount="1" scrolldelay="10" loop="-1" onMouseOver="this.stop()" onMouseOut="this.start()" width="100%" height="30" style="text-align:center;">友情链接：';
		foreach($friends as $value){
			$friendlinks.='<a href="'.$value["siteurl"].'" target="_blank" title="'.$value["description"].'">'.$value["sitename"].'</a>&nbsp;';
		}
		$friendlinks.='</marquee></div>';
	}
	echo $friendlinks;
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
	echo '
		<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
			<div class="am-list-news-bd">
				<ul class="am-list">
	';
	while($row = $db->fetch_array($sql)){
		$match_str = "/((http)+.*?((.gif)|(.jpg)|(.bmp)|(.png)|(.GIF)|(.JPG)|(.PNG)|(.BMP)))/";
		preg_match_all ($match_str,$row['content'],$matches,PREG_PATTERN_ORDER);
		$img="";
		$width=12;
		if(count($matches[1])>0){
			$width=8;
			$img='<div class="am-u-sm-4 am-list-thumb"><img src="'.$matches[1][0].'" /></div>';
		}
		echo '<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left" class="am-serif">'.$img.'<a href="'.Url::log($row['gid']).'" title="'.$row['title'].'"><div class="am-u-sm-'.$width.' am-list-main"><small style="word-wrap:break-word;">'.$row['title'].'</small></div></a></li>';        
	}
	echo '
			</ul>
		</div>
	</div>
	';
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
		$re .= '<li class="am-pagination-next"><a id="tlenextpage" href="'.$url.$i.'">下一页</a></li>'; 
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
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
    <div class="comment-list">
		<h3 class="comment-count">评论列表</h3> <a name="comments"></a>
		<ul class="comment-list-ul">
			<?php
			$isGravatar = Option::get('isgravatar');
			foreach($commentStacks as $cid):
				$comment = $comments[$cid];
				$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
				?>
				<li id="comment-<?php echo $comment['cid']; ?>" class="comment">
					<a name="<?php echo $comment['cid']; ?>"></a>
					<?php if($isGravatar == 'y'): ?>
						<div class="comment-avatar">
							<img class="lazy avatar" height="40" width="40" src="<?php echo getGravatar($comment['mail']); ?>">
						</div>
					<?php endif; ?>
					<div class="comment-body">
						<div class="comment-author">
							<?php echo $comment['poster']; ?>
						</div>
						<div class="comment-content">
							<p> <?php echo $comment['content']; ?> </p>            
						</div>
						<div class="comment-meta clearfix">
							<span class="comment-date"> <?php echo $comment['date']; ?> </span>
							<a class="comment-reply right"  href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"> <span>回复</span> </a>
						</div>
					</div>
					<?php blog_comments_children($comments, $comment['children']); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php if($commentPageUrl){ ?>
	<nav id="page-nav">
		<div class="inner">
			<?php echo $commentPageUrl;?>
		</div>
	</nav>
	<?php } ?>
	<?php endif; ?>
<?php
}
?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
    $isGravatar = Option::get('isgravatar');
    foreach($children as $child):
    $comment = $comments[$child];
    $comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
	<div class="comment-children">
		<ul>
			<li id="comment-<?php echo $comment['cid']; ?>" class="comment">
				<?php if($isGravatar == 'y'): ?>
					<div class="comment-avatar">
						<img class="lazy avatar" height="40" width="40" src="<?php echo getGravatar($comment['mail']); ?>">
					</div>
				<?php endif; ?>
				<div class="comment-body">
					<div class="comment-author">
						<span> <?php echo $comment['poster']; ?> </span>
					</div>
					<div class="comment-content">
						<p> <?php echo $comment['content']; ?> </p>
					</div>
					<div class="comment-meta clearfix">
						<span class="comment-date"> <?php echo $comment['date']; ?> </span>
						<?php if($comment['level'] < 4): ?>
							<a class="comment-reply right" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"> <span>回复</span> </a>
						<?php endif; ?>
					</div>
				</div>
				<?php blog_comments_children($comments, $comment['children']);?>
			</li>
		</ul>                 
	</div>
	<?php endforeach; ?>
	<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
    if($allow_remark == 'y'):
	?>
		<div id="comment-place">
			<div class="comment-post" id="comment-post">
				<a name="respond"></a>
				<div class="comment-reply right selected cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
				<div class="comments">
					<form method="post" id="commentform" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" class="comment-form">
						<?php if(ROLE == ROLE_VISITOR): ?>
							<input type="hidden" id="ROLE" value="<?php echo ROLE_VISITOR; ?>" />
							<div class="form-user clearfix ">
								<div class="form-item form-input">
									<input type="text" name="comname" title="昵称" class="text authorName" placeholder="昵称*" value="<?php echo $ckname; ?>" required="">
								</div>
								<div class="form-item form-input">
									<input type="text" id="commail" name="commail" title="邮箱" class="text authorEmail" placeholder="邮箱*" value="<?php echo $ckmail; ?>" required="">
								</div>
								<div class="form-item form-input">
									<input type="text" name="comurl" title="网站" class="text authorUrl" placeholder="网站" value="<?php echo $ckurl; ?>">
								</div>
							</div>
						<?php else : ?>
							<div class="form-item form-welcome">
								<a href="./admin/?action=logout" class="form-edit">退出 »</a>
							</div>
						<?php endif; ?>
						<?php doAction('comment_head'); ?>
						<div class="form-item">
							<textarea class="form-textarea content" id="commentcontent" name="comment" rows="2" title="评论内容" placeholder="评论内容"></textarea>
						</div>       
						<div class="form-item clearfix">
							<?php echo $verifyCode; ?>
							<?php if(SEND_MAIL == 'Y' || REPLY_MAIL == 'Y'){ ?>
							<input value="y" type="checkbox" name="send">  允许邮件通知
							<?php } ?>
							<button class="btn btn-primary right" type="submit">发布评论</button>
						</div>
						<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
						<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
					</form>
				</div>
			</div>
		</div>
		<script>
		$(function(){
			$("#commentform").submit(function(){
				if($("#ROLE").val()=="visitor"){
					var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
					if(!reg.test($("#commail").val())){
				　　　　alert("邮件地址不符合规范");
				　　　　return false;
				　　}
					if($("#commentcontent").val()==""){
						alert("请填写评论内容");
				　　　　return false;
					}
				}
			});
		});
		</script>
    <?php
	endif;
	?>
<?php }?>