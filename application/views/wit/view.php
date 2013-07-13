<? $this->view('header') ?>
<div class="page-wit model-view">
	<ul class="breadcrumb">
		<li>
			<strong><a href="/project">项目</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/project/view/<?=$project['id']?>"><?=$project['name']?></a>
			<span class="divider">/</span>
		</li>
		<li>
			<?=$wit['name']?>
		</li>
	</ul>
	<div id="left">
		<div class="model model-b">
			<div class="title"><h3><?=$version['name']?><?if($wit['selected']){?><span class="icon-check" title="已选中"></span><?}?></h3></div>
			<div class="main">
				<?=$version['content']?>
			</div>
		</div>
	</div>
	
	<div id="right" class="sidebar">
		<div class="box">
			<div class="title">
				<h3>参与人员（<?=count($witters)?>）</h3><a href="#" class="more">more</a>
			</div>
			<div class="main participator">
				<ul>
					<?foreach($witters as $witter){?>
					<li>
						<?=$this->image('avatar',$witter['id'],100,50)?><a href="/space/<?=$witter['id']?>"><span><?=$witter['name']?></span></a>
						<?followButton($witter['id'])?>
					</li>
					<?}?>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>
					版本<?=$version['num']?>
					/
					共<?=$versions?>个版本
				</h3>
			</div>
			<div class="main">
				<a <?if(isset($previous_version['num'])){?>href="/wit/<?=$wit['id']?>?version=<?=$previous_version['num']?>"<?}?> class="btn<?if(!$previous_version){?> disabled<?}?>">较早版本</a>
				<a <?if(isset($next_version['num'])){?>href="/wit/<?=$wit['id']?>?version=<?=$next_version['num']?>"<?}?> class="btn<?if(!$next_version){?> disabled<?}?>">较新版本</a>
			</div>
		</div>
<?if($this->user->isLogged('witeditor') || $this->user->id==$project['id']){?>
		<div class="box">
			<div class="title">
				<h3>操作</h3>
			</div>
			<div class="main">
				<form class="form-inline" method="post">
					<input type="text" name="score[<?=$version['id']?>]" value="<?=$version['score_company']?>" placeholder="打分" style="width:9em" />
					<button type="submit" class="btn">提交</button>
					<br /><br />
					<button type="submit" name="select" value="<?=$wit['id']?>" class="btn btn-primary">选中此创意</button>
					<button type="submit" name="removeversion" value="<?=$version['id']?>" class="btn btn-danger">删除此版本</button>
				</form>
			</div>
		</div>
<?}?>
	</div>
</div>

<? $this->view('footer') ?>
