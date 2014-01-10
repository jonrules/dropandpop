<div class="uploadedFiles form">
<?php echo $this->Form->create('UploadedFile'); ?>
	<fieldset>
		<legend><?php echo __('Edit Uploaded File'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('ext');
		echo $this->Form->input('mimetype');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UploadedFile.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UploadedFile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Uploaded Files'), array('action' => 'index')); ?></li>
	</ul>
</div>
