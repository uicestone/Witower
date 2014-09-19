		</div>
	</div>
	<div id="footer">
		<div class="wrapper">
			<div class="service">
				<div class="title">
					<span><a href="/">主页</a></span>
				</div>
				<div class="main">
					<dl class="cat-<?//= $value[no] ?>">
						<dt><a href="index.php?help-content-<?//= $value[id] ?>"><?//= $value[title] ?></a></dt>
						<dd><a href="index.php?help-content-<?//= $s_value[id] ?>"><?//= $s_value[title] ?></a></dd>
					</dl>
				</div>
			</div>
			<ul>
				<li>
					<a class="f6" href="index.php?help-content-<?//= $value[id] ?>"></a>
					&#12288;|&#12288;<a class="f6" href="index.php?help-content-<?//= $value[id] ?>"></a>
				</li>
				<li>Copyright @2012 www.witower.com All Rights Reserved 智塔 版权所有 </li>
				<li><a href="http://www.miitbeian.gov.cn" target="_blank">沪ICP备12018783号-1</a></li>
			</ul>
		</div>
	</div>
</div>
</div>
</div>
<button id="back-to-top" class="btn btn-small hide" style="position: fixed; right: 10px; bottom: 10px;">回到顶部</button>
<script type="text/javascript" src="<?=site_url()?>js/summernote.min.js"></script>
<script type="text/javascript" src="<?=site_url()?>js/summernote-zh-CN.js"></script>
<script type="text/javascript" src="<?=site_url()?>js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?=site_url()?>js/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?=site_url()?>js/jquery.iframe-transport.js"></script>
<script type="text/javascript">
$(function(){
	$('.wysiwyg').summernote({
		lang: 'zh-CN',
		onImageUpload: function(files, editor, $editable) {
			$editable.parent('.note-editor').find('.note-image-input').fileupload({url: '/media/upload'})
				.fileupload('send', {files: files}).success(function(result){
					editor.insertImage($editable, result.url);
				});
		}
	});
});
</script>
</body>
</html>
