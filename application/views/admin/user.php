<? $this->view('header') ?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/user">用户管理</a></h3></div>
			<div class="main">
				<a class="btn" href="/<?=uri_segment(1)?>/adduser">增加用户</a>
				<form class="form-inline" style="display:inline">
					<input type="text" name="name" class="span3" value="<?=$this->input->get('name')?>">
					<button type="submit" class="btn">搜索</button>
				</form>
				<table class="table table-bordered">
					<thead>
						<tr><th>名称</th><th>电子邮件</th><th>组</th><th width="96px">&nbsp;</th></tr>
					</thead>
					<tbody>
						<? foreach ($users as $user) { ?>								
							<tr> 
								<td><a href="/space/<?=$user['id']?>"><?=$user['name']?></a></td>
								<td><?=$user['email']?></td>
								<td><?=$user['group']?></td>
								<td>
									<a href="/admin/user/<?=$user['id']?>" class='btn btn-small'>编辑</a>
									<a href="/admin/finance?user=<?=$user['id']?>" class='btn btn-small'>财务</a>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<?=$pagination?>
			</div>
		</div>
	</div>
<?
$this->view('footer')?>