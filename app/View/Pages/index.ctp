<?php $this->Html->css('/js/jquery.dropandpop/css/jquery.dropandpop.css', array('inline' => false)); ?>

<div class="dropbox"></div>


<?php echo $this->Html->script('jquery.dropandpop/jquery.dropandpop'); ?>
<script>
// <![CDATA[
$(function() {
	var uploadUrl = <?php echo json_encode($this->Html->url('/UploadedFiles/upload')); ?>;
	
	var onDrop = function(e, files) {

	};

	var onComplete = function(response) {

	};
	
	$('.dropbox').dropandpop(uploadUrl, onDrop, onComplete);
});
// ]]>
</script>