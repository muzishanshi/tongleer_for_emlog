<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?><div style="padding:10px;background-color:#fff;">  <div class="am-u-md-8 am-u-sm-centered">	<?php	if($allow_remark == 'y'){	?>	<div class="am-g">	  <div class="am-u-md-8 am-u-sm-centered">		<form class="am-form am-form-inline" id="comment-form" role="form" method="post" action="<?php echo BLOG_URL; ?>index.php?action=addcom">		  <div class="am-form-group">			<img class="am-radius" src="<?php if($config_headImgUrl!=''){echo $config_headImgUrl;}else{echo 'https://cambrian-images.cdn.bcebos.com/39ceafd81d6813a014e747db4aa6f0eb_1524963877208.jpeg';}?>" width="35" height="35"/>		  </div>		  <div class="am-form-group">			<textarea type="text" name="comment" rows="4" cols="40" placeholder="<?php if(ISLOGIN){echo '我要发表评论...';}else{echo '登陆后可评论...';} ?>" id="comment-text" maxLength="140" class="am-form-field am-input-sm"></textarea>		  </div>		  <div class="am-form-group">			  <button type="submit" class="am-btn am-btn-warning am-radius am-btn-xs">评论</button>			  <input type="hidden" id="comment-login" data-login="<?=ISLOGIN;?>"></p>			  <input type="hidden" name="gid" value="<?php echo $logid; ?>" />			  <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>		  </div>		</form>	  </div>	</div>	<?php	}else{	?>		<button type="button" class="am-btn am-btn-default am-btn-block">评论关闭</button>	<?php	}	?>  </div></div><a name="comments"></a>
<ul class="am-comments-list" style="padding:10px;background-color:#fff;">	<?php	extract($comments);	if($commentStacks){		$i=0;		foreach($commentStacks as $cid){			$comment = $comments[$cid];		?>			<li class="am-comment">				<a href="#link-to-user-home">					<img src="<?php echo getGravatar($comment['mail']); ?>" alt="" class="am-comment-avatar" width="48" height="48">				</a>				<div class="am-comment-main">				  <header class="am-comment-hd">					<div class="am-comment-meta">					  <a href="#link-to-user" class="am-comment-author"><?php echo $comment['poster']; ?></a><time datetime="<?php echo $comment['date']; ?>" title="<?php echo $comment['date']; ?>"><?php echo $comment['date']; ?></time>评论					  <div class="am-fr">						<a href="javascript:;" class="replyfloor" id="replyfloor<?=$i;?>" data-coid="<?php echo $comment['cid']; ?>" data-author="<?php echo $comment['poster']; ?>" data-ccreated="<?php echo $comment['date']; ?>" data-ctext="<?php echo htmlspecialchars(strip_tags($comment['content'])); ?>">回复</a>						#<?php echo (($page_now-1)*$page_rec+$i);?>					  </div>					</div>				  </header>				  <div class="am-comment-bd">					<p><?php echo $comment['content']; ?></p>					<?php					foreach($comment['children'] as $child){						$comment = $comments[$child];						?>						<header class="am-comment-hd" style="padding:10px;">														<div class="am-list-item-text">							  <a href="#link-to-user" class="am-comment-author"><?php echo $comment['poster']; ?></a><time datetime="<?php echo $comment['date']; ?>" title="<?php echo $comment['date']; ?>"><?php echo $comment['date']; ?></time>评论<p><?php echo $comment['content']; ?></p>							</div>													</header>						<?php					}					?>				  </div>				</div>			</li>			<?php			$i++;		}	}	?></ul><?php if(empty($commentPageUrl)==FALSE): ?>	<div>		<?php echo $commentPageUrl;?>	</div><?php endif; ?><div class="am-modal am-modal-prompt" tabindex="-1" id="replydialog"><form class="am-form" id="reply-form" method="post" action="<?php echo BLOG_URL; ?>index.php?action=addcom">  <div class="am-modal-dialog">    <div class="am-modal-hd">评论</div>    <div class="am-modal-bd">	      <input type="text" name="comment" id="reply-text" class="am-modal-prompt-input">    	</div>    <div class="am-modal-footer">      <span class="am-modal-btn">		<button type="button" class="am-btn am-btn-warning am-radius am-btn-sm" data-am-modal-cancel>取消</button>	  </span>      <span class="am-modal-btn">		<input type="hidden" name="gid" value="<?php echo $logid; ?>" />		<input type="hidden" name="pid" id="reply-pid" value="0" size="22" tabindex="1"/>		<button type="submit" class="am-btn am-btn-warning am-radius am-btn-sm" data-am-modal-confirm>提交</button>	  </span>    </div>  </div></form></div>
<!-- end post comment --><script>$(function() {	$('#comment-form').submit(function(){		if($('#comment-text').val()==''){			return false;		}		if($('#comment-login').attr('data-login')!=1){			/*$('#login-prompt').modal();*/			alert("评论前请先登录");			return false;		}	});	$('#reply-form').submit(function(){		if($('#reply-text').val()==''){			return false;		}	});	$(".replyfloor").each(function(){		var id=$(this).attr("id");		$("#"+id).click( function () {			if($('#comment-login').attr('data-login')!=1){				/*$('#login-prompt').modal();*/				alert("评论前请先登录");				return;			}			$('#reply-pid').val($(this).attr('data-coid'));			$('#replydialog').modal({			  relatedTarget: this,			  onConfirm: function(e) {				$('#reply-form').submit();			  },			  onCancel: function(e) {			  }			});		});	});});</script>