<? $this->view('header') ?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/company">企业管理</a></h3></div>
			<div class="main">
				<a class="btn" href="/<?=uri_segment(1)?>/addcompany">增加企业</a>
				<table class="table table-bordered">
					<thead>
						<tr><th>名称</th><th>电子邮件</th><th width="96px">&nbsp;</th></tr>
					</thead>
					<tbody>
						<? foreach ($companies as $company) { ?>								
							<tr> 
								<td><a href="/space/<?=$company['id']?>"><?=$company['name']?></a></td>
								<td><?=$company['email']?></td>
								<td>
									<a href="/admin/company/<?=$company['id']?>" class="btn btn-small">编辑</a>
									<a href="/admin/finance?user=<?=$company['id']?>" class="btn btn-small">财务</a>
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