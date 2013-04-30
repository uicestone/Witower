    <div class="model recommend">
        <div class="title"><h3>每日推荐</h3></div>
        <div class="main">
            <div class="info">
                <a href="/project/view/<?=$recommend_project['p_id']?>"><img src="<?=$recommend_project[image_path]?><?=$recommend_project[image_name]?>"><!--<img src="style/default/pro_p1.jpg">--></a>
                <ul>
                    <li><b>发布企业：</b><?=$recommend_project['co_name']?>
                        <!--{if $recommend_project[follow]}-->
                            <span class="add_attention">已关注</span>
                        <!--{else}-->
                            <a href="javascript:void(0);" class="add_attention" uid="<?=$recommend_project['uid']?>">加关注</a>
                        <!--{/if}-->
                    </li>
                    <li><b>项目名称：</b><a href="/project/view/<?=$recommend_project['p_id']?>"><?=$recommend_project['title']?></a></li>
                    <li><b>项目介绍：</b><?=$recommend_project['summary']?></li>
                    <li><b>项目金额：</b><?=$recommend_project['money']?>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>截止日期：</b><?=$recommend_project['vote_end_time']?></li>
                    <li>标签：
                        <span class="tags">
                            <!--{loop $recommend_project['tag_list'] $key $data}-->
                                    <a href="/list/search/tag/$data['tag_id']}"><?=$data['tag_name']?></a>
                            <!--{/loop}-->
                        </span>
                        <a class="btn-c" href="/project/view/<?=$recommend_project['p_id']?>">我要参与</a>
					</li>
                </ul>
                
            </div>
            <div class="scroll-img">
                <div class="fn-left"><p>他们正在讨论</p></div>
                <div class="fn-right">
                    <ul id="mycarousel" class="jcarousel-skin-tango">
						<!--{loop $recommend_project_persons $key $data}-->
							<li><a href="/user/space/<?=$data['uid']?>"><img src="style/default/1.jpg"><span><?=$data['people_name']?></span></a></li>
						<!--{/loop}-->
                    </ul>
                </div>
            </div>
        </div>
    </div>