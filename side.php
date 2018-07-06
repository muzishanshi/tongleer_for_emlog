<?php 
/**
 * 侧边栏
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<style>
.web-info{
    margin: 10px 0 0 0;
    font-size: 14px;
    color: #444;
    background-color: #fff;
    padding:8px;
    border: 1px solid #E1E8ED;
    list-style: none;
    overflow: hidden;
}
.web-info li{
    width: 33%;
    text-align: center;
    float: left;
    font-size: 13px;
    letter-spacing: 1px;
}
li.frinum, li.vitnum {
    border-right: 1px solid #EFEFEF;
}
.web-info span{
    display: block;
}
@media screen and (max-width: 960px) {
	.web-info {margin: 0 0 0 0;}
}
</style>
<div class="am-u-md-3 am-u-md-pull-9">
    <div class="am-panel-group">
		<?php
		$db = MySql::getInstance();
		$blog = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."blog WHERE type='blog' AND hide='n' AND checked='y'");
		$user = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."user");
		$comment = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."comment");
		?>
		<section class="am-panel am-panel-default web-info">
			<li class="frinum">
				<a href="javascript:void(0)">
				<span>评论</span></a><?php echo $comment['total'];?>
			</li>
			<li class="vitnum">
				<a href="javascript:void(0)">
				<span>粉丝</span></a><?php echo $user['total'];?>
			</li>
			<li class="ptnum">
				<a href="javascript:void(0)">
				<span>文章</span></a><?php echo $blog['total'];?>
			</li>
			
		</section>
		
		<section class="am-panel am-panel-default">
			<ul class="am-list am-list-static am-list-border">
			  <li>
				<span><img src="<?php echo TEMPLATE_URL; ?>assets/images/weiboauth.png" /></span><br />
				<small><?php if($config_weiboname){echo $config_weiboname;}else{echo '同乐儿';}?></small>
			  </li>
			  <li><i class="am-icon-map-marker am-icon-fw"></i><small><?php if($config_address){echo $config_address;}else{echo '北京 东城区';}?></small></li>
			  <li><i class="am-icon-birthday-cake am-icon-fw"></i><small><?php if($config_birthday){echo $config_birthday;}else{echo '2018年7月1日';}?></small></li>
			  <li><i class="am-icon-info am-icon-fw"></i><small><?php if($config_detail){echo $config_detail;}else{echo '工作联系 ：diamond@tongleer.com 微信：2293338477';}?></small></li>
			</ul>
		</section>
		
		<section class="am-panel am-panel-default">
			<div class="am-panel-hd">热门文章</div>
			<ul class="am-list blog-list">
			  <?php getHotCommentsArticle('热门文章');?>
			</ul>
		</section>
		
		<section class="am-panel am-panel-success" data-am-sticky="{top:60}">
			<div class="am-panel-hd">标签</div>
			<?php global $CACHE;$tag_cache = $CACHE->readCache('tags'); ?>
			<ul class="am-list blog-list tags-list">
			<?php foreach($tag_cache as $value): ?>
				<li><small><a style="color: rgb(<?php echo(rand(0, 255)); ?>, <?php echo(rand(0,255)); ?>, <?php echo(rand(0, 255)); ?>)" href="<?php echo Url::tag($value['tagurl']); ?>" title='<?php echo $value['tagname']; ?>'><?php echo $value['tagname']; ?></a></small></li>
			<?php endforeach; ?>
			</ul>
		</section>
	
    </div>
</div>