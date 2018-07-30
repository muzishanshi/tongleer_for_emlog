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
		$comment = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."comment");
		?>
		<section class="am-panel am-panel-default web-info" style="margin-bottom:5px;">
			<li id="btnCommentShow" class="frinum">
				<a href="javascript:void(0)">
				<span>评论</span></a><?php echo $comment['total'];?>
			</li>
			<li id="btnUserShow" class="vitnum">
				<a href="javascript:void(0)">
				<span>粉丝</span></a><?php echo count($Link_Model->getLinks());?>
			</li>
			<li id="btnArticleShow" class="ptnum">
				<a href="javascript:void(0)">
				<span>文章</span></a><?php echo $blog['total'];?>
			</li>
			<div id="commentShowDiv">
				<span style="text-align: center;"><small><b>最新评论</b></small></span>
				<?php
				$resComments = $db->query("SELECT * FROM ".DB_PREFIX."comment WHERE hide='n' ORDER BY date DESC LIMIT 0,5");
				while($row = $db->fetch_array($resComments)){
				?>
				<div>
					<?php
					$hash = md5($row['mail']);
					$avatar = "https://secure.gravatar.com/avatar/$hash?s=40d=mm&r=g";
					?>
					<img src="<?=$avatar;?>" alt="" class="am-circle" width="18" height="18">
					<small><?=$row['poster'];?>说：<?=subString(str_replace('', '', strip_tags($row['comment'])),0,20);?></small>
				</div>
				<?php
				}
				?>
			</div>
			<div id="userShowDiv" style="display:none;">
				<span style="text-align: center;"><small><b>最新粉丝</b></small></span>
				<?php
				$resUsers = $db->query("SELECT * FROM ".DB_PREFIX."user ORDER BY regtime DESC LIMIT 0,5");
				while($row = $db->fetch_array($resUsers)){
				?>
				<div>
					<img src="<?=TEMPLATE_URL.'../../'.$row['photo'];?>" alt="" class="am-circle" width="18" height="18">
					<small><?=$row['nickname']!=''?$row['nickname']:$row['username'];?><?php if($row['description']!=''){?>（<?=subString(str_replace('', '', strip_tags($row['description'])),0,20);?>）<?php }else{?>（Ta暂无介绍）<?php }?></small>
				</div>
				<?php
				}
				?>
			</div>
			<div id="articleShowDiv" style="display:none;">
				<span style="text-align: center;"><small><b>最新文章</b></small></span>
				<?php
				$resContents = $db->query("SELECT * FROM ".DB_PREFIX."user as u INNER JOIN ".DB_PREFIX."blog as b WHERE type='blog' AND hide='n' AND checked='y' ORDER BY date DESC LIMIT 0,5");
				while($row = $db->fetch_array($resContents)){
				?>
				<div>
					<img src="<?=TEMPLATE_URL.'../../'.$row['photo'];?>" alt="" class="am-circle" width="18" height="18">
					<small><?=$row['nickname']!=''?$row['nickname']:$row['username'];?>于<?=date('Y-m-d',$row['date']);?>发表：<font color="#aaa"><?=$row['title'];?></font><?=subString(str_replace('', '', strip_tags($row['content'])),0,35);?></small>
				</div>
				<?php
				}
				?>
			</div>
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
			  <li style="text-align: center;"><small><a href="<?=$config_about;?>">查看更多 ></a></small></li>
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
			<div style="padding:10px;">
			<?php foreach($tag_cache as $value): ?>
				<a style="color: rgb(<?php echo(rand(0, 255)); ?>, <?php echo(rand(0,255)); ?>, <?php echo(rand(0, 255)); ?>)" href="<?php echo Url::tag($value['tagurl']); ?>" title='<?php echo $value['tagname']; ?>'><?php echo $value['tagname']; ?></a>
			<?php endforeach; ?>
			</div>
		</section>
	
    </div>
</div>
<script>
$("#btnCommentShow").click(function(){
	if($("#commentShowDiv").css("display")=="none"){
		$("#commentShowDiv").css("display","block");
		$("#userShowDiv").css("display","none");
		$("#articleShowDiv").css("display","none");
	}else{
		$("#commentShowDiv").css("display","none");
	}
});
$("#btnUserShow").click(function(){
	if($("#userShowDiv").css("display")=="none"){
		$("#userShowDiv").css("display","block");
		$("#commentShowDiv").css("display","none");
		$("#articleShowDiv").css("display","none");
	}else{
		$("#userShowDiv").css("display","none");
	}
});
$("#btnArticleShow").click(function(){
	if($("#articleShowDiv").css("display")=="none"){
		$("#articleShowDiv").css("display","block");
		$("#commentShowDiv").css("display","none");
		$("#userShowDiv").css("display","none");
	}else{
		$("#articleShowDiv").css("display","none");
	}
});
</script>