<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><a href="#">企业</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			产品管理
		</li>
	</ul>
	<? $this->view('company/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>产品管理</h3></div>
			<div class="main">
				<button class="btn" type="button" onclick="location.href = '/company/addproduct'">增加新产品</button>
				<table class="table table-bordered">
					<thead>
						<tr><td>产品名称</td><td class="image">图片</td><td class="descript">描述</td><td>操作</td><td>统计</td></tr>
					</thead>
					<tbody>
						<? foreach ($products as $product) { ?>								
							<tr> 
								<td><?= $product['name'] ?></td>
								<td class="image"><?=$this->image('product',$product['id'],100)?></td>
								<td><?= $product['description'] ?></td>
								<td>
									<a class="btn btn-small" href="/company/product/<?= $product['id'] ?>">修改</a><br>
									<a class="btn btn-small" href="/company/addproject?product=<?= $product['id'] ?>">发布项目</a>
								</td>
								<td>
									<?= $product['projects_witting'] ?>个进行中的项目<br>
									<?= $product['projects_voting'] ?>个投票中的项目<br>
									<?= $product['wits'] ?>个创意
								</td>
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