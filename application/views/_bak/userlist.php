<?$this->view('header')?>

<div id="content" class="page-master">
{template index_left}
    <!--div class="info">
        <div class="fn-left">
            <ul>
                <li><a href="#">奖金达人</a></li>
                <li><a href="#">人气达人</a></li>
                <li><a href="#">话题达人</a></li>
            </ul>
        </div>
        <div class="fn-right">
            交易数量：<span>1,534</span>个    交易金额：<span>1,657,353</span>元    新增用户：<span>5,772</span>人
            <div class="search-bar">
                <ul>
                    <li><input type="text"></li>
                    <li class="category">
                        列别1
                        <ul>
                            <li>列别1</li>
                            <li>列别1</li>
                            <li>列别1</li>
                            <li>列别1</li>
                        </ul>
                    </li>
                    <li>
                        <input type="button" value="搜索">
                    </li>
                </ul>
            </div>
        </div>
    </div-->
    <div class="daren">
        <!--{loop $userlist $key $master}-->
        <div class="model-c">
            <div class="fn-left"><a href="index.php?user-space-<?=$master[uid]?>"><img src="<?=$master[image]?>"></a></div>
            <div class="fn-right">
                <a href="index.php?user-space-<?=$master[uid]?>"><b><?=$master[username]?></b></a>
                <ul>
                    <li><span>奖金：</span><?=$master[credit1]?> 元</li>
                    <li><span>人气：</span><?=$master[views]?></li>
                    <li><span>话题：</span><?=$master[creates]?></li>
                </ul>
                <p>IT产业不断发展中，逐渐摸索出自己的产业发展规律的前进步伐</p>
                <!--{if $master[follow]}-->             
                    <span class="btn-b add_attention">已关注</span>
                <!--{else}-->
                    <a class="btn-b add_attention" uid="<?=$master[uid]?>">+关注</a>
                <!--{/if}-->
            </div>
        </div>
        <!--{/loop}-->


    </div>
	
	<!--{if !$user[uid]}-->
    <div class="login">
        <p>
            想看更多？请<a href="{url user-register}">注册</a>或<a href="{url user-login}">登录</a>
        </p>
    </div>
	<!--{/if}-->

</div>

<?$this->view('footer')?>

