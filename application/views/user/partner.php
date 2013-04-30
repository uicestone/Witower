<?$this->view('header')?>

<div id="content" class="page-partner">
{template index_left}
    <!--div class="info">
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
    <div class="list">
        <ul>
        <!--{loop $partnerlist $key $partner}-->
        <li><a href="index.php?user-space-<?=$partner[uid]?>"><img src="<?=$partner[image]?>"></a><span><?=$partner[co_name]?></span></li>
        <!--{/loop}-->

        <li><img src="style/default/pa_p1.jpg"><span>CAT工控机有限公司</span></li>
        <li><img src="style/default/pa_p2.jpg"><span>可口可乐</span></li>
        <li><img src="style/default/pa_p3.jpg"><span>马自达汽车</span></li>
        <li><img src="style/default/pa_p4.jpg"><span>AMP</span></li>
        <li><img src="style/default/pa_p5.jpg"><span>EA游戏有限公司</span></li>
        <li><img src="style/default/pa_p6.jpg"><span>宝洁公司</span></li>
        <li><img src="style/default/pa_p7.jpg"><span>港湾房产</span></li>
        <li><img src="style/default/pa_p8.jpg"><span>天猫商城</span></li>
        <li><img src="style/default/pa_p9.jpg"><span>腾讯游戏</span></li>
        <li><img src="style/default/pa_p10.jpg"><span>IMAGING</span></li>
        <li><img src="style/default/pa_p11.jpg"><span>燕京啤酒</span></li>
        <li><img src="style/default/pa_p12.jpg"><span>家乐福</span></li>
        <li><img src="style/default/pa_p13.jpg"><span>APPLE</span></li>
        <li><img src="style/default/pa_p14.jpg"><span>苏宁</span></li>
        <li><img src="style/default/pa_p15.jpg"><span>三星电子</span></li>
        <li><img src="style/default/pa_p16.jpg"><span>明基</span></li>
        <li><img src="style/default/pa_p17.jpg"><span>福记饺子</span></li>
        <li><img src="style/default/pa_p18.jpg"><span>满婷</span></li>
        </ul>
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

