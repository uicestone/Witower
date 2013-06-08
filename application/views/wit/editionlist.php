<?$this->view('header')?>

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

		</tr>
		</thead>
		<tbody>
		<!--{loop $editionlist $key $edition}-->
		<tr class="fields">
			<td><input name="eid[]" value="<?=$edition['eid']?>" type="checkbox" /><input name="editions_<?=$edition['eid']?>" value="{eval echo count($editionlist)-$key}" type="hidden" />
			<a href="{url edition-view-<?=$edition['eid']?>-{eval echo count($editionlist)-$key}}">{lang edition}{eval echo count($editionlist)-$key}</a></></td>
			<td class="gray"><?=$edition['time']?></td>
			<td><a href="{url user-space-$edition['authorid']}" ><?=$edition['author']?></a>
			<span title="{lang userstars} <?=$edition['stars']?>"><!--{for $i=0; $i<$edition['editorstar'][3]; $i++}--><img src="style/star_level3.gif"/><!--{/for}--><!--{for $i=0; $i<$edition['editorstar'][2]; $i++}--><img src="style/star_level2.gif"/><!--{/for}--><!--{for $i=0; $i<$edition['editorstar'][1]; $i++}--><img src="style/star_level1.gif"/><!--{/for}--></span>
			</td>
			<td><?=$edition['reason']?></td>
		</tr>
		<tr class="summary"><td colspan="4"><?=$edition['summary']?></td></tr>
		<!--{/loop}-->
		</tbody>
		<tfoot>
		<tr><td colspan="6"><input type="hidden" value="<?=$doc['did']?>" name="did"/></td></tr>
		</tfoot>
	</table>
</div>
<div class="operation_btn">	
	<input type="button" class="btn btn-primary" value="{lang compare}" class="btn_inp"/>
	<!--{if $checkable['remove']}--><!--<input type="button" value="{lang remove}" class="btn_inp"/>--><!--{/if}-->	
</div>
</form>
	</div>
</div>



<div class="c-b"></div>
<?$this->view('footer')?>

