<?php
/*
 *微语部分
 */
?>
<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
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
<style>
#pagenavi{text-align:center; font-size:16px}
#pagenavi a{float:left;}
#pagenavi a:hover{text-decoration:none;}
#pagenavi span{font-size:16px; color:#999999;float:left;}
#content ul .r{ margin:5px 0px 0px 40px;color:#666666; border:0; padding:0px;}
#content ul .r li{padding:5px 3px 3px;border-bottom: #F7F7F7 1px solid; width:475px}
#content ul .r .num{ font-size:16px; font-weight:bold; color:#0079b7;padding:0px 5px; float:left; width:20px;}
#content ul .r .name{ padding:0px 0px 0px 0px; font-size:12px; color:#336699;}
#content ul .r em a{ font-style:normal;}
#content ul .huifu{margin:5px 0px 0px 43px; background:#F5F5F5;border:#CCCCCC solid 1px;display:none;}
#content ul .huifu textarea{ margin:5px; width:460px; border:#CCCCCC solid 1px;overflow:auto;}
#content ul .huifu input{ margin:0px 5px;}
#content ul .huifu div{ text-align:left;text-align:center}
#content ul .huifu .text{ width:60px;}
#content .tbutton{ font-size:12px;float:none; margin-bottom:3px;}
#content .tbutton input{ width:90px; border:#CCCCCC solid 1px; }
#content .tbutton .tinfo{ float:left; }
#content .msg{ clear:both}
#content li{list-style:none;}
#content ul .huifu textarea{background-color:#FFFFFF;}
#content ul .huifu input{background-color:#FFFFFF;}
#content ul li ul{ line-height:0;font-size:0;}
#content ul li ul li{ font-size:12px; line-height:22px;}
#content ul .r li{width:565px}
#content ul .huifu textarea{width:550px;}
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
						$db = Database::getInstance();
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
		<?php
		global $CACHE;
		$user_cache = $CACHE->readCache('user');
		?>
		<?php if (!empty($tws)){ ?>
		<ul class="am-list">
		  <?php
		  $k=0;
		  foreach($tws as $value){
			$author = $user_cache[$value['author']]['name'];
			$avatar = empty($user_cache[$value['author']]['avatar']) ? 
						BLOG_URL . $config_admin_dir.'/views/images/avatar.jpg' : 
						BLOG_URL . $user_cache[$value['author']]['avatar'];
			$tid = (int)$value['id'];
			$img = empty($value['img']) ? "" : '<div class="am-avg-sm-3" data-am-widget="gallery" data-am-gallery="{pureview: true }"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.str_replace("thum-","",$value['img']).'"  alt="" width="180" /></div>';
		  ?>
			<div class="tleajaxpage">
			  <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left li" style="background-color:#fff;margin-bottom:10px;list-style-type:none;">
				<div <?php if(isMobile()){?>class="am-u-sm-3 am-list-thumb"<?php }else{?>class="am-u-sm-2 am-list-thumb"<?php }?>>
				  <a href="">
					<img class="am-circle" src="<?php echo $avatar;?>" width="50" />
				  </a>
				</div>
				<div <?php if(isMobile()){?>class="am-u-sm-9 am-list-main"<?php }else{?>class="am-u-sm-10 am-list-main"<?php }?> style="margin-bottom:5px;">
					<small class="am-list-item-text"><?php echo $value['date'];?> 来自&nbsp;&nbsp;<?php echo $author; ?></small>
					<div><small><?php echo $value['t'].'<br/>'.$img;?></small></div>
				</div>
				<ul class="am-avg-sm-1" style="text-align:center;">
				  <li style="border-right:0px solid #ddd;border-top:1px solid #ddd;">
					<a class="am-list-item-text" href="javascript:loadr('<?php echo DYNAMIC_BLOGURL; ?>?action=getr&tid=<?php echo $tid;?>','<?php echo $tid;?>');">评论 <span id="rn_<?php echo $tid;?>"><?php echo $value['replynum'];?></span></a>
				  </li>
				</ul>
				<ul id="r_<?php echo $tid;?>" class="r"></ul>
				<?php if ($istreply == 'y'):?>
				<div class="huifu" id="rp_<?php echo $tid;?>">
				<textarea id="rtext_<?php echo $tid; ?>"></textarea>
				<div class="tbutton">
					<div class="tinfo" style="display:<?php if(ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER){echo 'none';}?>">
						<input type="text" id="rname_<?php echo $tid; ?>" value="" placeholder="昵称" />
						<span style="display:<?php if($reply_code == 'n'){echo 'none';}?>">验证码：<input type="text" id="rcode_<?php echo $tid; ?>" value="" /><?php echo $rcode; ?></span>
					</div>
					<input type="button" onclick="reply('<?php echo DYNAMIC_BLOGURL; ?>index.php?action=reply',<?php echo $tid;?>);" value="回复" /> 
					<div class="msg"><span id="rmsg_<?php echo $tid; ?>" style="color:#FF0000"></span></div>
				</div>
				</div>
				<?php endif;?>
			  </li>
			</div>
		  <?php
		  $k++;
		  }
		  ?>
		  <ul class="am-pagination"><li id="pagenavi"><?php echo $pageurl;?></li></ul>
		</ul>
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
		<?php include View::getView('comments');?>
	</section>
  </div>
  <?php include View::getView('side'); ?>
</div>
<?php
 include View::getView('footer');
?>