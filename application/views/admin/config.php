<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/finance">系统设置</a>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/config">系统设置</a></h3></div>
			<div class="main">
				<table class="table table-bordered">
					<thead>
						<tr><th>键</th><th>值</th><th style="width: 4em;">&nbsp;</th></tr>
					</thead>
					<tbody>
						<? foreach ($config_items as $key => $value) { ?>								
							<tr> 
								<td><?=$key?></td>
								<td><?=$value?></td>
								<td><a href="/admin/config/<?=$key?>" class="btn btn-small">编辑</a></td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?
$this->view('footer')?>