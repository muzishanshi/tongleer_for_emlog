<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="post-comments" style="font-size:12px"><!--侧滑评论所需ID-->
	<input type="hidden" id="exist-comment" value="<?=$type=='page'||$type=='blog';?>" />
	<div class="comments vcomment" id="comments">
	<?php if($allow_remark=="y"){?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	<?php }else{?>
	<p>本文已关闭评论</p>
	<?php }?>
	<?php blog_comments($comments); ?>
	</div>
</div>