			</div><!--.row-fluid-->
		</div><!--#content.wrapper-->
		<div id="footer">
			<div class="foot">
				<ul>
					<li><h2>智塔</h2><a href="#">了解智塔</a><a href="#">加入智塔</a><a href="#">友情链接</a><a href="#">联系我们</a></li>
					<li><h2>智塔</h2><a href="#">了解智塔</a><a href="#">加入智塔</a><a href="#">友情链接</a><a href="#">联系我们</a></li>
					<li><h2>智塔</h2><a href="#">了解智塔</a><a href="#">加入智塔</a><a href="#">友情链接</a><a href="#">联系我们</a></li>
					<li><h2>智塔</h2><a href="#">了解智塔</a><a href="#">加入智塔</a><a href="#">友情链接</a><a href="#">联系我们</a></li>

				</ul>
			</div>
			<div class="foot_b">Copyright @2012-2014 www.witower.com All Rights Reserved 智塔 版权所有沪ICP备12018783号-1</div>
		</div>
		<button id="back-to-top" class="btn btn-small hide" style="position: fixed; right: 10px; bottom: 10px;">回到顶部</button>
		<script type="text/javascript" src="<?= site_url() ?>js/summernote.min.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/summernote-zh-CN.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/jquery.fileupload.js"></script>
		<script type="text/javascript" src="<?= site_url() ?>js/jquery.iframe-transport.js"></script>
		<script type="text/javascript">
		jQuery(function($){
			$('.wysiwyg').summernote({
				lang: 'zh-CN',
				onImageUpload: function(files, editor, $editable) {
					$editable.parent('.note-editor').find('.note-image-input').fileupload({url: '/media/upload'})
						.fileupload('send', {files: files}).success(function(result){
							editor.insertImage($editable, result.url);
						});
					}
				});
				$('video,audio').mediaelementplayer();
			});
		</script>
	</body>
</html>
