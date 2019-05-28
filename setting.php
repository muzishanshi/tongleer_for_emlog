<?php 
/*
 * @WeiboForEmlog
 * @authors 二呆 (www.tongleer.com)
 * @date    2019-03-22
 * @version 1.0.11
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
require_once(dirname(__FILE__).'/config.php');
if (ROLE == ROLE_ADMIN){
	$db = Database::getInstance();
	$res = $db->query("SELECT option_value FROM ".DB_PREFIX."options WHERE option_name='nonce_templet'");
	$row = $db->fetch_array($res);
	$config_playjsonvalue='
		[{
			"title":"花下舞剑",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/49/7/2753401394.jpg",
			"src":"http://other.web.rf01.sycdn.kuwo.cn/resource/n1/84/87/3802376964.mp3",
			"lyric":"'.TPLS_URL.$row["option_value"].'/assets/smusic/data/tongkeke-huaxiawujian.lrc"
		},{
			"title":"萌二代",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/35/65/238194684.jpg",
			"src":"http://other.web.rg01.sycdn.kuwo.cn/resource/n3/21/49/2096701565.mp3",
			"lyric":"'.TPLS_URL.$row["option_value"].'/assets/smusic/data/tongkeke-mengerdai.lrc"
		},{
			"title":"吃货进行曲",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/26/34/1695727344.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n3/15/72/1780780959.mp3",
			"lyric":"'.TPLS_URL.$row["option_value"].'/assets/smusic/data/tongkeke-chihuojinxingqu.lrc"
		},{
			"title":"小秘密",
			"singer":"童可可",
			"cover":"https://img3.kuwo.cn/star/albumcover/240/55/73/500614479.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n1/74/68/3330561514.mp3",
			"lyric":"'.TPLS_URL.$row["option_value"].'/assets/smusic/data/tongkeke-xiaomimi.lrc"
		},{
			"title":"听你爱听的歌",
			"singer":"童可可",
			"cover":"https://img1.kuwo.cn/star/starheads/240/16/85/44330486.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n2/80/39/46671518.mp3",
			"lyric":"'.TPLS_URL.$row["option_value"].'/assets/smusic/data/tongkeke-tingniaitingdege.lrc"
		},{
			"title":"别让我放不下",
			"singer":"童可可",
			"cover":"https://img1.kuwo.cn/star/albumcover/240/9/59/996272309.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n1/15/60/2541949312.mp3",
			"lyric":"'.TPLS_URL.$row["option_value"].'/assets/smusic/data/tongkeke-bierangwofangbuxia.lrc"
		},{
			"title":"非主恋",
			"singer":"童可可",
			"cover":"https://img4.kuwo.cn/star/albumcover/240/21/10/339989310.jpg",
			"src":"http://other.web.rh01.sycdn.kuwo.cn/resource/n2/34/93/1218459911.mp3",
			"lyric":"'.TPLS_URL.$row["option_value"].'/assets/smusic/data/tongkeke-feizhulian.lrc"
		}]
	';
	$action = isset($_POST['action']) ? addslashes($_POST['action']) : '';
	if($action=='setting'){
		$config_admin_dir = @isset($_POST['config_admin_dir']) ? addslashes(str_replace("'","\'",trim($_POST['config_admin_dir']))) : 'admin';
		$config_is_pjax = @isset($_POST['config_is_pjax']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_pjax']))) : 'n';
		$config_is_play = @isset($_POST['config_is_play']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_play']))) : 'n';
		$config_is_ajax_page = @isset($_POST['config_is_ajax_page']) ? addslashes(str_replace("'","\'",trim($_POST['config_is_ajax_page']))) : 'n';
		$config_is_play_auto = @isset($_POST['config_is_play_auto']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_play_auto']))) : 'false';
		$config_is_play_defaultMode = @isset($_POST['config_is_play_defaultMode']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_play_defaultMode']))) : '1';
		$config_playjson = @isset($_POST['config_playjson']) ? trim($_POST['config_playjson']) : $config_playjsonvalue;
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
				 \$config_is_play_auto = '".$config_is_play_auto."';
				 \$config_is_play_defaultMode = '".$config_is_play_defaultMode."';
				 \$config_playjson = '".$config_playjson."';
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
	.page-main {width: 100%;}
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
						$version=file_get_contents('https://www.tongleer.com/api/interface/tongleer.php?action=updateEmlog&version=11');
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
					  <label for="config_is_pjax">是否开启PJAX</label>
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
							<input type="radio"  value="y" name="config_is_play" <?php if($config_is_play=='y'){?>checked<?php }?>> 开启
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
					  <p class="am-form-help">开启分页加载后文章列表滚动到底部时会无刷新无限加载下一页的形式，来替换分页导航链接。目前开启后会与图片放大功能冲突。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_is_play_auto">是否自动播放</label>
					  <div class="am-form-group">
						  <label class="am-radio-inline">
							<input type="radio"  value="true" name="config_is_play_auto" <?php if($config_is_play_auto=='true'){?>checked<?php }?>> 自动
						  </label>
						  <label class="am-radio-inline">
							<input type="radio" value="false" name="config_is_play_auto" <?php if($config_is_play_auto=='false'){?>checked<?php }?>> 手动
						  </label>
					  </div>
					  <p class="am-form-help">开启后将自动播放音乐。</p>
					</div>
					<div class="am-form-group">
					  <label for="config_is_play_defaultMode">播放模式</label>
					  <div class="am-form-group">
						  <label class="am-radio-inline">
							<input type="radio"  value="1" name="config_is_play_defaultMode" <?php if($config_is_play_defaultMode=='1'){?>checked<?php }?>> 列表循环
						  </label>
						  <label class="am-radio-inline">
							<input type="radio" value="2" name="config_is_play_defaultMode" <?php if($config_is_play_defaultMode=='2'){?>checked<?php }?>> 随机播放
						  </label>
						  <label class="am-radio-inline">
							<input type="radio" value="3" name="config_is_play_defaultMode" <?php if($config_is_play_defaultMode=='3'){?>checked<?php }?>> 单曲循环
						  </label>
					  </div>
					  <p class="am-form-help">选择一种播放音乐的模式</p>
					</div>
					<div class="am-form-group">
					  <label for="config_playjson">播放器音乐数据</label>
					  <textarea class="" rows="5" name="config_playjson" id="config_playjson" placeholder=""><?=$config_playjsonvalue;?></textarea>
					  <p class="am-form-help">自定义歌单需要至少2首，可到<a href="http://api.tongleer.com/music/" target="_blank">http://api.tongleer.com/music/</a>下载歌曲，专辑图片网络有现成的就用现成的，没有就上传微博图床后设置到此处，歌词文件一般酷狗、酷我等软件即可生成。</p>
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