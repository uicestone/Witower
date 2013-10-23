<? $this->view('header') ?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/finance">财务管理</a></h3></div>
			<div class="main">
				<a class="btn" href="/<?=uri_segment(1)?>/addfinance<?=$query?>">增加纪录</a>
				<a class="btn<?if(uri_segment(3)==='grouped'){?> active<?}?>" href="/<?=uri_segment(1)?>/finance/<?if(uri_segment(3)!=='grouped'){?>grouped<?}?><?=$query?>">分组</a>
				<ul class="inline pull-right">
				<? foreach ($items as $item) { ?>								
					<li> 
						<?=$item['item']?>：<?=$item['amount']?>
					</li>
				<? } ?>
				</ul>
				<table class="table table-bordered">
					<thead>
						<tr><th>日期</th><th>用户</th><th>项目</th><th>金额</th><th>科目</th><th>摘要</th><th>&nbsp;</th></tr>
					</thead>
					<tbody>
						<? foreach ($finance_records as $finance_record) { ?>								
							<tr> 
								<td><?=$finance_record['date']?><br><?=$finance_record['time']?></td>
								<td>
									<?=$finance_record['username']?>
									<a href="<?uri_string()?>?<?=http_build_query(array('user'=>$finance_record['user'])+($this->input->get()?$this->input->get():array()))?>"><span class="icon-filter pull-right"></span></a>
								</td>
								<td><?=$finance_record['project_name']?></td>
								<td><?=$finance_record['amount']?></td>
								<td>
									<?=$finance_record['item']?>
									<a href="<?uri_string()?>?<?=http_build_query(array('item'=>$finance_record['item'])+($this->input->get()?$this->input->get():array()))?>"><span class="icon-filter pull-right"></span></a>
								</td>
								<td><?=$finance_record['summary']?></td>
								<td>
									<a href="/admin/finance/<?=$finance_record['id']?>">查看</a>
<?if($finance_record['item']==='已申请提现积分' && $finance_record['amount']>0 && uri_segment(3)==='grouped'){?>
									<a href="/admin/finance/cashout?user=<?=$finance_record['user']?>&amount=<?=$finance_record['amount']?>" class="btn btn-small">兑现</a>
<?}?>
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