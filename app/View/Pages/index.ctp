<?php $this->Html->css('/js/jquery.dropandpop/css/jquery.dropandpop.css', array('inline' => false)); ?>

<div id="file-drop"></div>
<div id="file-line">
<?php foreach ($uploadedFiles as $file): ?>
	<div class="file-icon" title="<?php echo h($file['UploadedFile']['name']); ?>" data-file-id="<?php echo h($file['UploadedFile']['id']); ?>">
		<a class="file-delete" href="#">&times;</a>
		<a class="file-link" href="<?php echo h($this->Html->url('/files/uploadedFiles/' . $file['UploadedFile']['name'])); ?>" target="file-viewer">
			<img width="48" height="48" 
					src="<?php echo h($this->Html->url('/img/file-type-icon-set/png/' . $file['UploadedFile']['ext'] . '.png')); ?>" 
					alt="<?php echo h($file['UploadedFile']['name']); ?>" />
		</a>
		<div class="file-caption"><?php echo h($file['UploadedFile']['name']); ?></div>
	</div>
<?php endforeach; ?>
</div>
<iframe id="file-viewer" name="file-viewer" width="100%" height="500" seamless="seamless"></iframe>


<?php echo $this->Html->script('jquery.dropandpop/jquery.dropandpop'); ?>
<script>
// <![CDATA[

$(function() {
	var uploadUrl = <?php echo json_encode($this->Html->url('/UploadedFiles/upload')); ?>;
	var iconPath = <?php echo json_encode($this->Html->url('/img/file-type-icon-set/png/')); ?>;
	var filePath = <?php echo json_encode($this->Html->url('/files/uploadedFiles/')); ?>;
	var deletePath = <?php echo json_encode($this->Html->url('/UploadedFiles/delete/')); ?>;
	var $fileLine = $('#file-line');
	var $fileViewer = $('#file-viewer');

	var attachIconEvents = function() {
		$('.file-icon').each(function() {
			var $icon = $(this);
			if ($icon.hasClass('events-attached')) {
				return;
			}
			var fileId = $icon.data('file-id');
			// Tooltip
			$icon.tooltip();
			// File link
			$icon.find('.file-link').click(function() {
				$fileViewer.data('file-id', $icon.data('file-id'));
			});
			// File delete
			$icon.find('.file-delete').click(function() {
				$.post(deletePath + fileId, null, function() {
					$icon.fadeOut(400, function() { $icon.remove(); } );
					if ($fileViewer.data('file-id') == fileId) {
						$fileViewer.attr('src', '');
					}
				});
			});
		});
	};
	
	var onDrop = function(files, e) {
		
	};

	var onComplete = function(response) {
		$(response).each(function() {
			var record = this;
			var fileId = record.UploadedFile.id;
			
			// Generate URLs
			var fileUrl = filePath + record.UploadedFile.name;
			var imgUrl = iconPath + record.UploadedFile.ext + '.png';

			// Create icon
			var $icon = $('<div class="file-icon"></div>')
				.attr('title', record.UploadedFile.name)
				.data('file-id', fileId);
			$fileLine.append($icon);

			// Create delete link
			$delete = $('<a href="#" class="file-delete">&times;</a>');
			$icon.append($delete);

			// Create file link
			var $link = $('<a class="file-link"></a>').attr('href', fileUrl).attr('target', 'file-viewer');
			$icon.append($link);

			// Create image
			var $img = $('<img width="48" height="48" />').attr('src', imgUrl)
				.attr('alt', record.UploadedFile.name);
			$link.append($img);

			// Create image
			var $caption = $('<div class="file-caption"></div>').text(record.UploadedFile.name);
			$icon.append($caption);
			$icon.hide().fadeIn();
		});
		if (response.length > 0) {
			$fileViewer.attr('src', filePath + response[0].UploadedFile.name)
				.data('file-id', response[0].UploadedFile.id);
		}
		attachIconEvents();
	};
	
	$('#file-drop').dropandpop(uploadUrl, onDrop, onComplete);

	attachIconEvents();
});
// ]]>
</script>