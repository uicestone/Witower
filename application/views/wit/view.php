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
			<a href="/wit/<?=$wit['id']?>"><?=$wit['name']?></a>
		</li>
	</ul>
	<div id="left">
		<div class="model model-b">
			<div class="title">
				<h3><?=$version['name']?></h3>
				<?if($wit['selected']){?><span class="icon-check" title="已选中"></span><?}?>
				<?if($wit['deleted']){?><span class="icon-remove-sign" title="已删除"></span><?}?>
			</div>
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
						<a href="/space/<?=$witter['id']?>"><?=$this->image('avatar',$witter['id'],100,50)?><span><?=$witter['name']?></span></a>
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
<?if($this->user->isLogged('wit') || $this->user->id==$project['company']){?>
		<div class="box">
			<div class="title">
				<h3>版本操作</h3>
			</div>
			<div class="main">
				<form class="form form-inline" method="post">
					<div class="control-group">
						<input type="text" name="score[<?=$version['id']?>]" value="<?=$version[$score_field]?>" placeholder="打分" style="width:9em" />
						<button type="submit" class="btn">打分</button>
					</div>
					<div class="control-group">
						<button type="submit" name="removeversion" value="<?=$version['id']?>" class="btn btn-danger">删除</button>
					</div>
				</form>
			</div>
		</div>
		<div class="box">
			<div class="title">
				<h3>创意操作</h3>
			</div>
			<div class="main">
				<form class="form form-inline" method="post">
<?	if($project['status']==='buffering'){?>
<?		if($wit['selected']){?>
					<a href="/wit/unselect/<?=$wit['id']?>" class="btn">取消选中</a>
<?		}else{?>
					<a href="/wit/select/<?=$wit['id']?>" class="btn btn-primary">选中</a>
<?		}?>
<?	}?>
					<button type="submit" name="remove" value="<?=$wit['id']?>" class="btn btn-danger">删除</button>
				</form>
			</div>
		</div>
<?}?>
	</div>
</div>

<? $this->view('footer') ?>
