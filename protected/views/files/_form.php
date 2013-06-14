<?php
/* @var $this FilesController */
/* @var $model Files */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'files-form',
		'enableAjaxValidation'=>true,
	        'type'=>'horizontal',
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',	
		),
	));
?>

	<?php echo $form->errorSummary($model); ?>	
	<?php echo $form->textFieldRow($model, 'name'); ?>
	<?php echo $form->fileFieldRow($model, 'src'); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Zapisz')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->