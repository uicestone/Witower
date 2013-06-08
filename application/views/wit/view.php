<?$this->view('header')?>
<div class="w-950 hd_map"> <a href="{WIKI_URL}"><?=$setting[site_name]?></a> &gt;&gt;{lang belongToCate} &gt;&gt;<span id="catenavi">
  <!--{loop $navigation $key $category}-->
  <a href="{url category-view-$category['cid']}">{eval echo htmlspecialchars($category[name])} </a>&nbsp;&nbsp;
  <!--{/loop}-->
  </span> </div>
<div class="l w-710 o-v">
  <h1 class="title_thema"> <span id='doctitle'><?=$doc['doctitle']?></span>
    <label id='auditmsg'>
      <!--{if $doc['visible']=='0'}-->
      --{lang viewDocTip4}
      <!--{/if}-->
    </label>
    <label id='lockimage'>
      <!--{if $doc['locked']}-->
      <image src="style/default/lock.gif"/>
      <!--{/if}-->
    </label>
  </h1>
  <div class="subordinate">
    <p class="cate_open"> <span class="bold">{lang tag}:</span>
      <!--{if count($doc['tag'] )>0}-->
      <!--{loop $doc['tag'] $key $tag}-->
      <a href="{url search-tag-$tag}" name="tag"><?=$tag?></a>
      <!--{/loop}-->
      <!--{else}-->
      <span name="nonetag">{lang noneTag}</span>
      <!--{/if}-->
      <!--{if $doc_edit}-->
      <span class="w-110">{lang editDddTag}</a></span>
      <!--{/if}-->
      <!--{if $doc_editletter}-->
      <span class="w-110" >{lang setdocFirstLetter}</a>
      <input type='hidden' id='fletter' value='$docletter'>
      </span>
      <!--{/if}-->
    </p>
    <span class="editteam"> <a href="javascript:void(0)" id="ding" >{lang ding}[<span><?=$doc['votes']?></span>]</a> <a class="share_link" id="share_link">{lang share}</a> <a href="{url comment-view-$doc['did']}">{lang publishComment}(<?=$doc[comments]?>)</a> <a id="editImage" href="{url doc-edit-$doc['did']}"  class="edit_ct" >{lang editDoc}</a>
    <label class="share_btn" id="share_btn" style="display:none">
      <input id="sitename" name="sitename" value="<?=$setting['site_name']?>" type="hidden">
      <input id="firstimg" name="firstimg" value="<?=$firstimg?>" type="hidden">
      
 <a href="javascript:void(0)" style="background:url(http://v.t.qq.com/share/images/s/weiboicon16.png) no-repeat left 0px;">腾讯微博</a><script type="text/javascript">
	function postToWb(){
		var _t = encodeURI("<?=$doc['qq_title']?>");
		var _url = encodeURIComponent(document.location);
		var _appkey = encodeURI("aa6cb794b12c41c29d6490f4624b77a9");//你从腾讯获得的appkey
		var _pic = encodeURI("<?=$doc['pic_str']?>");//（例如：var _pic='图片url1|图片url2|图片url3....）
		var _site = '';//你的网站地址
		var _u = 'http://v.t.qq.com/share/share.php?url='+_url+'&appkey='+_appkey+'&site='+_site+'&pic='+_pic+'&title='+_t;
		window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
	}
</script>

      
      
      
      <a href="#" class="kaixin001">{lang kaixin001}</a> <a href="#" class="renren">{lang renren}</a> <a href="#" class="sina_blog">{lang sina_blog}</a> </label>
    <script language="javascript"src='js/share.js'></script>
    </span> </div>
<div class="nav_model">
  <!--{if count($nav[1] )>0}-->
  <!--{loop $nav[1] $key $val}-->
  <?=$val['code']?>
  <!--{/loop}-->
  <!--{/if}-->
</div>
  <!--{if $editlock['locked']}-->
  <p id="lock" class="red bor-ccc lock_word">{lang viewDocTip5}<a href="{url user-space-$editlock['user']['uid']}">$editlock['user']['username']</a>{lang viewDocTip6}</p>
  <!--{/if}-->
  <!--{if $synonymdoc}-->
  <p class="red bor-ccc lock_word">"<?=$synonymdoc?>"{lang synonymis}"<?=$doc['doctitle']?>"{lang chineseDe}{lang synonym}</p>
  <!--{/if}-->
  <!--{if isset($advlist[3][1]) && isset($setting['advmode']) && '1'==$setting['advmode']}-->
  <div class="ad" id="advlist_3_1"> <?=$advlist[3][1][code]?> </div>
  <!--{elseif isset($advlist[3][1]) && (!isset($setting['advmode']) || !$setting['advmode'])}-->
  <div class="ad" id="advlist_3_1"> </div>
  <!--{/if}-->
  <div class="content_1 wordcut">
    <!--{loop $doc['sectionlist'] $key $section}-->
    <!--{if $section['flag'] == 1}-->
    <!--{if ($key==1)&&!empty($sectionlist)}-->
    <!--{if isset($advlist[3][2]) && isset($setting['advmode']) && '1'==$setting['advmode']}-->
    <div class="ad" > <span class="r" id="advlist_3_2"> <?=$advlist[3][2][code]?> </span> </div>
    <!--{elseif isset($advlist[3][2]) && (!isset($setting['advmode']) || !$setting['advmode'])}-->
    <div class="ad" > <span class="r" id="advlist_3_2"></span> </div>
    <!--{/if}-->
    <fieldset id="catalog">
      <legend><a name='section'>{lang catalog}</a></legend>
      <ul id="hidesection">
        <!--{loop $sectionlist $k $sec}-->
        <li 
        <!--{if $k>=4}-->
        style="display:none"
        <!--{/if}-->
        >&#8226; <a href="{url doc-view-$doc['did']}#<?=$sec['key']?>"><?=$sec['value']?></a>
        </li>
        <!--{/loop}-->
      </ul>
      <!--{if count($sectionlist) > 4}-->
      <p><a href="javascript:void(0);"   id="partsection" style="display:none">[{lang showPart}]</a><a href="javascript:void(0);"  id="fullsection">[{lang showAll}]</a></p>
      <!--{/if}-->
    </fieldset>
    <!--{/if}-->
    <h3><span class="texts"><?=$section['value']?></span><a name="<?=$key?>" href="{url doc-editsection-<?=$doc['did']?>-<?=$key?>}" >{lang editSection}</a><a href="{url doc-view-$doc['did']}#section">{lang backCatalog}</a></h3>
    <!--{else}-->
    <div class="content_topp"> <?=$section['value']?> </div>
    <!--{/if}-->
    <!--{/loop}-->
  </div>
  <div class="nav_model">
  <!--{if count($nav[2] )>0}-->
  <!--{loop $nav[2] $key $val}-->
  <?=$val['code']?>
  <!--{/loop}-->
  <!--{/if}-->
  </div>
  <!--{if count($referencelist)>0}-->
  <div>
    <dl class="reference" id="reference_view">
      <dt><!--{if $reference_add}--><a class="r h3"  href="javascript:reference_edit();">[{lang edit}]</a><!--{/if}-->{lang references}</dt>
      <!--{loop $referencelist $i $ref}-->
      <dd> <span>[{eval echo ($i+1)}].</span>&nbsp;&nbsp;<?=$ref['name']?> &nbsp;&nbsp;<span style="color:#666666"><?=$ref['url']?></span> </dd>
      <!--{/loop}-->
    </dl>
    

    <div id="reference" class="hd-box editor_left" style="display:none;" >
     <dl class="reference">
     <dt><!--<a class="r h3"  href="javascript:reference_view();">[完成]</a>{lang references}--></dt>
     </dl>
	<dl class="f8 reference" id="0" style="display:none;">
    <dd><span name="order">[0]</span>&nbsp;&nbsp;<span name='refrencename'></span> <span name="url" style="color:#666666"></span> <span name="edit" > <a href="javascript:;" >{lang edit}</a> 
			| <a name="remove" href="javascript:;" >{lang remove}</a></span> </dd>
	</dl>
	<!--{loop $referencelist $i $ref}-->
	<dl class="f8 reference" id="<?=$ref[id]?>">
		<dd><span name="order">[{eval echo ($i+1)}]</span>&nbsp;&nbsp;<span name='refrencename'><?=$ref[name]?></span> <span name="url" style="color:#666666"><?=$ref['url']?></span> <span name="edit" > <a href="javascript:;">{lang edit}</a> 
			| <a name="remove" href="javascript:;" >{lang remove}</a></span> </dd>
	</dl>
	<!--{/loop}-->
	
	<ul id="edit_reference" class="ul_l_s add_reference" style="display:none;">
		<li class="mar-bottom-10"><strong>{lang name}:</strong>
			<input id="editrefrencename" type="text" class="inp_txt" size="60"/>
			<label class="red" id="refrencenamespan"></label>
		</li>
		<li class="size black mar-bottom-10"><strong>{lang url}:</strong>
			<input id="editrefrenceurl" type="text" class="inp_txt" size="60"/>
			<label class="red" id="refrenceurlspan"></label>
		</li>
		
		<li name="verifycode" class="size black mar-bottom-10" style="display:none"><strong>{lang verifyCode}:</strong>
			<input name="code" id="editrefrencecode" type="text" class="inp_txt" size="10" maxlength="4"/>
			<label name="img" style="display:none"><img id="verifycode2" src="./js/hdeditor/skins/spacer.gif"/> <a href="javascript:docReference.updateVerifyCode();">{lang codeNotClear}</a></label>
			<label name="tip"></label>
			<label class="red" id="refrencecodespan"></label>
		</li>
		<li>
			<div id="edit_reference1" class="ul_l_s" style="display:none;">
				
					<input type="button" class="btn_inp" value="{lang save}" id="save_1"  name="save_1"  />
				<!--<input type="button"  class="btn_inp" value="{lang save}" name="save_0" id="save_0"  style="display:none" />
					<a id="save_1" href="javascript:void(0);" style="border:1px red solid;">{lang save}</a>
					<span id="save_0" style="display:none">{lang save}</span>
					<a href="javascript:;" >{lang reset}</a>-->
					<input type="button" class="btn_inp"  name="reset" value="{lang reset}" />
			
			</div>
		</li>
	</ul>
  </div>
</div>
<!--{/if}-->
<div class="fj_list m-t10"> <h3 
  <!--{if count($attachment)==0}-->
  style="display:none"
  <!--{/if}-->
  >{lang attachList}
  </h3>
  <dl style="display: none;">
    <dt><img class="fj_img"/><a></a><br/>
      <span class="l">
      <label> {lang attachDownloadNum}0</label>
      </span></dt>
    <dd></dd>
  </dl>
  <!--{if count($attachment)>0}-->
  <!--{if $attach_download}-->
  <!--{loop $attachment $attach}-->
  <dl id="$attach['id']">
    <dt><img class="fj_img" src="style/default/attachicons/<?=$attach['icon']?>.gif"/><a href="{url attachment-download-$attach['id']}" coin_down="<?=$attach['coindown']?>" attach_id = "<?=$attach['uid']?>" uid = "<?=$userid?>"  class="file_download"><?=$attach['filename']?></a><br/>
      <span class="l">
      <label class="mar-r8">({eval echo sprintf('%.2f',$attach['filesize']/1024)}k)</label>
      <label>{lang attachDownloadNum}<?=$attach['downloads']?></label>
      &nbsp;
      <label>{lang uploadCredit}<?=$attach['coindown']?></label>
      </span>
      <!--{if $attachment_remove && ($attach['uid']==$userid || $groupid==4) }-->
      [<a href="javascript:;" >{lang remove}</a>]
      <!--{/if}-->
    </dt>
    <dd><?=$attach['description']?></dd>
  </dl>
  <!--{/loop}-->
  <!--{else}-->
  <p class="m-lr8 m-t8">{lang attachRefuseTrip}</p>
  <!--{/if}-->
  <!--{/if}-->
  <!--{if $setting['attachment_open'] && $attachment_upload}-->
  <div>
    <form id="attachment_upload" action="{url attachment-upload}" enctype="multipart/form-data" 
			method="post" target="upload" style="display:none" onsubmit="return Attachment.submit(this)">
      <input type="hidden" name="MAX_FILE_SIZE" value="{eval echo $setting['attachment_size']*1024 }" />
      <div>
        <input name="attachment[]" type="file" onkeydown="return false" onpaste="return false" autocomplete="off" onchange="Attachment.add(this)">
        {lang attachmentPrice}
        <input name="coin_download[]" class="coin_download" type="text" value="0" size="2" onchange="check_coin($(this))" />
        (0-
        <!--<?=$coin_download?>-->
        {lang creditRange})
        {lang attachDesc}
        <input name="attachmentdesc[]" type="text" class="attachmentdesc" size="20" maxlength="50" autocomplete="off"/>
        <a href="javascript:;"  style="display:none">{lang remove}</a> </div>
      <br/>
      <input type="submit" value="{lang upload}" />
      <input type="hidden" value="<?=$doc['did']?>" name="did"/>
      <span>[{lang attachUpload}{lang attachSizeTrip} <?=$setting['attachment_size']?> KB]</span>
    </form>
    <a href="javascript:;" >{lang attachUpload}</a> <span id="attachment_error" style="color:red"></span> </div>
  <iframe name="upload" id="upload" style="display:none;" ></iframe>
  <!--{/if}-->
  <input type="hidden" name="coin_hidden" id="coin_hidden" value="<?=$coin?>"  />
</div>
<div class="bor_b-ccc m-t10 notes">
  <p class="l">→{lang viewDocTip7} <a class="font14" href="{url doc-edit-$doc['did']}">{lang editDoc}</a></p>
  <p class="r">
    <!--{if $neighbor['predoc']}-->
    {lang predoc}<a href="{url doc-view-$neighbor['predoc']['did']}"  class="m-lr8"><?=$neighbor['predoc']['title']?></a>
    <!--{/if}-->
    <!--{if $neighbor['nextdoc']}-->
    {lang nextdoc}<a href="{url doc-view-$neighbor['nextdoc']['did']}"  class="m-lr8"><?=$neighbor['nextdoc']['title']?></a>
    <!--{/if}-->
  </p>
</div>
<p class="useful_for_me"> <span>{lang viewDocTip9}</span> <a href="javascript:void(0)">
  <label id="votemsg">{lang viewDocTip10}</label>
  <b><?=$doc['votes']?></b></a> </p>
<div class="bor-ccc m-t10 bg-gray notes add">
  <p class="add_synonym">
    <label class="l w-550"><b>{lang synonym}</b>：
      <!--{if !empty($synonyms)}-->
      <span id="str">
      <!--{loop $synonyms $key $synonym}-->
      <a href="{url doc-innerlink-{eval echo urlencode($synonym['srctitle'])}}" name='synonym'><?=$synonym['srctitle']?></a>
      <!--{/loop}-->
      </span>
      <!--{else}-->
      <span name="nonesynonym">{lang noneSynonym}</span>
      <!--{/if}-->
    </label>
    <!--{if $synonym_audit}-->
    <span class="r w-110 cursor" ><img src="style/default/add_synonym.gif"/><a href="javascript:void(0)" >{lang editDddSyn}</a></span>
    <!--{/if}-->
  </p>
</div>
<div class="bor-ccc m-t10 notes bg-gray bookmark">
  <p><span class="bold">{lang favourite}: </span> <a title="Favorites" ><img src='style/default/bookmark/ie.gif' border='0' style="cursor:pointer;"></a> &nbsp;
    <script language="javascript"src='js/bookmark.js'></script>
    <!--{if !empty($userid)}-->
    <img id="doc_favorite" did="<?=$doc['did']?>" title="{lang keepToSpace}" alt="{lang keepToSpace}" src="style/default/bookmark/hudong.gif" style="cursor:pointer;">
    <!--{/if}-->
  </p>
  <!--{if isset($doclink)}-->
  <label class="m-t10 l" id="uniontitle"><?=$uniontitle?></label>
  <script type="text/javascript">
		$('#uniontitle').hide();
		$(document).ready(function(){
			$.get("index.php?hdapi-hduniontitle-"+<?=$doc['did']?>, function(data){
				if (data && data.indexOf('<html>')<0 && data.indexOf('href="null"')<0){
					$('#uniontitle').html(data).show();
					var a=$('#uniontitle').find("a[href*=innerlink]");
					if(a.size()){
						var href=a.attr("href");
						href = href.split("innerlink");
						a.attr("href", href[0]+"innerlink-"+encodeURI(a.text()));
					}
				}else{
					$('#uniontitle').hide();
				}
			});
		});
		</script>
  <!--{/if}-->
</div>
<!--{if $comment_add}-->
<!--{if isset($advlist[3][3]) && isset($setting['advmode']) && '1'==$setting['advmode']}-->
<br>
<div class="ad" id="advlist_3_3"> <?=$advlist[3][3][code]?> </div>
<!--{elseif isset($advlist[3][3]) && (!isset($setting['advmode']) || !$setting['advmode'])}-->
<div class="ad" id="advlist_3_3"></div>
<!--{/if}-->
<div class="columns comment">
  <h2 class="col-h2">{lang commentRelation}</h2>
  <a href="{url comment-view-$doc['did']}" target="_blank" class="more">{lang viewMore}&gt;&gt;</a>
  <form method="post" action="{url comment-add-$doc['did']}">
    <ul class="col-ul">
      <li>
        <textarea id="comment" name="comment" cols="95" rows="10" class="area"></textarea>
        <input id='anonymity' name="anonymity" type="checkbox" />
        {lang commentAnonymity}</li>
      <li class="yzm">
        <!--{if $setting['checkcode'] != "3"}-->
        <span>{lang verifyCode}: </span>
        <input name="code2" type="text" />
        <label class="m-lr8"><img id="verifycode" src="{url user-code}"  /></label>
        <a href="javascript:updateverifycode();">{lang changeAnother}</a>
        <!--{/if}-->
        &nbsp;&nbsp;&nbsp;&nbsp;{lang shouldNotice}:{lang commentLongSize}</li>
      <li>
        <input name="submit" type="submit" value="{lang publishComment}" class="btn_inp"/>
      </li>
    </ul>
  </form>
</div>
<!--{/if}-->
</div>
<div class="r w-230">
<div class="nav_model">
  <!--{if count($nav[3] )>0}-->
  <!--{loop $nav[3] $key $val}-->
  <?=$val['code']?>
  <!--{/loop}-->
  <!--{/if}-->
</div>
  <!--{if isset($advlist[4][1]) && isset($setting['advmode']) && '1'==$setting['advmode']}-->
  <div class="ad" id="advlist_4_1"> <?=$advlist[4][1][code]?> </div>
  <!--{elseif isset($advlist[4][1]) && (!isset($setting['advmode']) || !$setting['advmode'])}-->
  <div class="ad" id="advlist_4_1"> </div>
  <!--{/if}-->
  <!--{if $audit}-->
  <div class="columns ctgl">
    <h2 class="col-h2">{lang docManage}</h2>
    <form method="post">
      <dl>
        <dt>{lang operate}</dt>
        <dd class="a-c">
          <input name="Button2" type="button" value="{lang rename}" class="m-lr8 btn_inp"  />
          <input id="editcategory" name="Button3" type="button" value="{lang editCate}" class="m-lr8 btn_inp" />
        </dd>
        <dt>{lang state}</dt>
        <dd>
          <label class="l" ><a href='javascript:void(0);' >{lang lock}</a></label>
          <label class="r" ><a href='javascript:void(0);' >{lang unlock}</a></label>
        </dd>
        <dd>
          <label class="l" ><a href='javascript:void(0);' >{lang recommend}</a></label>
          <label class="r" ><a href='javascript:void(0);' > {lang CancelRecommend}</a></label>
        </dd>
        <dd>
          <label class="l" ><a href='javascript:void(0);' >{lang audit}</a></label>
          <label class="r" ><a href='index.php?doc-remove-<?=$doc['did']?>' >{lang remove}</a></label>
        </dd>
      </dl>
    </form>
  </div>
  <!--{/if}-->
  <div class="columns ctxx">
    <h2 class="col-h2">{lang docMessage}</h2>
    <!--{if $author}-->
    <!--{if !isset($lasteditor) || (isset($lasteditor) && $lasteditor['uid']!=$author['uid'])}-->
    <dl class="col-dl twhp2">
      <dd><a href="{url user-space-$author['uid']}" target="_blank"  class="a-img1"> <img alt="<?=$author['username']?>" title="<?=$author['username']?>" src="<!--{if $author[image]}-->$author[image]<!--{else}-->style/default/user_l.jpg<!--{/if}-->" width="38px" height="38px" /> </a></dd>
      <dt><a href="{url user-space-$author['uid']}" target="_blank"><?=$author['username']?></a></dt>
      <dd><span style="color:<?=$author['color']?>" class="l m-r8"><?=$author['grouptitle']?></span> <span title="{lang userstars} <?=$author['stars']?>" class="l">
        <!--{for $i=0; $i<$author['userstars'][3]; $i++}-->
        <img src="style/default/star_level3.gif"/>
        <!--{/for}-->
        <!--{for $i=0; $i<$author['userstars'][2]; $i++}-->
        <img src="style/default/star_level2.gif"/>
        <!--{/for}-->
        <!--{for $i=0; $i<$author['userstars'][1]; $i++}-->
        <img src="style/default/star_level1.gif"/>
        <!--{/for}-->
        </span> </dd>
      <dd>{lang creator} <a  href="javascript:void(0)">{lang sendmessage}</a> &nbsp;&nbsp;<img src="style/default/jb.gif" title="<?=$author['credit1']?>{lang gold}"></dd>
    </dl>
    <!--{/if}-->
    <!--{/if}-->
    <!--{if $author_removed}-->
    <dl class="col-dl twhp2">
      <dd><a class="a-img1"> <img alt="{lang haveDel}" src="style/default/user_l.jpg" width="38px" height="38px" /></a></dd>
      <dt>{lang userHaveDel}</dt>
      <dd>{lang creator}</dd>
    </dl>
    <!--{/if}-->
    <!--{if isset($lasteditor) }-->
    <dl class="col-dl twhp2">
      <dd><a href="{url user-space-$lasteditor['uid']}" target="_blank"  class="a-img1"> <img alt="<?=$lasteditor['username']?>" title="<?=$lasteditor['username']?>" src="<!--{if $lasteditor[image]}-->$lasteditor[image]<!--{else}-->style/default/user_l.jpg<!--{/if}-->" width="38px" height="38px" /> </a></dd>
      <dt><a href="{url user-space-$lasteditor['uid']}" target="_blank"><?=$lasteditor['username']?></a></dt>
      <dd><span class="l m-r8" style="color:<?=$lasteditor['color']?>" ><?=$lasteditor['grouptitle']?></span> <span title="{lang userstars} <?=$lasteditor['stars']?>" class="l">
        <!--{for $i=0; $i<$lasteditor['userstars'][3]; $i++}-->
        <img src="style/default/star_level3.gif"/>
        <!--{/for}-->
        <!--{for $i=0; $i<$lasteditor['userstars'][2]; $i++}-->
        <img src="style/default/star_level2.gif"/>
        <!--{/for}-->
        <!--{for $i=0; $i<$lasteditor['userstars'][1]; $i++}-->
        <img src="style/default/star_level1.gif"/>
        <!--{/for}-->
        </span> </dd>
      <dd>{lang recentEditor} <a href="javascript:void(0)">{lang sendmessage}</a> &nbsp;&nbsp;<img src="style/default/jb.gif" title="<?=$lasteditor['credit1']?>{lang gold}"></dd>
    </dl>
    <!--{/if}-->
    <!--{if $lasteditor_removed}-->
    <dl class="col-dl twhp2">
      <dd><a class="a-img1"> <img alt="{lang haveDel}" src="style/default/user_l.jpg" width="38px" height="38px" /></a></dd>
      <dt>{lang userHaveDel}</dt>
      <dd>{lang recentEditor}</dd>
    </dl>
    <!--{/if}-->
    <ul class="col-ul bor-ccc">
      <li>{lang viewTimes}: <?=$doc['views']?> {lang times}</li>
      <!--{if $doc['editions'] }-->
      <li>{lang editTimes}: <?=$doc['editions']?>{lang times} <a href="{url edition-list-$doc[did]}" target="_blank" class="m-l8">{lang edition}</a></li>
      <!--{/if}-->
      <li>{lang updateTime}: <?=$doc['lastedit']?></li>
    </ul>
  </div>
  <div class="columns">
    <h2 class="col-h2">{lang docRelation}</h2>
    <!--{if $relate}-->
    <a href="javascript:void(0)" class="more">{lang add}</a>
    <!--{/if}-->
    <ul class="col-ul" id='related_doc' 
    <!--{if empty($relatelist)}-->
    style="display:none"
    <!--{/if}-->
    >
    <!--{loop $relatelist $key $relate}-->
    <li><a href="index.php?doc-innerlink-{eval echo urlencode($relate)}" target="_blank" title="<?=$relate?>"><?=$relate?></a></li>
    <!--{/loop}-->
    </ul>
  </div>
  <div id="block_right">{block:right/}</div>
  <!--{if isset($advlist[4][2]) && isset($setting['advmode']) && '1'==$setting['advmode']}-->
  <div class="ad" id="advlist_4_2"> <?=$advlist[4][2][code]?> </div>
  <!--{elseif isset($advlist[4][2]) && (!isset($setting['advmode']) || !$setting['advmode'])}-->
  <div class="ad" id="advlist_4_2"> </div>
  <!--{/if}-->
</div>
<div class="nav_model">
<!--{if count($nav[4] )>0}-->
<!--{loop $nav[4] $key $val}-->
<?=$val['code']?>
<!--{/loop}-->
<!--{/if}-->
</div>
<!--{if $setting['checkcode'] != "3"}-->

<script type="text/javascript" src="js/openremoveimage.js"></script>

<?$this->view('footer')?>