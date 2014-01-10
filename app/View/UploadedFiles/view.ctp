<div class="uploadedFiles view">
<h2><?php echo __('Uploaded File'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($uploadedFile['UploadedFile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($uploadedFile['UploadedFile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ext'); ?></dt>
		<dd>
			<?php echo h($uploadedFile['UploadedFile']['ext']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mimetype'); ?></dt>
		<dd>
			<?php echo h($uploadedFile['UploadedFile']['mimetype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($uploadedFile['UploadedFile']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($uploadedFile['UploadedFile']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Uploaded File'), array('action' => 'edit', $uploadedFile['UploadedFile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Uploaded File'), array('action' => 'delete', $uploadedFile['UploadedFile']['id']), null, __('Are you sure you want to delete # %s?', $uploadedFile['UploadedFile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Uploaded Files'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Uploaded File'), array('action' => 'add')); ?> </li>
	</ul>
</div>
