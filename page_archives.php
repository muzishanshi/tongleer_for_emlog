<?php
/*
Custom:page_archives
Description:归档
*/
if (!defined('EMLOG_ROOT')) {exit('error!');} ?>
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
<section class="page-main">
	<ol class="am-breadcrumb">
		<li><a href="<?php echo BLOG_URL; ?>" class="am-icon-home">首页</a></li>
		<li class="am-active"><?php echo $log_title; ?></li>
	</ol>
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
	<div class="am-panel-group" id="accordion">
	  <?php
	  global $CACHE; 
	  $record_cache = $CACHE->readCache('record');
	  ?>
	  <?php
		$i=1;$year=0; $mon=0;
		$output = "";
		$db = Database::getInstance();
		$sql = "SELECT gid, title, date,views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
		$result = $db->query($sql);
		while ($row = $db->fetch_array($result)) {
			$log_url = Url::log($row['gid']);
			$year_tmp = date('Y',$row['date']);
			$mon_tmp = date('m',$row['date']);
			if ($mon != $mon_tmp && $mon > 0){
				$output .= '
							</ul>
						</div>
					</div>
				</div>
				';  //结束拼接
			}
			if ($year != $year_tmp && $year > 0){
			}
			if ($year != $year_tmp) {
				$year = $year_tmp;
			}
			if ($mon != $mon_tmp) {
				$mon = $mon_tmp;
				$output .= "
					<div class=\"am-panel am-panel-default\">
						<div class=\"am-panel-hd\">
							<h4 class=\"am-panel-title\" data-am-collapse=\"{parent: '#accordion', target: '#do-not-say-".$i."'}\">".$year."年".$mon."月
							</h4>
						</div>
						<div id=\"do-not-say-".$i."\" class=\"am-panel-collapse am-collapse\">
							<div class=\"am-panel-bd\">
								<ul>
				";
			}
			$output .= "
				<li>时间：<time>".date('d日',$row['date'])."</time>&nbsp;&nbsp;标题：<a href=\"".$log_url."\">".$row['title']."</a></li>
			";
			$i++;
		}
		echo $output.'
					</ul>
				</div>
			</div>
		</div>
		';
	  ?>
	</div>
</section>
<?php include View::getView('footer');?>