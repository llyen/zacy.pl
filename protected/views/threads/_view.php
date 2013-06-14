<?php
/* @var $this ThreadsController */
/* @var $data Threads */
?>

<tr>
	<td style="text-align: left;">
		<?php
		echo '<img style="margin-right: 15px; vertical-align: top;" alt="szczegóły" src="'.Yii::app()->baseUrl.'/images/folder.png"><a href="'.Yii::app()->createUrl('threads/view', array('id'=>$data['id'])).'">'.$data['name'].'</a>';
		?>
	</td>
	<td>
		<?php echo $data['owner']; ?>
	</td>
	<td>
		<?php
		$this->widget('bootstrap.widgets.TbBadge', array(
			'type'=>'info',
			'label'=>$data['posts'],
		));
		?>
	</td>
</tr>