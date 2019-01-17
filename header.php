<?php
/*
Template Name:WeiboForEmlog<br /><a href="../?setting" target="_blank">模板设置</a>&nbsp;<a href="https://github.com/muzishanshi/tongleer_for_emlog" target="_blank">主题Github</a>&nbsp;
Description:一个适合做自媒体的Emlog微博主题
Version:1.0.10
ForEmlog:6.0.1
Author:二呆
Author Url:http://www.tongleer.com
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once(dirname(__FILE__).'/config.php');
require_once View::getView('module');
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title><?php echo $site_title; ?> <?php echo page_tit($page); ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <meta name="author" content="<?php echo $site_title; ?>">
  <meta name="description" itemprop="description" content="<?php echo $site_description; ?>">
  <meta name="keywords" content="<?php echo $site_key; ?>">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>style.css" />
  <link rel="alternate icon" href="<?=$config_favicon;?>" type="image/png" />
  <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>assets/css/amazeui.min.css"/>
  <!--[if lt IE 9]>-->
  <script src="https://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
  <!--[endif]-->
  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="<?php echo TEMPLATE_URL; ?>assets/js/jquery.min.js"></script>
  <!--<![endif]-->
  <?php if($config_is_ajax_page=='y'){?>
  <script src="<?php echo TEMPLATE_URL; ?>assets/js/jquery.ias.min.js" type="text/javascript"></script>
  <?php }?>
  <?php doAction('index_head'); ini_set('date.timezone','Asia/Shanghai');?>
</head>
<body style="background-image: url('<?php echo $config_bg;?>');">
<style>
.banner-head{
	background-image: url(https://ws3.sinaimg.cn/large/ecabade5ly1fxqhgnclydj21hc0u0wn1.jpg);
	width:960px;
	margin:10px auto -10px auto;
	text-align: center;
	padding:30px;
	color:#fff;
}
.banner-nav{
	width:960px;
	margin:0px auto 15px auto;
	text-align: center;
	background-color:#fff;
	border:1px solid #eee;
}
.banner-nav button{
	background-color:#fff;
	font-size:90%;
}
@media screen and (max-width: 960px) {
	.banner-head {width: 100%;}
	.banner-nav {width: 100%;}
}
</style>
<!-- navigation panel -->
<header class="am-topbar am-topbar-fixed-top" style="opacity:0.9;">
  <div class="am-container">
	<h1 class="am-topbar-brand">
	  <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
	</h1>
	
	<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only" data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
        class="am-icon-bars"></span></button>

	<div class="am-topbar-collapse am-collapse" id="collapse-head">
	  <ul class="am-nav am-nav-pills am-topbar-nav">
		  <li><a href="<?php echo BLOG_URL; ?>"><span class="am-icon-home"></span>首页</a></li>
		  <?php echo $config_nav;?>
	  </ul>
	  <?php if(!ISLOGIN){ ?>
	  <div class="am-topbar-right">
        <div class="am-topbar-btn">
			<?php if($config_is_pjax=='y'){?>
			<span class="am-icon-user"></span> <a href="<?=BLOG_URL;?><?php echo $config_admin_dir;?>">登录</a>
			<?php }else{?>
			<span class="am-icon-user"></span> <a href="javascript:;" id="login-prompt-toggle">登录</a>
			<?php }?>
		</div>
      </div>
	  <?php }else{?>
      <div class="am-topbar-right">
        <div class="am-topbar-btn">
			<span class="am-icon-user"></span><a href="<?=BLOG_URL;?><?php echo $config_admin_dir;?>"><?=$userData['nickname']!=""?$userData['nickname']:$userData['username'];?></a>
		</div>
      </div>
	  <?php }?>
	</div>
  </div>
</header>
<div class="am-modal am-modal-prompt" tabindex="-1" id="login-prompt">
  <div class="am-modal-dialog">
	<form class="am-form" id="loginForm" method="post" action="<?php echo BLOG_URL; ?><?php echo $config_admin_dir;?>/index.php?action=login">
	<div class="am-modal-hd">登录</div>
	<div class="am-modal-bd">
	  <fieldset class="am-form-set">
	  <input type="text" name="user" class="am-modal-prompt-input" placeholder="用户名">
	  <input type="password" name="pw" class="am-modal-prompt-input" placeholder="密码">
	  <input type="checkbox" name="ispersis" id="ispersis" value="1"> 记住密码
	  </fieldset>
	</div>
	<div class="am-modal-footer">
	  <span class="am-modal-btn" data-am-modal-cancel>取消</span>
	  <span class="am-modal-btn" data-am-modal-confirm>登录</span>
	</div>
	</form>
  </div>
</div>
<!--end navigation panel -->
<section class="banner-head" style="background-image:url('<?php echo $config_headBg;?>')">
	<img class="am-circle" src="<?php echo $config_headImgUrl;?>" width="100" height="100"/><br />
	<span>
		<?php echo $config_nickname;?>
		<?php if($config_sex=='girl'){echo '♀';}else{echo '♂';}?>
	</span><br />
	<small>关注 <?php echo count($Link_Model->getLinks());?>  |  粉丝 <?=count($User_Model->getUsers());?></small><br />
	<small><?php echo $bloginfo; ?></small><br />
	<small>微博认证：<?php echo $config_weiboname;?></small>
	<div>
		<div class="am-dropdown" data-am-dropdown>
		  <button class="am-btn am-btn-warning am-radius am-btn-xs am-dropdown-toggle">关注</button>
		  <div class="am-dropdown-content">
			<img src="<?php echo $config_follow_qrcode;?>" width="150" height="150"/>
		  </div>
		</div>
		<button type="button" class="am-btn am-btn-warning am-radius am-btn-xs" onClick="location.href='<?php echo $config_home_link;?>'"><?php echo $config_home_name;?></button>
		<div class="am-dropdown" data-am-dropdown>
			<button class="am-btn am-btn-warning am-radius am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span
        class="am-icon-bars"></span></button>
		  <ul class="am-dropdown-content">
			<li><a href="<?php echo $config_other_1_link;?>"><?php echo $config_other_1_name;?></li>
		  </ul>
		</div>
	</div>
</section>
<div class="banner-nav">
	<div data-am-widget="tabs">
      <ul class="am-tabs-nav">
          <li><a class="am-btn am-radius" href="<?php echo BLOG_URL; ?>">主页</a></li>
		  <li><a class="am-btn am-radius" target="_blank" href="<?php echo $config_album_link;?>"><?php echo $config_album_name;?></a></li>
      </ul>
	</div>
</div>
<script>
$('#login-prompt-toggle').on('click', function() {
    $('#login-prompt').modal({
      relatedTarget: this,
      onConfirm: function(e) {
		$('#loginForm').submit();
      },
      onCancel: function(e) {}
    });
});
</script>