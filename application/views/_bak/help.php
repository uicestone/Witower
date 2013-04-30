<?$this->view('header')?>

<div id="content" class="page-help  model-view">
	<div class="breadcrumb">您所在的位置：&nbsp;   <a href="index.html">帮助中心</a> &gt; <span class="textzs"><?=$content[title]?></span></div>
	<div id="left">
		<div class="model model-b">
			<div class="title">
				<h1><?=$content[title]?></h1>
			</div>
			<div class="content_main">
				<?=$content[content]?>
			</div>
		</div>
	</div>
	<div id="right" class="sidebar">
		<!--{loop $helplist $key $value}-->
		<dl class="box">
			<dt><a href="index.php?help-content-<?=$value[id]?>"><?=$value[title]?></a></dt>
			<!--{loop $value[sub_help] $key1 $value1}-->
			<dd><a href="index.php?help-content-<?=$value1[id]?>"><?=$value1[title]?></a></dd>
			<!--{/loop}-->
		</dl>
		<!--{/loop}-->
	</div>
</div>

<?$this->view('footer')?>

