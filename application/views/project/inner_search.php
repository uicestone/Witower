<div class="main">
    <ul>
        <li>
            <b>热门标签</b>
            <a href="{url $cat-search-tag-0-money-$money-time-$time-user-$user-order-$order}" <!--{if 0 == $tag}-->class="on"<!--{/if}--> >不限</a>
            <!--{loop $hot_tags $key $data}-->
                    <a href="{url $cat-search-tag-$data['tag_id']-money-$money-time-$time-user-$user-order-$order}" <!--{if $data['tag_id'] == $tag}-->class="on"<!--{/if}--> ><?=$data['tag_name']?></a>				
            <!--{/loop}-->
        </li>
        <li>
            <b>金额</b>
            <a href="{url $cat-search-tag-$tag-money-0-time-$time-user-$user-order-$order}" <!--{if 0 == $money}-->class="on"<!--{/if}--> >不限</a>
            <!--{loop $money_list $key $data}-->
                    <a href="{url $cat-search-tag-$tag-money-$data['id']-time-$time-user-$user-order-$order}" <!--{if $data['id'] == $money}-->class="on"<!--{/if}--> ><?=$data['name']?>元</a>
            <!--{/loop}-->
        </li>
        <li>
            <b>时间</b>
            <a href="{url $cat-search-tag-$tag-money-$money-time-0-user-$user-order-$order}" <!--{if 0 == $time}-->class="on"<!--{/if}--> >不限</a>
            <!--{loop $time_list $key $data}-->
                    <a href="{url $cat-search-tag-$tag-money-$money-time-$data['id']-user-$user-order-$order}" <!--{if $data['id'] == $time}-->class="on"<!--{/if}--> ><?=$data['name']?></a>
            <!--{/loop}-->
        </li>
        <li>
            <b>参与人数</b>
            <a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-0-order-$order}" <!--{if 0 == $user}-->class="on"<!--{/if}--> >不限</a>
            <!--{loop $user_list $key $data}-->
                    <a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-$data['id']-order-$order}" <!--{if $data['id'] == $user}-->class="on"<!--{/if}--> ><?=$data['name']?>(<?=$data['value']?>)</a>
            <!--{/loop}-->
        </li>           
    </ul>
</div>