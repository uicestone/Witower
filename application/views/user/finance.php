<?$this->view('header')?>
    <link href="<?=base_url()?>style/jifenjilu.css" rel="stylesheet" type="text/css" />
    <div id="right" class="indexDiv">
		<div class="jifen">
			<label>积分：<?=$this->finance->sum(array('user'=>$this->user->id,'item'=>'积分'))?></label>
            <?$this->view('alert')?>
			<form class="form form-horizontal" method="post">
<?if($this->user->isCompany()){?>
				<div class="control-group">
					<input type="text" name="recharge" class="text" placeholder="¥" />
					<button type="submit" class="btn">申请充值</button>
                </div>

<?}else{?>
                <div class="control-group">
					<input type="text" name="withdraw" class="text" placeholder="¥" />
					<button type="submit" class="btn">申请提现</button>
				</div>
<?}?>
			</form>
        </div>
        <div class="content">
			<p>请您尽量在一个月内申请提现金额控制在800元，否则智塔将按照国家税务的相关规定，替您进行代扣代缴，则您到手的现金可能会和您提取的现金额度有所区别。</p>
		</div>


    <div class="hx"></div>
    <div id="left" class="span9">
		<div class="model">
			<div class="heading">积分帐户</div>
			<div class="main">
				<div class="tab">
				</div>
				<div class="show_content">
					<table class="table table-bordered" id="kuai">
                        <thead>
							<tr>
								<th>科目</th>
								<th>数额</th>
								<th>项目</th>
								<th>时间</th>
								<th>描述</th>
							</tr>
						</thead>
                    </table>
                    <table class="table table-bordered" id="kuai2">
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


    </div>

<?$this->view('footer')?>