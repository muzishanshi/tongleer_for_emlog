<?php 
/*
 * @WeiboForEmlog
 * @authors 二呆 (www.tongleer.com)
 * @date    2018-12-31
 * @version 1.0.8
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
require_once(dirname(__FILE__).'/config.php');
if (ROLE == ROLE_ADMIN){
	$action = isset($_POST['action']) ? addslashes($_POST['action']) : '';
	if($action=='setting'){
		$config_admin_dir = @isset($_POST['config_admin_dir']) ? addslashes(str_replace("'","\'",trim($_POST['config_admin_dir']))) : 'admin';
		$config_is_pjax = @isset($_POST['config_is_pjax']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_pjax']))) : 'n';
		$config_is_play = @isset($_POST['config_is_play']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_play']))) : 'n';
		$config_is_ajax_page = @isset($_POST['config_is_ajax_page']) ? addslashes(str_replace("'","\'",trim($_POST['config_is_ajax_page']))) : 'n';
		$config_nav = @isset($_POST['config_nav']) ? addslashes(str_replace("'","\'",trim($_POST['config_nav']))) : '';
		$config_favicon = @isset($_POST['config_favicon']) ? addslashes(str_replace("'","\'",trim($_POST['config_favicon']))) : '';
		$config_bg = @isset($_POST['config_bg']) ? addslashes(str_replace("'","\'",trim($_POST['config_bg']))) : '';
		$config_headBg = @isset($_POST['config_headBg']) ? addslashes(str_replace("'","\'",trim($_POST['config_headBg']))) : '';
		$config_headImgUrl = @isset($_POST['config_headImgUrl']) ? addslashes(str_replace("'","\'",trim($_POST['config_headImgUrl']))) : '';
		$config_nickname = @isset($_POST['config_nickname']) ? addslashes(str_replace("'","\'",trim($_POST['config_nickname']))) : '';
		$config_sex = @isset($_POST['config_sex']) ? addslashes(str_replace("'","\'",trim($_POST['config_sex']))) : 'girl';
		$config_follow_qrcode = @isset($_POST['config_follow_qrcode']) ? addslashes(str_replace("'","\'",trim($_POST['config_follow_qrcode']))) : '';
		$config_home_name = @isset($_POST['config_home_name']) ? addslashes(str_replace("'","\'",trim($_POST['config_home_name']))) : '';
		$config_home_link = @isset($_POST['config_home_link']) ? addslashes(str_replace("'","\'",trim($_POST['config_home_link']))) : '';
		$config_album_name = @isset($_POST['config_album_name']) ? addslashes(str_replace("'","\'",trim($_POST['config_album_name']))) : '';
		$config_album_link = @isset($_POST['config_album_link']) ? addslashes(str_replace("'","\'",trim($_POST['config_album_link']))) : '';
		$config_other_1_name = @isset($_POST['config_other_1_name']) ? addslashes(str_replace("'","\'",trim($_POST['config_other_1_name']))) : '';
		$config_other_1_link = @isset($_POST['config_other_1_link']) ? addslashes(str_replace("'","\'",trim($_POST['config_other_1_link']))) : '';
		$config_weiboname = @isset($_POST['config_weiboname']) ? addslashes(str_replace("'","\'",trim($_POST['config_weiboname']))) : '';
		$config_address = @isset($_POST['config_address']) ? addslashes(str_replace("'","\'",trim($_POST['config_address']))) : '';
		$config_birthday = @isset($_POST['config_birthday']) ? addslashes(str_replace("'","\'",trim($_POST['config_birthday']))) : '';
		$config_detail = @isset($_POST['config_detail']) ? addslashes(str_replace("'","\'",trim($_POST['config_detail']))) : '';
		$config_about = @isset($_POST['config_about']) ? addslashes(str_replace("'","\'",trim($_POST['config_about']))) : '';
		$config_foot_count = @isset($_POST['config_foot_count']) ? addslashes(str_replace("'","\'",trim($_POST['config_foot_count']))) : '';
		
		$data = "<?php
				 \$config_admin_dir = '".$config_admin_dir."';
				 \$config_is_pjax = '".$config_is_pjax."';
				 \$config_is_play = '".$config_is_play."';
	 			 \$config_is_ajax_page = '".$config_is_ajax_page."';
				 \$config_nav = '".$config_nav."';
				 \$config_favicon = '".$config_favicon."';
				 \$config_bg = '".$config_bg."';
		         \$config_headBg = '".$config_headBg."';
		         \$config_headImgUrl = '".$config_headImgUrl."';
		         \$config_nickname = '".$config_nickname."';
		         \$config_sex = '".$config_sex."';				 
		         \$config_follow_qrcode = '".$config_follow_qrcode."';
				 \$config_home_name = '".$config_home_name."';
				 \$config_home_link = '".$config_home_link."';				 
				 \$config_album_name= '".$config_album_name."';			 
			     \$config_album_link = '".$config_album_link."';
			     \$config_other_1_name = '".$config_other_1_name."';
			 	 \$config_other_1_link = '".$config_other_1_link."';
			 	 \$config_weiboname = '".$config_weiboname."';
			     \$config_address = '".$config_address."';
			 	 \$config_birthday = '".$config_birthday."';
				 \$config_detail = '".$config_detail."';
				 \$config_about = '".$config_about."';
				 \$config_foot_count = '".$config_foot_count."';
	    ?>";
		$file = dirname(__FILE__).'/config.php';
		@$fp = fopen($file, 'wb') OR emMsg('读取文件失败，如果您使用的是Unix/Linux主机，请修改主题文件config.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
		@$fw =	fwrite($fp,$data) OR emMsg('写入文件失败，如果您使用的是Unix/Linux主机，请修改主题文件config.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
		fclose($fp);
		emMsg("修改配置成功！",BLOG_URL.'?setting');
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
					  <label for="config_admin_dir">版本检测</label>
					  <p class="am-form-help">
						<?php
						$version=file_get_contents('https://tongleer.com/api/interface/tongleer.php?action=updateEmlog&version=8');
						echo $version;
						?>
					  </p>
					</div>
					<div class="am-form-group">
					  <label for="config_admin_dir">后台管理员文件夹名称</label>
					  <input type="text" class="" name="config_admin_dir" id="config_admin_dir" value="<?=$config_admin_dir;?>" placeholder="">
					  <p class="am-form-help">在这里填入后台管理员文件夹名称，如admin</p>
					</div>
					<div class="am-form-group">
					  <label for="config_is_pjax">是否开启PJAX（尚存在问题）</label>
					  <div class="am-form-group">
						  <label class="am-radio-inline">
							<input type="radio"  value="y" name="config_is_pjax" <?php if($config_is_pjax=='y'){?>checked<?php }?>> 开启
						  </label>
						  <label class="am-radio-inline">
							<input type="radio" value="n" name="config_is_pjax" <?php if($config_is_pjax=='n'){?>checked<?php }?>> 关闭
						  </label>
					  </div>
					  <p class="am-form-help">开启PJAX后点击网页链接会无刷新跳转，适合结合播放器使用。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_is_play">是否开启音乐播放器</label>
					  <div class="am-form-group">
						  <label class="am-radio-inline">
							<input type="radio"  value="y" name="config_is_play" <?php if($config_is_play=='y'){?>checked<?php }?>> 开启（开启后需自行修改主题目录下footer.php进行设置歌单）
						  </label>
						  <label class="am-radio-inline">
							<input type="radio" value="n" name="config_is_play" <?php if($config_is_play=='n'){?>checked<?php }?>> 关闭
						  </label>
					  </div>
					  <p class="am-form-help">开启播放器后网页内左下角会出现播放器窗口</p>
					</div>
					<div class="am-form-group">
					  <label for="config_is_ajax_page">是否开启AJAX分页加载</label>
					  <div class="am-form-group">
						  <label class="am-radio-inline">
							<input type="radio"  value="y" name="config_is_ajax_page" <?php if($config_is_ajax_page=='y'){?>checked<?php }?>> 开启
						  </label>
						  <label class="am-radio-inline">
							<input type="radio" value="n" name="config_is_ajax_page" <?php if($config_is_ajax_page=='n'){?>checked<?php }?>> 关闭
						  </label>
					  </div>
					  <p class="am-form-help">开启分页加载后文章列表滚动到底部时会无刷新无限加载下一页的形式，来替换分页导航链接。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_nav">顶部导航链接</label>
					  <textarea class="" rows="5" name="config_nav" id="config_nav" placeholder=""><?=$config_nav;?></textarea>
					  <p class="am-form-help">在这里填入需要添加的顶部导航链接代码，如：&lt;li&gt;&lt;a href=http://baidu.com target=_blank&gt;百度&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;a href=http://qq.com target=_blank&gt;腾讯&lt;/a&gt;&lt;/li&gt;</p>
					</div>
					<div class="am-form-group">
					  <label for="config_favicon">自定义favicon图标</label>
					  <input type="text" class="" name="config_favicon" value="<?=$config_favicon;?>" id="config_favicon" placeholder="">
					  <p class="am-form-help">在这里填入自定义favicon图标url</p>
					</div>
					<div class="am-form-group">
					  <label for="config_bg">网页背景图片</label>
					  <input type="text" class="" name="config_bg" id="config_bg" value="<?=$config_bg;?>" placeholder="">
					  <p class="am-form-help">在这里填入网页背景图片url</p>
					</div>
					<div class="am-form-group">
					  <label for="config_headBg">资料卡背景图片</label>
					  <input type="text" class="" name="config_headBg" id="config_headBg" value="<?=$config_headBg;?>" placeholder="">
					  <p class="am-form-help">在这里填入资料卡背景图片url，如：https://ws3.sinaimg.cn/large/ecabade5ly1fxqhv23cpxj21hc0u0wn1.jpg</p>
					</div>
					<div class="am-form-group">
					  <label for="config_headImgUrl">头像地址</label>
					  <input type="text" class="" name="config_headImgUrl" value="<?=$config_headImgUrl;?>" id="config_headImgUrl" placeholder="">
					  <p class="am-form-help">在这里填入头像的URL地址，它会显示在你的头部资料卡和每条微博前，如：https://cambrian-images.cdn.bcebos.com/39ceafd81d6813a014e747db4aa6f0eb_1524963877208.jpeg</p>
					</div>
					<div class="am-form-group">
					  <label for="config_nickname">昵称</label>
					  <input type="text" class="" name="config_nickname" value="<?=$config_nickname;?>" id="config_nickname" placeholder="">
					  <p class="am-form-help">在这里填入微博昵称，它会显示在你的头部资料卡，如：快乐贰呆</p>
					</div>
					<div class="am-form-group">
					  <label for="config_sex">性别</label>
					  <div class="am-form-group">
						  <label class="am-radio-inline">
							<input type="radio"  value="boy" name="config_sex" <?php if($config_sex=='boy'){?>checked<?php }?>> 男
						  </label>
						  <label class="am-radio-inline">
							<input type="radio" value="girl" name="config_sex" <?php if($config_sex=='girl'){?>checked<?php }?>> 女
						  </label>
					  </div>
					  <p class="am-form-help">开启播放器后网页内左下角会出现播放器窗口</p>
					</div>
					<div class="am-form-group">
					  <label for="config_follow_qrcode">关注二维码</label>
					  <input type="text" class="" name="config_follow_qrcode" value="<?=$config_follow_qrcode;?>" id="config_follow_qrcode" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡关注的二维码图片地址</p>
					</div>
					<div class="am-form-group">
					  <label for="config_home_name">主页</label>
					  <input type="text" class="" name="config_home_name" value="<?=$config_home_name;?>" id="config_home_name" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡关注右侧按钮的名称，如：主页</p>
					</div>
					<div class="am-form-group">
					  <label for="config_home_name">主页链接</label>
					  <input type="text" class="" name="config_home_link" value="<?=$config_home_link;?>" id="config_home_name" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡关注右侧按钮的链接，如：http://www.tongleer.com</p>
					</div>
					<div class="am-form-group">
					  <label for="config_album_name">相册名称</label>
					  <input type="text" class="" name="config_album_name" value="<?=$config_album_name;?>" id="config_album_name" placeholder="">
					  <p class="am-form-help">在这里填入自定义相册页面的名称，如：相册，模板page_album.php即为相册模板，只需建立独立页面即可。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_album_link">相册链接</label>
					  <input type="text" class="" name="config_album_link" value="<?=$config_album_link;?>" id="config_album_link" placeholder="">
					  <p class="am-form-help">在这里填入自定义相册页面的链接，模板page_album.php即为相册模板，只需建立独立页面后在页面模板处填写page_album即可。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_other_1_name">资料卡更多下第一行名称</label>
					  <input type="text" class="" name="config_other_1_name" value="<?=$config_other_1_name;?>" id="config_other_1_name" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡更多按钮第一行的名称</p>
					</div>
					<div class="am-form-group">
					  <label for="config_other_1_link">资料卡更多下第一行名称的链接</label>
					  <input type="text" class="" name="config_other_1_link" value="<?=$config_other_1_link;?>" id="config_other_1_link" placeholder="">
					  <p class="am-form-help">在这里填入头部资料卡更多按钮第一行的名称的链接</p>
					</div>
					<div class="am-form-group">
					  <label for="config_weiboname">微博认证资料名称</label>
					  <input type="text" class="" name="config_weiboname" value="<?=$config_weiboname;?>" id="config_weiboname" placeholder="">
					  <p class="am-form-help">在这里填入微博认证资料名称</p>
					</div>
					<div class="am-form-group">
					  <label for="config_address">地区</label>
					  <input type="text" class="" name="config_address" value="<?=$config_address;?>" id="config_address" placeholder="">
					  <p class="am-form-help">在这里填入地区</p>
					</div>
					<div class="am-form-group">
					  <label for="config_birthday">生日</label>
					  <input type="text" class="" name="config_birthday" value="<?=$config_birthday;?>" id="config_birthday" placeholder="">
					  <p class="am-form-help">在这里填入生日</p>
					</div>
					<div class="am-form-group">
					  <label for="config_detail">简介</label>
					  <input type="text" class="" name="config_detail" value="<?=$config_detail;?>" id="config_detail" placeholder="">
					  <p class="am-form-help">在这里填入简介</p>
					</div>
					<div class="am-form-group">
					  <label for="config_about">更多资料链接</label>
					  <input type="text" class="" name="config_about" value="<?=$config_about;?>" id="config_about" placeholder="">
					  <p class="am-form-help">在这里填入更多资料的链接，推荐新建page_about模板页面</p>
					</div>
					<div class="am-form-group">
					  <label for="config_foot_count">统计代码</label>
					  <textarea class="" rows="5" name="config_foot_count" id="config_foot_count" placeholder=""><?=$config_foot_count;?></textarea>
					  <p class="am-form-help">在这里填入底部统计代码</p>
					</div>
					
				  </fieldset>
				  <input type="hidden" class="" name="action" value="setting" />
				  <button type="submit" class="am-btn am-btn-primary am-btn-block">确认修改</button>
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