<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="side-button">
	<ul>
		<li id="go-top" class="am-icon-btn am-icon-arrow-up"></li>
		<li id="go-bottom" class="am-icon-btn am-icon-arrow-down"></li>
		<!--侧滑评论所需开始-->
		<?php if ($type=='page'||$type=='blog') : ?>
		<li id="ex-comment" class="am-icon-btn am-icon-comments"></li>
		<?php endif; ?>
		<!--侧滑评论所需结束-->
	</ul>
</div>
<!-- footer -->
<footer class="am-footer am-footer-default">
	<div class="am-footer-miscs ">
		<?=printLinks();?>
    </div>
	<div class="am-footer-miscs ">
		<!--尊重以下网站版权是每一个合法公民应尽的义务，请不要去除以下版权。-->
		<p>
			CopyRight©<?=date("Y");?> <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a> Powered by <a href="http://www.emlog.net/" title="Emlog" rel="nofollow">Emlog</a> Theme By <a id="rightdetail" href="http://www.tongleer.com" title="同乐儿">Tongleer</a>
		</p>
    </div>
	<div style="display:none;"><?=$config_foot_count;?></div>
</footer>
<?php doAction('index_footer'); ?>
<!--pjax刷新开始-->
<?php if($config_is_pjax=='y'){?>
<style>
.pjax_loading {position: fixed;top: 45%;left: 45%;display: none;z-index: 999999;width: 124px;height: 124px;background: url('<?php echo TEMPLATE_URL; ?>assets/images/pjax_loading.gif') 50% 50% no-repeat;}
.pjax_loading1 {position: fixed;top: 0;left: 0;z-index: 999999;display: none;width: 100%;height: 100%;opacity: .2}
</style>
<script src="https://www.tongleer.com/cdn/jquery/jquery.pjax.min.js"></script>
<script type="text/javascript" language="javascript">
$(function() {
	ajaxComment();
	$(document).pjax('a[target!=_blank]', '#content', {fragment:'#content', timeout:6000});
	$(document).on('submit', 'form[id!=commentform]', function (event) {
		$.pjax.submit(event, '#content', {fragment:'#content', timeout:6000});
	});
	$(document).on('pjax:send', function() {
		$(".pjax_loading,.pjax_loading1").css("display", "block");
	});
	$(document).on('pjax:complete', function() {
		$(".pjax_loading,.pjax_loading1").css("display", "none");
		$("#side-button ul #ex-comment").remove();
		if($("#exist-comment").val()){
			$("#side-button ul").append('<li id="ex-comment" class="am-icon-btn am-icon-comments"></li>');
			$("#ex-comment").click(function() {
				$("#post-comments").toggleClass("comment-open");
			});
		}
		if(window.location.href.indexOf("logout")!=-1){
			location.href="<?php echo BLOG_URL; ?>";
		}
		ajaxComment();
	});
	function ajaxComment(){
		$("#commentform").submit(function(){
			$("#commentAlert").html("提交评论中……");
			$.ajax({
				type: $(this).attr("method"),
				url: $(this).attr("action"),
				data: $(this).serializeArray(),
				success: function(data) {
					var pattern = /<div class="main">[\r\n]+<p>(.*?)<\/p>/;
					if(pattern.test(data)) {
						arr = data.match(pattern);
						$("#commentAlert").html(arr[1]);
					}else{
						$("#commentAlert").html("评论成功，刷新可显示内容。");
					}
				},
				error: function(t) {
					alert("Ajax Comment Error"),
					window.location.reload()
				}
			});
			return false;
		});
	}
});
</script>
<div class="pjax_loading"></div>
<div class="pjax_loading1"></div>
<?php }?>
<!--pjax刷新结束-->
<!--音乐播放器开始-->
<?php if($config_is_play=='y'){?>
<link href="https://apps.bdimg.com/libs/fontawesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>assets/smusic/css/smusic.css"/>
<div class="grid-music-container f-usn" id="music">
	<a id="hidemusic" href="#" onClick="doAct();"><i class="fa fa-music suo"></i></a>
    <div class="m-music-play-wrap">
        <div class="u-cover"></div>
        <div class="m-now-info">
            <h1 class="u-music-title"><strong>标题</strong><small>歌手</small></h1>
            <div class="m-now-controls">
                <div class="u-control u-process">
                    <span class="buffer-process"></span>
                    <span class="current-process"></span>
                </div>
                <div class="u-control u-time">00:00/00:00</div>
                <div class="u-control u-volume">
                    <div class="volume-process" data-volume="0.50">
                        <span class="volume-current"></span>
                        <span class="volume-bar"></span>
                        <span class="volume-event"></span>
                    </div>
                    <a class="volume-control"></a>
                </div>
            </div>
            <div class="m-play-controls">
                <a class="u-play-btn prev" title="上一曲"></a>
                <a class="u-play-btn ctrl-play play" title="暂停"></a>
                <a class="u-play-btn next" title="下一曲"></a>
                <a class="u-play-btn mode mode-list<?php if($config_is_play_defaultMode==1){?> current<?php }?>" title="列表循环"></a>
                <a class="u-play-btn mode mode-random<?php if($config_is_play_defaultMode==2){?> current<?php }?>" title="随机播放"></a>
                <a class="u-play-btn mode mode-single<?php if($config_is_play_defaultMode==3){?> current<?php }?>" title="单曲循环"></a>
            </div>
        </div>
    </div>
    <div class="f-cb">&nbsp;</div>
    <div class="m-music-list-wrap" style="display:none;"></div>
    <div class="m-music-lyric-wrap" style="display:none;">
        <div class="inner">
            <ul class="js-music-lyric-content">
                <li class="eof">暂无歌词...</li>
            </ul>
        </div>
    </div>
</div>
<script>
function doAct(){
	var s=document.getElementById('hidemusic');
	var t = document.getElementById('music'),
	c = s.className;
	if(c != null && c.indexOf('more') > -1){
		s.className = c.replace('more', '');
		t.className = t.className.replace('grid-music-container-active', '');
	}else{
		s.className = c + ' more';
		t.className = t.className + ' grid-music-container-active';
		var t=setTimeout("doAct()",5000);
	}
}
</script>
<script src="<?php echo TEMPLATE_URL; ?>assets/smusic/js/smusic.js"></script>
<script>
	var musicList=<?=$config_playjson;?>;
	new SMusic({
        musicList : musicList,
        autoPlay  : <?=$config_is_play_auto;?>,  /*是否自动播放*/
        defaultMode : <?=$config_is_play_defaultMode;?>,   /*默认播放模式，随机*/
        callback   : function (obj) {  /*返回当前播放歌曲信息*/
            console.log(obj);
        }
    });
</script>
<?php }?>
<!--音乐播放器结束-->
<!--[if lt IE 9]>-->
<script src="https://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>assets/js/amazeui.ie8polyfill.min.js"></script>
<!--[endif]-->
<script src="<?php echo TEMPLATE_URL; ?>assets/js/amazeui.widgets.helper.min.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>assets/js/amazeui.min.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>assets/js/app.js"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<script>
/*侧滑评论所需开始*/
$(function() {
	$("#ex-comment").click(function() {
		$("#post-comments").toggleClass("comment-open");
	});
});
/*侧滑评论所需结束*/
/*goToTop*/
$(function(){
	$("#go-top").hide();
	$(window).scroll(function(){
		if($(this).scrollTop() > 100){
			$('#go-top').fadeIn();
		}else{
			$('#go-top').fadeOut();
		}
	});
	$('#go-top').click(function(){
		$('html ,body').animate({scrollTop: 0}, 300);
		return false;
	});
});
/*goToBottom*/
$(function(){
	$(window).scroll(function(){
		if($(this).scrollTop() > (document.body.scrollHeight - 1000)) {
			$('#go-bottom').fadeOut();
		}else{
			$('#go-bottom').fadeIn();
		}
	});
	$('#go-bottom').click(function(){
		$('html ,body').animate({scrollTop: document.body.scrollHeight}, 300);
		return false;
	});
});
</script>
</body>
</html>