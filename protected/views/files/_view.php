<?php
/* @var $this FilesController */
/* @var $data Files */
?>

<tr>
	<td style="text-align: left;">
		<?php echo $data['name']; ?>
	</td>
	<td>
	<?php
		$this->widget('bootstrap.widgets.TbButton',array(
                    'label' => 'Pobierz',
                    'type' => 'primary',
                    'size' => 'mini',
                    'url' => Yii::app()->createUrl('files/download', array('id'=>$data['id'])),
                ));
	?>
	</td>
</tr>