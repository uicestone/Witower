<?$this->view('header')?>
<script type="text/javascript">
function compare(){
	var docs;
	try{
		document.documentElement.scrollTop=0;
		if($("input[name='eid[]']").length==null){
			alert("{lang editionTip1}");
		}else{
			switch($("input:checked").length){
				case 0:
				alert("{lang editionTip2}");
				break;
				case 1:
				alert("{lang editionTip3}");
				break;
				case 2:
				$("form[name='editionform']").attr('target',"_blank");
				$("form[name='editionform']").attr('action',"index.php?edition-compare");
				$("form[name='editionform']").submit();
				break;
				default:
				alert("{lang editionTip4}");
				break;
			}
		}
	}catch(e){
		alert("{lang editionTip2}");
	}
}
function removedoc(){
	if($("input[name='eid[]']").length==null){
		alert("{lang editionTip1}");
	}else{
		if($("input:checked").length<1){
			alert("{lang editionTip5}");
			return false;
		}
	}
	if(confirm("{lang editionTip6}")==false){
		return false;
	}else{
		$("form[name='editionform']").attr('target',"_self");
		$("form[name='editionform']").attr('action',"index.php?edition-remove");
		$("form[name='editionform']").submit();
	}
}

function excellence(){
	if($("input[name='eid[]']").length==null){
		alert("{lang editionTip1}");
	}else{
		if($("input:checked").length<1){
			alert("{lang editionTip7}");
			return false;
		}
	}
	if(confirm("{lang editionTip8}")==false){
		return false;
	}else{
		$("form[name='editionform']").attr('target',"_self");
		$("form[name='editionform']").attr('action',"index.php?edition-excellent");
		$("form[name='editionform']").submit();
	}
}

function copy(){
	if($("input[name='eid[]']").length==null){
		alert("{lang editionTip1}");
	}else{
		if($("input:checked").length!=1){
			alert("{lang editionTip9}");
			return false;
		}
	}
	if(confirm("{lang editionTip10}")==false){
		return false;
	}else{
		$("form[name='editionform']").attr('target',"_self");
		$("form[name='editionform']").attr('action',"index.php?edition-copy");
		$("form[name='editionform']").submit();
	}	
}

</script>
<div class="version">
	<div class="model">
		<div class="title"><h3>版本</h3></div>
	<form method="post" name="editionform">
		<div class="main">
	<table cellspacing="0" cellpadding="0" class="table w-950 l">
		<thead>
		<tr>
			<td style="width: 150px;">{lang edition}</td>
			<td style="width: 100px;">{lang createTime}</td>
			<td style="width: 140px;">{lang editionCreator}</td>
			<td style="width: 220px;">{lang reason}</td>
			<td style="width:100px;">分数</td>

		</tr>
		</thead>
		<tbody>
		<!--{loop $editionlist $key $edition}-->
		<tr class="fields">
			<td><input name="eid[]" value="<?=$edition['eid']?>" type="checkbox" /><input name="editions_<?=$edition['eid']?>" value="{eval echo count($editionlist)-$key}" type="hidden" />
			<a href="{url edition-view-<?=$edition['eid']?>-{eval echo count($editionlist)-$key}}">{lang edition}{eval echo count($editionlist)-$key}</a></></td>
			<td class="gray"><?=$edition['time']?></td>
			<td><a href="{url user-space-$edition['authorid']}" ><?=$edition['author']?></a>
			<span title="{lang userstars} <?=$edition['stars']?>"><!--{for $i=0; $i<$edition['editorstar'][3]; $i++}--><img src="style/default/star_level3.gif"/><!--{/for}--><!--{for $i=0; $i<$edition['editorstar'][2]; $i++}--><img src="style/default/star_level2.gif"/><!--{/for}--><!--{for $i=0; $i<$edition['editorstar'][1]; $i++}--><img src="style/default/star_level1.gif"/><!--{/for}--></span>
			</td>
			<td><?=$edition['reason']?></td>
			<td><input type="text" name="score[<?=$edition['eid']?>]" /></td>
		</tr>
		<tr class="summary"><td colspan="5"><?=$edition['summary']?></td></tr>
		<!--{/loop}-->
		</tbody>
		<tfoot>
		<tr><td colspan="5"><input type="hidden" value="<?=$doc['did']?>" name="did"/></td></tr>
		</tfoot>
	</table>
</div>
<div class="operation_btn">	
	<input type="button" class="btn" onclick="compare();" value="{lang compare}" class="btn_inp"/>
	<input type="submit" class="btn btn-primary" name="save_score" value="保存分数" />
	<!--{if $checkable['remove']}--><!--<input type="button" onclick="removedoc();" value="{lang remove}" class="btn_inp"/>--><!--{/if}-->	
</div>
</form>
	</div>
</div>

<div class="c-b"></div>
<?$this->view('footer')?>

