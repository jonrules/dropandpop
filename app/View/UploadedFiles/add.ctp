<div class="uploadedFiles form">
<?php echo $this->Form->create('UploadedFile'); ?>
	<fieldset>
		<legend><?php echo __('Add Uploaded File'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Uploaded Files'), array('action' => 'index')); ?></li>
	</ul>
</div>
