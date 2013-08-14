<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/finance">财务管理</a>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/finance">财务管理</a></h3></div>
			<div class="main">
				<a class="btn" href="/<?=uri_segment(1)?>/addfinance<?=$query?>">增加纪录</a>
				<table class="table table-bordered">
					<thead>
						<tr><td>日期</td><td>用户</td><td>项目</td><td>金额</td><td>科目</td><td>摘要</td><td>&nbsp;</td></tr>
					</thead>
					<tbody>
						<? foreach ($finance_records as $finance_record) { ?>								
							<tr> 
								<td><?=$finance_record['date']?><br><?=$finance_record['time']?></td>
								<td><?=$finance_record['username']?></td>
								<td><?=$finance_record['project_name']?></td>
								<td><?=$finance_record['amount']?></td>
								<td><?=$finance_record['item']?></td>
								<td><?=$finance_record['summary']?></td>
								<td><a href="/admin/finance/<?=$finance_record['id']?>" class="btn btn-small">修改</a></td>
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