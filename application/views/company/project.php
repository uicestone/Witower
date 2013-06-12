<?$this->view('header')?>
<div id="content" class="page-company">
	<div class="breadcrumb">
		<strong>企业</strong> >> 项目管理
	</div>
	<?$this->view('company/sidebar')?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>项目管理</h3></div>
			<div class="main">
				<div class="tab">
				</div>
				<div class="show_content">
					<form>
						<button class="btn" type="button" onclick="location.href='/?user-editproject'">增加新项目</button>
						<table class="table table-bordered">
							<thead>
								<tr> <td>编号</td><td>项目名称</td>
									<td>所属产品</td>
									<td>图片</td><td style="width: 70px;">描述</td><td style="width:100px;">时间</td><td>操作</td><!--<td>统计</td>--></tr>
							</thead>
							<tbody>
								<tr>
								 <td><?=$project[p_id]?></td>
								 <td><?=$project[title]?></td>
								 <td><?=$project[product_name]?></td>
								 <td><img src="/uploads/images/projects/<?=$project[p_id]?>.jpg" width="80px"></td>
								 <td><?=$project[summary]?></td>
									<td>发布：<br><?=$project[start_time]?><br>截止：<br><?=$project[end_time]?></td>
									<td><button class="btn btn-small" type="button" >查看</button><br>
										<button class="btn btn-small" type="button" >修改</button><br></td>
										6个投票中的项目
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>