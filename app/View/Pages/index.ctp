<?php $this->Html->css('/js/jquery.dropandpop/css/jquery.dropandpop.css', array('inline' => false)); ?>

<div id="file-drop"></div>
<div id="file-line"></div>
<iframe id="file-viewer" name="file-viewer" width="100%" height="500" seamless="seamless"></iframe>


<?php echo $this->Html->script('jquery.dropandpop/jquery.dropandpop'); ?>
<script>
// <![CDATA[
$(function() {
	var uploadUrl = <?php echo json_encode($this->Html->url('/UploadedFiles/upload')); ?>;
	
	var onDrop = function(files, e) {
		
	};

	var onComplete = function(response) {
		var iconPath = <?php echo json_encode($this->Html->url('/img/file-type-icon-set/png/')); ?>;
		var filePath = <?php echo json_encode($this->Html->url('/files/uploadedFiles/')); ?>;
		var $fileLine = $('#file-line');
		for (var i = 0; i < response.length; i++) {
			var fileUrl = filePath + response[i].UploadedFile.name;
			var imgUrl = iconPath + response[i].UploadedFile.ext + '.png';
			var $icon = $('<div class="file-icon"></div>');
			var $link = $('<a></a>').attr('href', fileUrl).attr('target', 'file-viewer')
				.attr('title', response[i].UploadedFile.name);
			var $img = $('<img width="48" height="48" />').attr('src', imgUrl)
				.attr('alt', response[i].UploadedFile.name);
			$fileLine.append($icon.append($link.append($img)));
			$icon.hide().fadeIn();
		}
	};
	
	$('#file-drop').dropandpop(uploadUrl, onDrop, onComplete);
});
// ]]>
</script>