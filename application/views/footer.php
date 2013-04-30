<div id="footer">
    <div class="service">
        <div class="title">
            <span><a href="/index.php">主页</a></span>
        </div>
        <div class="main">
            <!--{loop $article_footer_list $key $value}-->
            <dl class="cat-<?=$value[no]?>">
                <dt><a href="index.php?help-content-<?=$value[id]?>"><?=$value[title]?></a></dt>
                <!--{loop $value[son_list] $s_key $s_value}-->
                <dd><a href="index.php?help-content-<?=$s_value[id]?>"><?=$s_value[title]?></a></dd>
                <!--{/loop}-->
            </dl>
            <!--{/loop}-->
        </div>
    </div>
    <ul>
        <li>
        <!--{loop $article_bottom_list $key $value}-->
        <!--{if $key==0}-->
        <a class="f6" href="index.php?help-content-<?=$value[id]?>">$value[title]</a>
        <!--{else}-->
        &#12288;|&#12288;<a class="f6" href="index.php?help-content-<?=$value[id]?>">$value[title]</a>
        <!--{/if}-->
        <!--{/loop}-->
        </li>
        <li>Copyright @2012 www.witower.com All Rights Reserved 智塔 版权所有 </li>
        <li><a href="http://www.miitbeian.gov.cn" target="_blank">沪ICP备12018783号-1</a></li>
    </ul>
    <div id="goToTop">
        <a href="#">回顶部↑</a>
    </div>
</div>
</div>
</div>
</body>
</html>