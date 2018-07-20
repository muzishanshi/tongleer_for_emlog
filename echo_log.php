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
	.boxes {
	  width: 180px;
	}
	.boxes .box {
	  height: 60px;
	  color: #eee;
	  line-height: 60px;
	  text-align: center;
	  font-weight: bold;
	  transition: all .2s ease;
	}
	.boxes .box img{
		width:100%;
		height:100%;
	}
	.boxes .box:hover {
	  font-size: 250%;
	  transform: rotate(360deg);
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
<div class="am-g am-g-fixed">
  <div class="am-u-md-9 am-u-md-push-3">
	<div class="cat-nav am-round" data-am-sticky="{top:60}">
		<div data-am-widget="tabs">
		  <ul class="am-tabs-nav">
			  <li><button type="button" class="am-btn am-radius" onClick="location.href='<?php echo BLOG_URL; ?>';">全部</button></li>
			  <li class="am-dropdown" data-am-dropdown>
				<button type="button" class="am-dropdown-toggle am-btn am-radius" data-am-dropdown-toggle>更多<span class="am-icon-caret-down"></span></button>
				<ul class="am-dropdown-content">
					<?php
					global $CACHE; 
					$sort_cache = $CACHE->readCache('sort');
					foreach($sort_cache as $value){
						?>
						<li><a href="<?php echo Url::sort($value['sid']);?>" title="<?php echo $value['sortname'];?>"><?php echo $value['sortname'];?></a></li>
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
    <section>
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
				<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a></div>
				<script>
					window._bd_share_config={
						"common":{
							"bdSnsKey":{},
							"bdText":"<?php echo $log_title; ?>",
							"bdMini":"2",
							"bdMiniList":["qzone","tsina","weixin","tqq","sqq","fbook","twi","copy"],
							"bdPic":"<?php if(showThumb($log_content)){echo showThumb($log_content)[0];};?>",
							"bdStyle":"0",
							"bdSize":"16"
						},
						"share":{},
						"image":{
							"viewList":["qzone","tqq","weixin","sqq","tsina"],
							"viewText":"分享到：",
							"viewSize":"16"
						},
						"selectShare":{
							"bdContainerClass":null,
							"bdSelectMiniList":["qzone","tqq","weixin","sqq","tsina"]
						}
					};
					with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
				</script>
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