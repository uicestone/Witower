	<div id="right" class="sidebar span3">
<?if(isset($witters)){?>
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
<?}?>
<?if(isset($versions)){?>
		<div class="box">
			<div class="title">
				<h3>
					版本<?=$version['num']?>
					/
					共<?=$versions?>个版本
				</h3>
			</div>
<?if(isset($previous_version) && isset($next_version)){?>
			<div class="main">
				<a <?if(isset($previous_version['num'])){?>href="/wit/<?=$wit['id']?>?version=<?=$previous_version['num']?>"<?}?> class="btn<?if(!$previous_version){?> disabled<?}?>">较早版本</a>
				<a <?if(isset($next_version['num'])){?>href="/wit/<?=$wit['id']?>?version=<?=$next_version['num']?>"<?}?> class="btn<?if(!$next_version){?> disabled<?}?>">较新版本</a>
			</div>
<?}?>			
		</div>
<?}?>
<?if(($this->user->isLogged('wit') || $this->user->id==$project['company']) && isset($version) && $project['status']!=='end'){?>
		<div class="box">
			<div class="title">
				<h3>版本操作</h3>
			</div>
			<div class="main">
				<?$this->view('alert')?>
				<form class="form form-inline" method="post">
					<div class="control-group">
						<input type="text" name="score[<?=$version['id']?>]" value="<?=$version['score']?>" placeholder="打分" style="width:9em;" />
						<button type="submit" class="btn">打分</button>
						<textarea name="comment[<?=$version['id']?>]" placeholder="评语" style="width:94%;margin-top:0.5em;"><?=$version['comment']?></textarea>
					</div>
					<div class="control-group">
						<a href="/wit/removeversion/<?=$version['id']?>" class="btn btn-danger" title="将当前版本标记为删除">删除</a>
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
					<a href="/wit/remove/<?=$wit['id']?>" class="btn btn-danger">删除</a>
				</form>
			</div>
		</div>
<?}?>
	</div>
