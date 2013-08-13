<?$this->view('header')?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/finance">用户管理</a>
			<span class="divider">/</span>
		</li>
		<li>
			<?if(isset($user['id'])){?>编辑用户<?}else{?>添加用户<?}?>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3><?if(isset($user['id'])){?>编辑用户<?}else{?>添加用户<?}?></h3></div>
			<div class="main">
				<div class="show_content">
					<?$this->view('alert')?>
					<form class="form-horizontal" method="post">
						<div class="control-group">
							<label class="control-label">用户名</label>
							<div class="controls">
								<input type="text" name="name" value="<?=set_value('name',$user['name'])?>">
								<span class="label label-important"><?=form_error('name')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">密码</label>
							<div class="controls">
								<input type="password" name="password">
								<span class="label label-important"><?=form_error('password')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">电子邮件</label>
							<div class="controls">
								<input type="text" name="email" value="<?=set_value('email',$user['email'])?>">
								<span class="label label-important"><?=form_error('email')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">组</label>
							<div class="controls">
								<input type="text" name="group" value="<?=set_value('group',$user['group'])?>">
								<span class="label label-important"><?=form_error('group')?></span>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">保存</button>
								<a href="/admin/finance?user=<?=$user['id']?>" class="btn">财务</a>
							</div>
						</div>
						<table class="table table-bordered">
							<thead>
								<tr><th>资料项</th><th>内容</th></tr>
							</thead>
							<tbody>
								<? foreach ($profiles as $name => $content) { ?>								
									<tr> 
										<td><?=$name?></td>
										<td><?=$content?></td>
									</tr>
								<? } ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>