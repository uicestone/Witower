<?$this->view('header')?>
<div id="content" class="page-list page-list-cat">
    <div class="breadcrumb">
        
    </div>
    
    <div class="search">
        <div class="title">
            <b class="s14">项目统计</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;进行的项目：<b class="s18"><?=$project_count?></b> 个              &nbsp;&nbsp;&nbsp;参与的人数：<b class="s18"><?=$user_count?></b>人
        </div>
        
        {template inner_search}
        
    </div>

    <div class="model">
        <div class="title">
			<h3>
				<!--{if $type=='hot'}-->人气项目
				<!--{elseif $type=='money'}-->项目金额
				<!--{elseif $type=='starttime'}-->最新项目
				<!--{else}-->
				项目列表
				<!--{/if}-->		
			</h3>
			<ul>
                <li <!--{if 0 == $order}-->class="on"<!--{/if}-->><a href="{url list}">默认</a></li>
                <!--{loop $order_list $key $data}-->
                <li <!--{if $data['id'] == $order}-->class="on"<!--{/if}--> ><a href="{url $cat-search-tag-0-money-$money-time-$time-user-$user-order-$data['id']}" ><?=$data['name']?></a></li>
                <!--{/loop}-->
			</ul>

		</div>
        <div class="main">


			<!--{loop $list $key $data}-->
            <div class="model-a">
                <div class="main">
                    <a href="{url project-view-<?=$data['p_id']?>}"><img src="style/3.jpg"></a>
                    <ul>
                        <li><b>项目名称：</b><?=$data['title']?></li>
                        <li><b>项目介绍：</b><?=$data['summary']?></li>
                        <li><b>发布企业：</b><?=$data['co_name']?></li>
                        <li><b>项目金额：</b><?=$data['money']?></li>
                        <li><b>项目时间：</b><?=$data['start_time']?> 至 <?=$data['end_time']?></li>
                        <li class="tags">
							<b>标签：</b>
							<!--{loop $data['tag_list'] $key_tag $data_tag}-->
								<a href="{url list-search-tag-$data_tag['tag_id']}"><?=$data_tag['tag_name']?></a>
							<!--{/loop}-->
						</li>
                    </ul>
                </div>
                <div class="tail icons">
                    <ul>
                        <li class="cat-1"><a href="{url project-view-<?=$data['p_id']?>}">(<?=$data['join_num']?>)</a></li>
                        <li class="cat-2"><a href="{url project-view-<?=$data['p_id']?>}">(<?=$data['comment_num']?>)</a></li>
                        <li class="cat-3"><a href="{url project-view-<?=$data['p_id']?>}">(<?=$data['favorite_num']?>)</a></li>
                    </ul>
                </div>
            </div>
			<!--{/loop}-->
			

        </div>
    </div>
</div>
<?$this->view('footer')?>