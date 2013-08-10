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
								<td>类型</td>
								<td>数额</td>
								<td>项目</td>
								<td>时间</td>
							</tr>
						</thead>
						<tbody>
<?foreach($accounts as $account){?>
							<tr>
								<td><?=$account['item']?></td>
								<td><?=$account['amount']?></td>
								<td><?=$account['project']?$this->project->fetch($account['project'],'name'):''?></td>
								<td><?=$account['datetime']?></td>
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
			<form class="form form-horizontal">
				<div class="control-group">
					<input type="text" name="apply" style="width:5em" placeholder="¥" />
					<button type="submit" class="btn" disabled="disabled">申请提现</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?$this->view('footer')?>