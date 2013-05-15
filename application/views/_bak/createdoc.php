<?$this->view('header')?>
<div id="content" class="page-createdoc">
<script type="text/javascript" src="js/popWindow.js"></script>
<script type="text/javascript">
	function verifydoc(){
		title=$.trim($('#title').val());
		if(title==""){
			$('#response').html('<label style="color:#FF0000">{lang createDocTip1}</label>');
		}else if(title.length>80){
			$('#response').html('<label style="color:#FF0000">{lang createDocTip2}</label>');
		}else{
			$.ajax({
				url: "index.php?doc-verify",
				cache: false,
				dataType: "xml",
				type:"post",
				//async:false, 
				data: {title:title},
				success: function(xml){
				   var message=xml.lastChild.firstChild.nodeValue;
					if(message=='1'){
						$('#response').html('<label>{lang doc} "'+title+'" {lang createDocTip3}</label>');
					}else if(message=='-1'){
						$('#response').html('<label style="color:#FF0000">{lang doc} "'+title+'" {lang createDocTip4}</label>');
					}else if(message=='-2'){
						$('#response').html('<label style="color:#FF0000">{lang doc} {lang createDocTip15}</label>');
					}else if(message.length>'3'){
						var message=$.trim(message).split(/ +/);
						$('#response').html('<label style="color:#FF0000">{lang doc}"'+title+'"{lang synonymis}<a href="<?=$setting["seo_prefix"]?>doc-view-'+message[0]+'">"'+message[1]+'"</a>{lang synonymTitle}</label>');
					}else{
						$('#response').html('<label style="color:#FF0000">{lang doc} "'+title+'" {lang createDocTip5}</label>');
					}
				}
			});
		}
	}

	function docheck(){
		title=$.trim($('#title').val());
		if(title==""){
			$('#response').html('<label style="color:#FF0000">{lang createDocTip1}</label>');
			return false;
		}
		return true;
	}
	var catevalue = {
		input:null,
		scids:new Array(),
		scnames:new Array(),
		ajax:function(cateid, E){
			if(!cateid)cateid=0
			$.ajax({
				url: 'index.php?category-ajax-'+cateid,
				cache: false,
				dataType: "xml",
				type:"get",
				success: function(xml){
					var message=xml.lastChild.firstChild.nodeValue;
					if($('#dialog_category:visible').size()){
						$.dialog.content('category', '<div id="flsx" class="chose_cate">'+message+'</div>');
						catevalue.selectCategory();
					}else{
						$.dialog({
							id:'category',
							title:'{lang docCategory}',
							content: '<div id="flsx" class="chose_cate">'+message+'</div>',
							height:450,
							width:680,
							position:'c',
							resizable:0,
							resetTime:0,
							onOk:function(){
								$.dialog.close('category');
								catevalue.ok();
							},
							callback:function(){
								catevalue.selectCategory();
							},
							styleContent:{'text-align':'left', 'overflow-y':'scroll', 'padding-right':'0', height:'380px'},
							styleOk:{'font-size':'14px','line-height':'20px', 'padding':'2px 6px 1px','margin-right':'3px'}
						});
					}
				}
			});
		},
		
		cateOk:function(id,title,handle){
			var point;
			if(handle){
				this.scids.push(id);
				this.scnames.push(title);				
			}else{
				for(i=0;i<this.scids.length;i++){
					if(this.scids[i]==id){
						point=i;
					}
				}
				this.scids.splice(point,1);
				this.scnames.splice(point,1);
			}
			catevalue.pushCategory()
		},
		
		pushCategory:function(){
			$('#category').val(this.scids.toString());
			$('#scnames').text(this.scnames.toString());
			$('#columntitle').html(catevalue.getCatUrl());
		},
		
		getCatUrl:function(){
			var catstring='';
			for(i=0;i<this.scids.length;i++){
				catstring=catstring+'<a target="_blank" href="<?=$setting['seo_prefix']?>category-view-'+this.scids[i]+'">'+this.scnames[i]+'</a>,';
			}
			catstring=catstring.substring(0, catstring.length-1);
			return catstring;
		},
		
		selectCategory:function(){
			var cb=$(":checkbox");
			catevalue.pushCategory();
			for(i=0;i<cb.length;i++){
				if(catevalue.inArray(cb[i].id, this.scids)){
					cb[i].checked = true; 
				}
			}		
		},
		
		inArray:function(stringToSearch, arrayToSearch) {
			for (s = 0; s <arrayToSearch.length; s++) {
				if (stringToSearch == arrayToSearch[s]) {			 
					 return true;
				}
			}
			return false;
		},
		
		removeCateTree:function(){
			$('#flsx').hide();
		},
		
		ok:function(){
			$('#flsx').hide();
		},		
		
		init:function(){
			if('<?=$category[cid]?>'!=''){
				this.scids.push(<?=$category[cid]?>);
				this.scnames.push('<?=$category[name]?>');
			}
		}
	}
	function openclose(obj){
		var patrn=/close.gif$/;
		var s=obj.src;
		var id=obj.id;
		if(patrn.test(s)){
			obj.src='style/default/open.gif';
			var t=$('#'+id).find("dd");
			t.show();
		}else{
			obj.src='style/default/close.gif';
			var t=$('#'+id).find("dd");
			t.hide();
		}
	}
	catevalue.init();
</script>
<form id="form1" name="form1" action="{url doc-create2}" method="post" onsubmit="return docheck();">
<div id="map" class="hd_map bor_no"><a href="{WIKI_URL}"><?=$setting[site_name]?></a> &gt;&gt; {lang createDoc}</div>
<div class="l w-710">
  <div class="p-10 columns cre_main">
    <h2 class="col-p">{lang createDoc}</h2>
      <ul class="ul_l_s" >
        <li><span>{lang docTitle}:</span>
            <input id ="p_id" name="p_id" type="hidden" value="<?=$p_id?>" />
            <input id="title" name="title" value="<!--{if isset($title)}--><?=$title?><!--{/if}-->" type="text" class="reg-inp" onblur="verifydoc();" maxlength="80"/>
            <label id="response"></label><input type="hidden" id="category" name="category" value="<?=$category[cid]?>" />
        </li>
        <li>
		  <input name="hdwiki" type='text' style="display:none">
          <input name="create_submit" type="submit" value="{lang createDoc}" class="btn_inp"/>
        </li>
      </ul>
  </div>
  <div id="block_left">{block:left/}</div>
</div>
</form>
</div>
<?$this->view('footer')?>