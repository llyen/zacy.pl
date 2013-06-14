<?php
/* @var $this ThreadsController */
/* @var $model Threads */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'threads-form',
		'enableAjaxValidation'=>true,
	        'type'=>'vertical',
	));
?>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($postModel); ?>
	<?php echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>150)); ?>
	
	<?php echo $form->html5EditorRow($postModel, 'content', array('class'=>'span3', 'rows'=>8, 'height'=>'200', 'options'=>array('color'=>true))); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>($model->isNewRecord) ? 'Utwórz' : 'Zapisz')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->