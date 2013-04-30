<?$this->view('header')?>
<div id="content" class="page-company">
    <div class="breadcrumb">
        <strong>用户</strong><span>&nbsp;&gt;&nbsp;<!--{if $function=='home'}-->我的主页<!--{elseif $function=='space'}--><?=$userinfo[username]?><!--{/if}--></span>
    </div>
    <div id="left" class="sidebar">
        <div class="box menu">
             <ul class="nav nav-list">
		<li{if $mode=='product'} class="active"{/if}><a href="/?user-projectlist-product">产品管理</a></li>
                <li{if $mode=='project'} class="active"{/if}><a href="/?user-projectlist-project">项目管理</a></li>
<!--                <li><a href="#">作品管理</a></li>-->
<!--                <li><a href="#">财务管理</a></li>-->
<!--                <li><a href="#">用户资料</a></li>-->
                <li class="divider"></li>
			</ul>
        </div>
        <div class="box list">
            <ul class="nav nav-list">
                <li class="nav-header">寻求帮助</li>
                <li><a href="#">如何快速发布项目活动？</a></li>
                <li><a href="#">正等待你选出后选人</a></li>
                <li><a href="#">三星LEX3D手机创意作品</a></li>
                <li><a href="#">世联研究房价备案制</a></li>
                <li><a href="#">博策堂开发商正在面临</a></li>
                <li class="divider"></li>
			</ul>
        </div>
        <div class="box list">
            <ul class="nav nav-list">
                <li class="nav-header">新手帮助</li>
                <li><a href="#">如何快速发布项目活动？</a></li>
                <li><a href="#">正等待你选出后选人</a></li>
                <li><a href="#">三星LEX3D手机创意作品</a></li>
                <li><a href="#">世联研究房价备案制</a></li>
                <li><a href="#">博策堂开发商正在面临</a></li>
                <li class="divider"></li>
			</ul>
        </div>
    </div>
    <div id="right">
        <div class="model">
            <div class="title"><h3>{if $mode=='product'}编辑产品{elseif $mode=='project'}编辑项目{/if}</h3></div>
            <div class="main">
                <div class="tab">
<!--                    <ul class="nav nav-tabs">
						<li><a href="#">新增产品</a></li>
						<li><a href="#">新增项目</a></li>
                    </ul>-->
                </div>
				<!--{if $mode == 'product'}-->
                <div class="show_content">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="control-group">
							<label class="control-label">产品编号</label>
							<div class="controls">
								<input type="text" name="no" value="<?=$product[no]?>">
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">产品名称</label>
							<div class="controls">
								<input type="text" name="name" value="<?=$product[name]?>">
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">上传产品图片</label>
							<div class="controls">
								<input type="file" name="pic">
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">产品描述</label>
							<div class="controls">
								<textarea rows="4" name="intro"><?=$product[intro]?></textarea>
							</div>
                        </div>
                        <div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">确定</button>
								<button class="btn btn-primary" type="reset">重置</button>
							</div>
                        </div>
					</form>

                </div>
				<!--{elseif $mode == 'project'}-->
                <div class="show_content">
                    <form class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="control-group">
							<label class="control-label">项目名称</label>
							<div class="controls">
								<input type="text" name="title" value="<?=$project[title]?>">
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">项目图片</label>
							<div class="controls">
								<input type="file" name="pic">
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">项目描述</label>
							<div class="controls">
								<textarea rows="4" name="summary"><?=$project[summary]?></textarea>
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">发布日期</label>
							<div class="controls">
								<input type="text" name="start_time" value="<?=$project[start_time]?>">
								截止日期
								<input type="text" name="end_time" value="<?=$project[end_time]?>">
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">悬赏金额</label>
							<div class="controls">
								<input type="text" name="money" value="<?=$project[money]?>">目前可使用悬赏金额是 90000 元
							</div>
                        </div>
                        <div class="control-group">
							<label class="control-label">关键词</label>
							<div class="controls">
								<input type="text">
							</div>
                        </div>
                        <div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">确定</button>
								<button class="btn btn-primary" type="reset">重置</button>
								<button class="btn btn-primary" type="submit" name="preview">预览</button>
							</div>
                        </div>
					</form>

                </div>
				<!--{/if}-->
            </div>
        </div>
    </div>
</div>
<?$this->view('footer')?>