<?$this->view('header')?>
<div id="content" class="page-home model-view">
	<ul class="breadcrumb">
		<li>
			<strong><a href="#">用户</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			积分帐户
		</li>
	</ul>
	<div id="left">
		<div class="model">
			<div class="title"><h3>积分帐户</h3></div>
			<div class="main">
				<div class="tab">
				</div>
				<div class="show_content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>科目</th>
								<th>数额</th>
								<th>项目</th>
								<th>时间</th>
								<th>描述</th>
							</tr>
						</thead>
						<tbody>
<?foreach($finance_records as $finance_record){?>
							<tr>
								<td><?=$finance_record['item']?></td>
								<td><?=$finance_record['amount']?></td>
								<td><?=$finance_record['project_name']?></td>
								<td><?=$finance_record['datetime']?></td>
								<td><?=$finance_record['summary']?></td>
							</tr>
<?}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="right">
		<div class="box">
			<div class="title"><h3>积分：<?=$this->finance->sum(array('user'=>$this->user->id,'item'=>'积分'))?></h3></div>
		</div>
		<div class="box">
			<form class="form form-horizontal" method="post">
<?if($this->user->isCompany()){?>
				<div class="control-group">
					<input type="text" name="recharge" style="width:5em" placeholder="¥" />
					<button type="submit" class="btn">申请充值</button>
				</div>
<?}?>				
				<div class="control-group">
					<input type="text" name="withdraw" style="width:5em" placeholder="¥" />
					<button type="submit" class="btn">申请提现</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?$this->view('footer')?>