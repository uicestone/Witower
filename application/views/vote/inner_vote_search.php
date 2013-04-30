<div class="main">
    <ul>
        <li>
            <b>热门标签</b>
            <a href="{url $cat-search-tag-0-money-$money-time-$time-user-$user-joinin-$joinin-order-$order}" <!--{if 0 == $tag}-->style="color:#004856;"<!--{/if}--> >不限</a>
            <!--{loop $hot_tags $key $data}-->
                    <a href="{url $cat-search-tag-$data['tag_id']-money-$money-time-$time-user-$user-joinin-$joinin-order-$order}" <!--{if $data['tag_id'] == $tag}-->style="color:#004856;"<!--{/if}--> ><?=$data['tag_name']?></a>				
            <!--{/loop}-->					
            <div class="search-bar">
                    <input type="text"><input type="button">
            </div>
        </li>
        <li>
            <b>金额</b>
            <a href="{url $cat-search-tag-$tag-money-0-time-$time-user-$user-joinin-$joinin-order-$order}" <!--{if 0 == $money}-->style="color:#004856;"<!--{/if}--> >不限</a>
            <!--{loop $money_list $key $data}-->
                    <a href="{url $cat-search-tag-$tag-money-$data['id']-time-$time-user-$user-joinin-$joinin-order-$order}" <!--{if $data['id'] == $money}-->style="color:#004856;"<!--{/if}--> ><?=$data['name']?>元</a>
            <!--{/loop}-->
        </li>
        <li>
            <b>时间</b>
            <a href="{url $cat-search-tag-$tag-money-$money-time-0-user-$user-joinin-$joinin-order-$order}" <!--{if 0 == $time}-->style="color:#004856;"<!--{/if}--> >不限</a>
            <!--{loop $time_list $key $data}-->
                    <a href="{url $cat-search-tag-$tag-money-$money-time-$data['id']-user-$user-joinin-$joinin-order-$order}" <!--{if $data['id'] == $time}-->style="color:#004856;"<!--{/if}--> ><?=$data['name']?></a>
            <!--{/loop}-->
        </li>
        <li>
            <b>参与人数</b>
            <a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-0-joinin-$joinin-order-$order}" <!--{if 0 == $user}-->style="color:#004856;"<!--{/if}--> >不限</a>
            <!--{loop $user_list $key $data}-->
                    <a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-$data['id']-joinin-$joinin-order-$order}" <!--{if $data['id'] == $user}-->style="color:#004856;"<!--{/if}--> ><?=$data['name']?>(<?=$data['value']?>)</a>
            <!--{/loop}-->
        </li>
        <li>
            <b>我的参与</b>
            <a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-$user-joinin-0-order-$order}" <!--{if 0 == $joinin}-->style="color:#004856;"<!--{/if}--> >不限</a>
            <!--{loop $joinin_list $key $data}-->
                    <a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-$user-joinin-$data['id']-order-$order}" <!--{if $data['id'] == $joinin}-->style="color:#004856;"<!--{/if}--> ><?=$data['name']?></a>
            <!--{/loop}-->
        </li>
    </ul>
</div>