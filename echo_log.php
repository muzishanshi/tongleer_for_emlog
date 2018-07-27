<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<style>
	a{
		color:#000;
	}
	
	.cat-nav{
		width:0.9;
		margin:0px auto 10px auto;
		background-color:#eeeeee;
	}
	.cat-nav button{
		background-color:#eeeeee;
		font-size:90%;
	}
	@media screen and (max-width: 0.9;) {
		.cat-nav {width: 100%;}
	}
</style>
<div class="am-g am-g-fixed" style="word-wrap:break-word;">
  <div class="am-u-md-9 am-u-md-push-3">
	<div class="cat-nav am-round" data-am-sticky="{top:60}">
		<div data-am-widget="tabs">
		  <ul class="am-tabs-nav">
			  <li><a class="am-btn am-radius" href="<?php echo BLOG_URL; ?>"><small>全部</small></a></li>
			  <li class="am-dropdown" data-am-dropdown>
				<a class="am-dropdown-toggle am-btn am-radius" data-am-dropdown-toggle><small>更多</small><span class="am-icon-caret-down"></span></a>
				<ul class="am-dropdown-content">
					<?php
					global $CACHE; 
					$sort_cache = $CACHE->readCache('sort');
					foreach($sort_cache as $value){
						?>
						<li><a href="<?php echo Url::sort($value['sid']);?>" title="<?php echo $value['sortname'];?>"><small><?php echo $value['sortname'];?></small></a></li>
						<?php
					}
					?>
					<?php
					/*
					global $CACHE; 
					$navi_cache = $CACHE->readCache('navi');
					foreach($navi_cache as $value){
						if ($value['pid'] != 0) {
							continue;
						}
						if (!empty($value['children']) || !empty($value['childnavi'])){
							if (!empty($value['children'])){
								foreach($value['children'] as $row){
								?>
								<li><a href="<?php echo Url::sort($row['sid']);?>" title="<?php echo $row['sortname'];?>"><?php echo $row['sortname'];?></a></li>
								<?php
								}
							}
						}
					}
					*/
					?>
				</ul>
			  </li>
			  <li>
				<form class="am-fr" id="search-header" method="get" action="<?php echo BLOG_URL; ?>index.php" name="search-header">
					<input class="am-form-field am-round am-input-sm" type="text" name="keyword" placeholder="搜文章" />
				</form>
			  </li>
		  </ul>
		</div>
	</div>
    <section id="content">
		<?php
		global $CACHE;
		$user_cache = $CACHE->readCache('user');
		?>
		<ol class="am-breadcrumb" style="background-color:#fff;">
		  <li><a href="<?php echo BLOG_URL; ?>" class="am-icon-home">首页</a></li>
		  <li><?php echo blog_sort($logid); ?></li>
		  <li class="am-active"><?php echo $log_title; ?></li>
		</ol>
		<div class="am-cf am-article" style="padding:10px;background-color:#fff;">
			<h6><?php echo $log_title; ?></h6>
			<div>
				<small>
					<a href="<?php echo Url::author($author); ?>" rel="author"><?php echo $user_cache[$author]['name']; ?></a> 发布 | <?php echo gmdate('Y-n-j', $date); ?> | 评论数：<?php echo $comnum;?> | 阅读数：<?php echo $views;?> | 标签：<?php blog_tag($logid); ?>
				</small>
			</div>
			<p>
				<?php echo rmBreak($log_content); ?>
			</p>
			<p>
				<small>分享至:</small>
				<?php $sharecontent=subString(str_replace('', '', strip_tags(rmBreak($log_content))),0,140);?>
				<a href="http://service.weibo.com/share/share.php?url=<?=curPageURL();?>&title=<?php echo $log_title; ?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" ><img src="<?php echo TEMPLATE_URL; ?>assets/images/icon_sina.png" alt="" /></a>
				<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?=curPageURL();?>&title=<?php echo $log_title; ?>&site=<?php echo BLOG_URL; ?>&desc=这是一篇神奇的文章&summary=<?php echo $sharecontent; ?>&pics=<?php if(showThumb($log_content)){echo showThumb($log_content)[0];}?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" ><img src="<?php echo TEMPLATE_URL; ?>assets/images/icon_qzone.png" alt="" /></a>
				<a href="http://connect.qq.com/widget/shareqq/index.html?url=<?=curPageURL();?>&title=<?php echo $log_title; ?>&site=<?php echo BLOG_URL; ?>&desc=这是一篇神奇的文章&summary=<?php echo $sharecontent; ?>&pics=<?php if(showThumb($log_content)){echo showThumb($log_content)[0];}?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" ><img src="<?php echo TEMPLATE_URL; ?>assets/images/icon_qq.png" alt="" /></a>
			</p>
		</div>
		<?php include View::getView('comments');?>
	</section>
  </div>
  <?php include View::getView('side'); ?>
</div>
<?php
 include View::getView('footer');
?>