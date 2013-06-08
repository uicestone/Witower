<?$this->view('header')?>
<div id="contentEditor">
<link  rel="stylesheet" type="text/css" href="style/default/editor.css" media="all" />
<link href="js/jqeditor/skins/skin_base.css" rel="stylesheet" type="text/css" media="all" />
<style>
#tags input{width:50%;margin-bottom:2px;}
#tags ,#doc_verification_code{padding-bottom:10px;}
#tags div ,#doc_verification_code div{text-align:left;padding-left:10px;width:95%;}
</style>

<form name="edit_doc" id="hdwiki_editor" class="jqeditor" method="post" enctype="multipart/form-data" action="<!--{if $page_action == 'create'}-->{url doc-create}<!--{elseif $page_action == 'edit'}-->{url doc-edit}<!--{else}-->{url doc-editsection}<!--{/if}-->" name='editor' onsubmit="return check();">
	<input type="hidden" name='p_id' id='p_id' value="<?=$p_id?>" />
    <input type="hidden" name='did' id='did' value="<?=$doc['did']?>" />
	<input type="hidden" name='section_id' value="<?=$doc['section_id']?>" />
	<input type="hidden" name='create_submit' value="1" />
	<input type="hidden" name='title' id='title' value="<?=$doc['title']?>" />
	<input type="hidden" name="category" value="<?=$doc['cid']?>"/>

<div class="instrument">
	<div style="height:32px;margin:2px 0;">
		<div class="jqe-toolbar"></div>
	</div>
</div>
<div id="editoring" class="hd-box editor_left size">
<strong>{lang editoring}</strong><a href="{url doc-view-$doc['did']}" target="_blank"><?=$doc['title']?></a>
</div>
<div id="text" class="hd-box editor_left">
	<h2>{lang editTip5}</h2>
	<textarea id="content" name="content" style="width:98%;height:400px;visibility:hidden;display:none;">
	<?=$doc['content']?>
	</textarea>
	<div class="jqe-content"></div>
</div>

<div id="summary" class="hd-box editor_left">
	<h2>{lang summary}</h2>
	<div>
		<textarea rows="3" class="size" name='summary'><?=$doc['summary']?></textarea>
	</div>
</div>
<div id="tags" class="hd-box editor_left">
	<h2>{lang tag}</h2>
	<div>
	<input type="text" class="inp_txt" name='tags' value="<?=$doc['tag']?>" /> <br /><span class="gray">[{lang editorTip8}]</span>
	</div>
</div>
<!--{if $setting[base_isreferences] !== '0' }-->
<div id="reference" class="hd-box editor_left">
	<h2>{lang references}</h2>
	<dl class="f8" id="0" style="display:none;">
		<dt><strong name="order">[0]</strong><span></span></dt>
		<dd name="url"></dd>
		<dd name="edit">
			<a href="javascript:;" >{lang edit}</a> 
			| <a name="remove" href="javascript:;" >{lang remove}</a>
		</dd>
	</dl>
	<!--{loop $referencelist $i $ref}-->
	<dl class="f8" id="<?=$ref[id]?>">
		<dt><strong name="order">[{eval echo ($i+1)}]</strong><span><?=$ref[name]?></span></dt>
		<dd name="url"><?=$ref[url]?></dd>
		<dd name="edit">
			<a href="javascript:;" >{lang edit}</a> 
			| <a name="remove" href="javascript:;" >{lang remove}</a>
		</dd>
	</dl>
	<!--{/loop}-->
	
	<dl id="edit_reference" style="display:none">
		<dt class="mar-bottom-10"><strong>{lang name}:</strong>
			<input id="editrefrencename" type="text" class="inp_txt" size="60"/>
			<span class="red" id="refrencenamespan"></span>
		</dt>
		<dd class="size black mar-bottom-10"><strong>{lang url}:</strong>
			<input id="editrefrenceurl" type="text" class="inp_txt" size="60"/>
			<span class="red" id="refrenceurlspan"></span>
		</dd>
		
		<dd name="verifycode" class="size black mar-bottom-10" style="display:none"><strong>{lang verifyCode}:</strong>
			<input name="code" id="editrefrencecode" type="text" class="inp_txt" size="10" maxlength="4"/>
			<span name="img" style="display:none"><img id="verifycode2" src="./js/hdeditor/skins/spacer.gif"/> <a href="javascript:docReference.updateVerifyCode();">{lang codeNotClear}</a></span>
			<span name="tip"></span>
			<span class="red" id="refrencecodespan"></span>
		</dd>
		
		<dd>
			<a id="save_1" href="javascript:;" >{lang save}</a>
			<span id="save_0" style="display:none">{lang save}</span>
			<a href="javascript:;" >{lang reset}</a>
		</dd>
	</dl>
</div>
<!--{/if}-->
<!--{if $page_action != 'create'}-->
<div id="reason" class="hd-box editor_left">
	<h2>{lang reason}<span class="red">[{lang mustBeCompleted}]</span></h2>
	<div>
	<label><input type="checkbox" value="{lang editTip44}" name="editreason[]"/>{lang editTip44}</label>
	<label><input type="checkbox" value="{lang editTip45}" name="editreason[]"/>{lang editTip45}</label>
	<label><input type="checkbox" value="{lang editTip46}" name="editreason[]"/>{lang editTip46}</label>
	<label><input type="checkbox" value="{lang editTip47}" name="editreason[]"/>{lang editTip47}</label>
	<label><input type="checkbox" value="{lang editTip48}" name="editreason[]"/>{lang editTip48}</label>
	<label><input type="checkbox" value="{lang editTip49}" name="editreason[]"/>{lang editTip49}</label>
	<label><input type="checkbox" value="{lang editTip50}" name="editreason[]"/>{lang editTip50}</label>
	<br /><br />{lang editTip51}<br />
	<textarea rows="2" name="editreason[]" id="editreason" class="inp_txt"></textarea>
	</div>
</div>
<!--{/if}-->

<!--{if ($doc_verification_edit_code && ($page_action == 'edit'||$page_action == 'editsection' )) || ($doc_verification_create_code && $page_action == 'create')}-->
<div id="doc_verification_code" class="hd-box editor_left">
	<h2>{lang verifyCode}<span class="red">[{lang mustBeCompleted}]</span></h2>
	<div>
	<input name="code" type="text" class="inp_txt" size="10" maxlength="4"/>
	<span name="img" style="display:none"><img id="verifycode" src="./js/hdeditor/skins/spacer.gif"/> <a href="javascript:updateverifycode();">{lang codeNotClear}</a></span>
	<span name="tip"></span>
	</div>
</div>
<!--{/if}-->

<div class="pushbutton">
	<input name="publishsubmit" class="conserve" type="submit" value="{lang publish}" />
	<input type="button" value="{lang logout}" />
</div>
</form>

<div id="editor_right" class="hd-box">

<ul>
		<li class="my">
	<img src="style/default/us_pic.jpg">
	<a href="#">
	一灯大师
	</a>
	</li>
<!--{if $page_action != 'editsection'}-->
<li><input name="autosave" type="checkbox" id="autosave" onclick="isAutoSave()" checked="checked"/>{lang auto}{lang save}</li>
<!--{/if}-->
<li id='AutoSaveStatus'></li>
<li id="editor_tip"></li>
<li class="help"><a href="http://service.hudong.com/ct_02.html" target="_blank">{lang editorTip0}</a></li>
<li id="editor_tip"></li>
</ul>
<div class="participator">
	<h3>谁编辑过：</h3>
                <ul>
                     <li><img src="style/default/8.jpg"><a href="#"><span>真的疯了</span></a></li>
                     <li><img src="style/default/8.jpg"><a href="#"><span>真的疯了</span></a></li>
                     <li><img src="style/default/8.jpg"><a href="#"><span>真的疯了</span></a></li>
                     <li><img src="style/default/8.jpg"><a href="#"><span>真的疯了</span></a></li>
                     <li><img src="style/default/8.jpg"><a href="#"><span>真的疯了</span></a></li>
                </ul>
            </div>
</div>

<div style="display:none">
<form method="post" id="previewdocform" target="_blank" action="index.php?doc-edit-$doc['did']">
<textarea name="content"></textarea>
<input name="predoctitle" type="hidden" value="<?=$doc['title']?>"/>
</form>
</div>
<style>
.jqe-plugin-HdImage .uploadBoxTop span.last_span {display:none;}
</style>

</div>

<?$this->view('footer')?>
