<?php
/**
 * 站点首页模板
 */
if (!defined('EMLOG_ROOT')) {exit('error!');}
if(isset($_GET["setting"])){
	include View::getView('setting');exit;
}
?>
<script type="text/javascript">
	$(function(){
		/*鼠标移入和移出事件*/
		$('.menu li').hover(function(){	
			$(this).find('.two').show();
			/*鼠标移入和移出事件*/
			$('.two li').hover(function(){
				var content=$(this).find('.hide li:first small').text();
				if(content != null && content.length != 0){
					$(this).find('.hide').show();
				}
			},function(){
				$(this).find('.hide').hide();
			});
		},function(){
			$(this).find('.two').hide();
		});
	});
</script>
<style>
	#nav ul.menu li ul{
		position: relative; 
		top: 0px; 
		background: #fff; 
		border: 1px solid #eee;
		border-radius: 0 0 3px 3px; 
	}
	#nav ul.menu li ul li{
		position: relative;
		list-style:none;
	}
	#nav ul.menu li ul li .hide{
		position: relative; 
		top: 0px; 
		left: 0px;
		border: 1px solid #eee;
		border-radius: 0 0 3px 3px; 
	}
	.two,.hide{
		display:none;
	}
</style>
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
<div class="am-g am-g-fixed" style="word-wrap:break-word;">
  <div class="am-u-md-9 am-u-md-push-3">
	<div class="cat-nav am-round" data-am-sticky="{top:60}">
		<div data-am-widget="tabs">
		  <ul class="am-tabs-nav">
			  <li><a class="am-btn am-radius" href="<?php echo BLOG_URL; ?>"><small>全部</small></a></li>
			  <li id="nav" class="am-dropdown" data-am-dropdown>
				<a class="am-dropdown-toggle am-btn am-radius" data-am-dropdown-toggle><small>更多</small><span class="am-icon-caret-down"></span></a>
				<ul class="am-dropdown-content menu">
					<?php
					global $CACHE; 
					$sort_cache = $CACHE->readCache('sort');
					foreach($sort_cache as $row){
						if ($row['pid'] != 0) {
							continue;
						}
					?>
					<li>
						<a href="<?php echo Url::sort($row['sid']);?>" title="<?php echo $row['sortname'];?>"><small><?php echo $row['sortname'];?></small></a>
						<?php
						$db = MySql::getInstance();
						$subrow = $db->query("SELECT * FROM " . DB_PREFIX . "sort WHERE pid='".$row['sid']."' ORDER BY taxis ASC;");
						$subcate = array();
						while($subrowval = $db->fetch_array($subrow)) {
							$subcate[] = $subrowval;
						}
						if($subcate){
						?>
						<ul class="two">
							<?php
							foreach($subcate as $sub) {
								?>
								<li>
									<a href="<?php echo Url::sort($sub['sid']);?>" title="<?php echo $sub['sortname'];?>"><small><?php echo $sub['sortname']; ?></small></a>
								</li>
								<?php
							}
							?>
						</ul>
						<?php
						}
						?>
					</li>
					<?php
					}
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
    <section id="content" class="am-u-md-12">
	  <?php if (!empty($logs)){ ?>
		<ul class="am-list">
		  <?php $k=0;foreach($logs as $value){  ?>
		  <div class="tleajaxpage">
			  <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left" style="background-color:#fff;margin-bottom:10px;list-style-type:none;">
				<div <?php if(isMobile()){?>class="am-u-sm-3 am-list-thumb"<?php }else{?>class="am-u-sm-2 am-list-thumb"<?php }?>>
				  <a href="">
					<img class="am-circle" src="<?php echo $config_headImgUrl;?>" width="50" />
				  </a>
				</div>
				<div <?php if(isMobile()){?>class="am-u-sm-9 am-list-main"<?php }else{?>class="am-u-sm-10 am-list-main"<?php }?> style="margin-bottom:5px;">
					<h3 class="am-list-item-hd">
						<a href="<?php echo $value['log_url']; ?>" class="">
							<?php echo $value['log_title']; ?>
						</a>
					</h3>
					<small class="am-list-item-text"><?php echo gmdate('Y-n-j', $value['date']); ?> <?php if(blog_sort($value['gid'])){echo '来自 '.blog_sort($value['gid']);} ?>&nbsp;&nbsp;<?php blog_tag($value['gid']); ?></small>
					<div>
						<small>
							<?php echo subString(str_replace('阅读全文&gt;&gt;', '', strip_tags(breakLog($value['content'], $value['gid']))),0,140);?>
						</small>
					</div>
					<?php
					$thumb=showThumb($value['content']);
					$youku='player.youku.com';
					$miaopai='miaopai.com';
					$douyin='aweme.snssdk.com';
					if(count($thumb)<9&&count($thumb)!=0){
						if(strpos($thumb[0],$youku)===false&&strpos($thumb[0],$miaopai)===false&&strpos($thumb[0],$douyin)===false){
						?>
						<div class="am-avg-sm-3" data-am-widget="gallery" data-am-gallery="{ pureview: true }">
						  <img src="<?=$thumb[0];?>"  alt="" width="180" />
						</div>
						<?php
						}else if(strpos($thumb[0],'player.youku.com')){
							?>
							<iframe height="400" width="100%" src="<?=$thumb[0];?>" frameborder="0" "allowfullscreen"></iframe>
							<?php
						}else if(strpos($thumb[0],'miaopai.com')){
							?>
							<video src="<?=$thumb[0];?>" controls="controls"></video>
							<?php
						}
					}else if(count($thumb)>=9){
						?>
						<ul class="am-avg-sm-3 boxes" data-am-widget="gallery" data-am-gallery="{ pureview: true }">
							<?php
							for($i=0;$i<count($thumb);$i++){
								if(strpos($thumb[$i],$youku)===false&&strpos($thumb[$i],$miaopai)===false&&strpos($thumb[$i],$douyin)===false){
								?>
								<li class="box box-1"><img src="<?=$thumb[$i];?>"  alt="" /></li>
								<?php
								}
							}
							?>
						</ul>
						<?php
					}
					?>
				</div>
				<ul class="am-avg-sm-3" style="text-align:center;">
				  <li style="border-right:1px solid #ddd;border-top:1px solid #ddd;"><a class="am-list-item-text" href="<?php echo $value['log_url']; ?>">阅读 <?php echo $value['views'];?></a></li>
				  <li style="border-right:1px solid #ddd;border-top:1px solid #ddd;"><a class="am-list-item-text" href="<?php echo $value['log_url']; ?>#comments">评论 <?php echo $value['comnum'];?></a></li>
				  <li style="border-top:1px solid #ddd;"><a class="am-list-item-text" href="http://service.weibo.com/share/share.php?url=<?php echo $value['log_url']; ?>&title=<?php echo $value['log_title']; ?>" onclick="window.open(this.href, 'share', 'width=550,height=335');return false;" >分享 <span class="am-icon-share-square-o"></span></a></li>
				</ul>
			  </li>
		  </div>
		  <?php $k++;} ?>
		</ul>
		<?php
		echo my_page($lognum, $index_lognum, $page, $pageurl);
		?>
		<?php if($config_is_ajax_page=='y'){?>
		<!--ajax分页加载-->
		<script>
		var ias = $.ias({
			container: "#content", /*包含所有文章的元素*/
			item: ".tleajaxpage", /*文章元素*/
			pagination: ".am-pagination", /*分页元素*/
			next: ".am-pagination a#tlenextpage", /*下一页元素*/
		});
		ias.extension(new IASTriggerExtension({
			text: '<div class="cat-nav am-round"><small></small></div>', /*此选项为需要点击时的文字*/
			offset: false, /*设置此项后，到 offset+1 页之后需要手动点击才能加载，取消此项则一直为无限加载*/
		}));
		ias.extension(new IASSpinnerExtension());
		ias.extension(new IASNoneLeftExtension({
			text: '<div class="cat-nav am-round"><small></small></div>', /*加载完成时的提示*/
		}));
		</script>
		<?php }?>
	  <?php }else{ ?>
		<style>
		.page-main{
			background-color:#fff;
			margin:0px auto 0px auto;
		}
		@media screen and (max-width: 960px) {
			.page-main {width: 100%;}
		}
		</style>
		<section class="page-main">
		  <div class="admin-content">
			<div class="admin-content-body">
			  <div class="am-cf am-padding am-padding-bottom-0">
				<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">404</strong> / <small>That’s an error</small></div>
			  </div>

			  <hr>

			  <div class="am-g">
				<div class="am-u-sm-12">
				  <h2 class="am-text-center am-text-xxxl am-margin-top-lg">404. Not Found</h2>
				  <p class="am-text-center">没有找到你要的页面</p>
				<pre class="page-404">
				  .----.
			   _.'__    `.
		   .--($)($$)---/#\
		 .' @          /###\
		 :         ,   #####
		  `-..__.-' _.-\###/
				`;_:    `"'
			  .'"""""`.
			 /,  ya ,\\
			//  404!  \\
			`-._______.-'
			___`. | .'___
		   (______|______)
				</pre>
				</div>
			  </div>
			</div>
		  </div>
		<!-- content end -->
		</section>
	  <?php } ?>  
	</section>
  </div>
  <?php include View::getView('side'); ?>
</div>
<?php
include View::getView('footer');
?>