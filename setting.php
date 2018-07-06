<?php 
/*
 * @WeiboForEmlog
 * @authors 二呆 (www.tongleer.com)
 * @date    2018-07-06
 * @version 1.0.1
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if (ROLE == ROLE_ADMIN){
	$action = isset($_POST['action']) ? addslashes($_POST['action']) : '';
	if($action=='setting'){
		$config_admin_dir = @isset($_POST['config_admin_dir']) ? addslashes(trim($_POST['config_admin_dir'])) : '';
		if($config_admin_dir){
			updateThemeConfig("config_admin_dir",$config_admin_dir);
		}
		$config_nav = @isset($_POST['config_nav']) ? addslashes(trim($_POST['config_nav'])) : '';
		if($config_nav){
			updateThemeConfig("config_nav",$config_nav);
		}
		$config_favicon = @isset($_POST['config_favicon']) ? addslashes(trim($_POST['config_favicon'])) : '';
		if($config_favicon){
			updateThemeConfig("config_favicon",$config_favicon);
		}
		$config_bg = @isset($_POST['config_bg']) ? addslashes(trim($_POST['config_bg'])) : '';
		if($config_bg){
			updateThemeConfig("config_bg",$config_bg);
		}
		$config_headBg = @isset($_POST['config_headBg']) ? addslashes(trim($_POST['config_headBg'])) : '';
		if($config_headBg){
			updateThemeConfig("config_headBg",$config_headBg);
		}
		$config_headImgUrl = @isset($_POST['config_headImgUrl']) ? addslashes(trim($_POST['config_headImgUrl'])) : '';
		if($config_headImgUrl){
			updateThemeConfig("config_headImgUrl",$config_headImgUrl);
		}
		$config_nickname = @isset($_POST['config_nickname']) ? addslashes(trim($_POST['config_nickname'])) : '';
		if($config_nickname){
			updateThemeConfig("config_nickname",$config_nickname);
		}
		$config_follow_qrcode = @isset($_POST['config_follow_qrcode']) ? addslashes(trim($_POST['config_follow_qrcode'])) : '';
		if($config_follow_qrcode){
			updateThemeConfig("config_follow_qrcode",$config_follow_qrcode);
		}
		$config_home_name = @isset($_POST['config_home_name']) ? addslashes(trim($_POST['config_home_name'])) : '';
		if($config_home_name){
			updateThemeConfig("config_home_name",$config_home_name);
		}
		$config_home_link = @isset($_POST['config_home_link']) ? addslashes(trim($_POST['config_home_link'])) : '';
		if($config_home_link){
			updateThemeConfig("config_home_link",$config_home_link);
		}
		$config_album_name = @isset($_POST['config_album_name']) ? addslashes(trim($_POST['config_album_name'])) : '';
		if($config_album_name){
			updateThemeConfig("config_album_name",$config_album_name);
		}
		$config_album_link = @isset($_POST['config_album_link']) ? addslashes(trim($_POST['config_album_link'])) : '';
		if($config_album_link){
			updateThemeConfig("config_album_link",$config_album_link);
		}
		$config_other_1_name = @isset($_POST['config_other_1_name']) ? addslashes(trim($_POST['config_other_1_name'])) : '';
		if($config_other_1_name){
			updateThemeConfig("config_other_1_name",$config_other_1_name);
		}
		$config_other_1_link = @isset($_POST['config_other_1_link']) ? addslashes(trim($_POST['config_other_1_link'])) : '';
		if($config_other_1_link){
			updateThemeConfig("config_other_1_link",$config_other_1_link);
		}
		$config_weiboname = @isset($_POST['config_weiboname']) ? addslashes(trim($_POST['config_weiboname'])) : '';
		if($config_weiboname){
			updateThemeConfig("config_weiboname",$config_weiboname);
		}
		$config_address = @isset($_POST['config_address']) ? addslashes(trim($_POST['config_address'])) : '';
		if($config_address){
			updateThemeConfig("config_address",$config_address);
		}
		$config_birthday = @isset($_POST['config_birthday']) ? addslashes(trim($_POST['config_birthday'])) : '';
		if($config_birthday){
			updateThemeConfig("config_birthday",$config_birthday);
		}
		$config_detail = @isset($_POST['config_detail']) ? addslashes(trim($_POST['config_detail'])) : '';
		if($config_detail){
			updateThemeConfig("config_detail",$config_detail);
		}
		$config_foot_info = @isset($_POST['config_foot_info']) ? addslashes(trim($_POST['config_foot_info'])) : '';
		if($config_foot_info){
			updateThemeConfig("config_foot_info",$config_foot_info);
		}
		echo "<script>location.href='';</script>";
	}
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
	<div class="am-tabs" data-am-tabs>
	  <ul class="am-tabs-nav am-nav am-nav-tabs">
		<li class="am-active"><a href="#tab-basic">基础设置</a></li>
	  </ul>
	  <div class="am-tabs-bd am-tabs-bd-ofv">
		<div class="am-tab-panel am-active" id="tab-basic">
		   <div class="am-g">
			  <div class="am-u-md-8 am-u-sm-centered">
				<form class="am-form" method="post" action="">
				  <fieldset class="am-form-set">
					<div class="am-form-group">
					  <label for="config_admin_dir">后台管理员文件夹名称</label>
					  <?php
						if($config_admin_dir==''){
							$config_admin_dir='admin';
						}
					  ?>
					  <input type="text" class="" name="config_admin_dir" id="config_admin_dir" value="<?=$config_admin_dir;?>" placeholder="">
					  <p class="am-form-help">在这里填入后台管理员文件夹名称，如admin</p>
					</div>
					<div class="am-form-group">
					  <label for="config_nav">顶部导航链接</label>
					  <?php
						if($config_nav==''){
							$config_nav='<li><a href= target=_blank>导航1</a></li><li><a href= target=_blank>导航2</a></li><li><a href= target=_blank>导航3</a></li>';
						}
					  ?>
					  <textarea class="" rows="5" name="config_nav" id="config_nav" placeholder=""><?=$config_nav;?></textarea>
					  <p class="am-form-help">在这里填入需要添加的顶部导航链接代码，如：&lt;li&gt;&lt;a href=http://baidu.com target=_blank&gt;百度&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=http://qq.com target=_blank&gt;腾讯&lt;/a&gt;&lt;/li&gt;</p>
					</div>
					<div class="am-form-group">
					  <label for="config_favicon">自定义favicon图标</label>
					  <?php
						if($config_favicon==''){
							$config_favicon='http://www.tongleer.com/wp-content/themes/D8/img/favicon.png';
						}
					  ?>
					  <input type="text" class="" name="config_favicon" value="<?=$config_favicon;?>" id="config_favicon" placeholder="">
					  <p class="am-form-help">在这里填入自定义favicon图标url</p>
					</div>
					<div class="am-form-group">
					  <label for="config_bg">网页背景图片</label>
					  <?php
						if($config_bg==''){
							$config_bg='http://api.tongleer.com/picturebed/img/bg.jpg';
						}
					  ?>
					  <input type="text" class="" name="config_bg" id="config_bg" value="<?=$config_bg;?>" placeholder="">
					  <p class="am-form-help">在这里填入网页背景图片url</p>
					</div>
					<div class="am-form-group">
					  <label for="config_headBg">资料卡背景图片</label>
					  <?php
						if($config_headBg==''){
							$config_headBg='http://api.tongleer.com/picturebed/img/bg.jpg';
						}
					  ?>
					  <input type="text" class="" name="config_headBg" id="config_headBg" value="<?=$config_headBg;?>" placeholder="">
					  <p class="am-form-help">在这里填入资料卡背景图片url，如：http://api.tongleer.com/picturebed/img/bg.jpg</p>
					</div>
					<div class="am-form-group">
					  <label for="config_headImgUrl">头像地址</label>
					  <?php
						if($config_headImgUrl==''){
							$config_headImgUrl='https://cambrian-images.cdn.bcebos.com/39ceafd81d6813a014e747db4aa6f0eb_1524963877208.jpeg';
						}
					  ?>
					  <input type="text" class="" name="config_headImgUrl" value="<?=$config_headImgUrl;?>" id="config_headImgUrl" placeholder="">
					  <p class="am-form-help">在这里填入头像的URL地址，它会显示在你的头部资料卡和每条微博前，如：https://cambrian-images.cdn.bcebos.com/39ceafd81d6813a014e747db4aa6f0eb_1524963877208.jpeg</p>
					</div>
					<div class="am-form-group">
					  <label for="config_nickname">昵称</label>
					  <?php
						if($config_nickname==''){
							$config_nickname='快乐贰呆';
						}
					  ?>
					  <input type="text" class="" name="config_nickname" value="<?=$config_nickname;?>" id="config_nickname" placeholder="">
					  <p class="am-form-help">在这里填入微博昵称，它会显示在你的头部资料卡，如：快乐贰呆</p>
					</div>
					<div class="am-form-group">
					  <label for="config_follow_qrcode">关注二维码</label>
					  <?php
						if($config_follow_qrcode==''){
							$config_follow_qrcode='http://me.tongleer.com/content/uploadfile/201706/008b1497454448.png';
						}
					  ?>
					  <input type="text" class="" name="config_follow_qrcode" value="<?=$config_follow_qrcode;?>" id="config_follow_qrcode" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡关注的二维码图片地址</p>
					</div>
					<div class="am-form-group">
					  <label for="config_home_name">主页</label>
					  <?php
						if($config_home_name==''){
							$config_home_name='主页';
						}
					  ?>
					  <input type="text" class="" name="config_home_name" value="<?=$config_home_name;?>" id="config_home_name" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡关注右侧按钮的名称，如：主页</p>
					</div>
					<div class="am-form-group">
					  <label for="config_home_name">主页链接</label>
					  <?php
						if($config_home_link==''){
							$config_home_link='http://www.tongleer.com';
						}
					  ?>
					  <input type="text" class="" name="config_home_link" value="<?=$config_home_link;?>" id="config_home_name" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡关注右侧按钮的链接，如：http://www.tongleer.com</p>
					</div>
					<div class="am-form-group">
					  <label for="config_album_name">相册名称</label>
					  <?php
						if($config_album_name==''){
							$config_album_name='相册';
						}
					  ?>
					  <input type="text" class="" name="config_album_name" value="<?=$config_album_name;?>" id="config_album_name" placeholder="">
					  <p class="am-form-help">在这里填入自定义相册页面的名称，如：相册，模板page_album.php即为相册模板，只需建立独立页面即可。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_album_link">相册链接</label>
					  <?php
						if($config_album_link==''){
							$config_album_link='javascript:;';
						}
					  ?>
					  <input type="text" class="" name="config_album_link" value="<?=$config_album_link;?>" id="config_album_link" placeholder="">
					  <p class="am-form-help">在这里填入自定义相册页面的链接，模板page_album.php即为相册模板，只需建立独立页面即可。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_other_1_name">资料卡更多下第一行名称</label>
					  <?php
						if($config_other_1_name==''){
							$config_other_1_name='^_^';
						}
					  ?>
					  <input type="text" class="" name="config_other_1_name" value="<?=$config_other_1_name;?>" id="config_other_1_name" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡更多按钮第一行的名称</p>
					</div>
					<div class="am-form-group">
					  <label for="config_other_1_link">资料卡更多下第一行名称的链接</label>
					  <?php
						if($config_other_1_link==''){
							$config_other_1_link='javascript:;';
						}
					  ?>
					  <input type="text" class="" name="config_other_1_link" value="<?=$config_other_1_link;?>" id="config_other_1_link" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡更多按钮第一行的名称的链接</p>
					</div>
					<div class="am-form-group">
					  <label for="config_weiboname">微博认证资料名称</label>
					  <?php
						if($config_weiboname==''){
							$config_weiboname='同乐儿';
						}
					  ?>
					  <input type="text" class="" name="config_weiboname" value="<?=$config_weiboname;?>" id="config_weiboname" placeholder="">
					  <p class="am-form-help">在这里填入微博认证资料名称</p>
					</div>
					<div class="am-form-group">
					  <label for="config_address">地区</label>
					  <?php
						if($config_address==''){
							$config_address='北京 东城区';
						}
					  ?>
					  <input type="text" class="" name="config_address" value="<?=$config_address;?>" id="config_address" placeholder="">
					  <p class="am-form-help">在这里填入地区</p>
					</div>
					<div class="am-form-group">
					  <label for="config_birthday">生日</label>
					  <?php
						if($config_birthday==''){
							$config_birthday='2018年7月1日';
						}
					  ?>
					  <input type="text" class="" name="config_birthday" value="<?=$config_birthday;?>" id="config_birthday" placeholder="">
					  <p class="am-form-help">在这里填入生日</p>
					</div>
					<div class="am-form-group">
					  <label for="config_detail">简介</label>
					  <?php
						if($config_detail==''){
							$config_detail='工作联系 ：diamond@tongleer.com 微信：2293338477';
						}
					  ?>
					  <input type="text" class="" name="config_detail" value="<?=$config_detail;?>" id="config_detail" placeholder="">
					  <p class="am-form-help">在这里填入简介</p>
					</div>
					<div class="am-form-group">
					  <label for="config_foot_info">底部信息</label>
					  <?php
						if($config_foot_info==''){
							$config_foot_info='<p>友情链接：<a href="" target="_blank" rel="nofollow">链接1</a> <a href="" target="_blank" rel="nofollow">链接2</a></p>';
						}
					  ?>
					  <textarea class="" rows="5" name="config_foot_info" id="config_foot_info" placeholder=""><?=$config_foot_info;?></textarea>
					  <p class="am-form-help">在这里填入底部信息</p>
					</div>
					
				  </fieldset>
				  <input type="hidden" class="" name="action" value="setting" />
				  <button type="submit" class="am-btn am-btn-primary am-btn-block">修改</button>
				</form>
			  </div>
			</div>
		</div>
	  </div>
	</div>
</section>
	<?php
}else{
	header("Location:".BLOG_URL);exit;
}
?>
<?php include View::getView('footer');?>