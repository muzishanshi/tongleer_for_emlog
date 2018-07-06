<?php 
/*
Custom:page
Description:默认页面
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<style>
.page-main{
	background-color:#fff;
	width:960px;
	margin:0px auto 0px auto;
}
@media screen and (max-width: 960px) {
	.banner-head {width: 100%;}
}
</style>
<!-- content section -->
<section class="page-main">
	<ol class="am-breadcrumb">
		<li><a href="<?php echo BLOG_URL; ?>" class="am-icon-home">首页</a></li>
		<li class="am-active"><?php echo $log_title; ?></li>
	</ol>
	<article class="am-article am-paragraph am-paragraph-default" data-am-widget="paragraph" data-am-paragraph="{ tableScrollable: true, pureview: true }">
	  <div class="am-article-hd">
		<h1 class="am-article-title"><?php echo $log_title; ?></h1>
		<p class="am-article-meta">
			<div>
				<small>
					<a href="<?php echo Url::author($author); ?>" rel="author"><?php echo $user_cache[$author]['name']; ?></a> 发布 | <?php echo gmdate('Y-n-j', $date); ?> | 评论数：<?php echo $comnum;?> | 阅读数：<?php echo $views;?> | 标签：<?php blog_tag($logid); ?>
				</small>
			</div>
		</p>
	  </div>
	  <div class="am-article-bd">
		<?php echo rmBreak($log_content); ?>
	  </div>
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
	</article>
	<?php include View::getView('comments');?>
</section>
<?php include View::getView('footer');?>