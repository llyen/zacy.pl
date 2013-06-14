<?php
/* @var $this EventsController */
/* @var $model Events */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'events-form',
	'enableAjaxValidation'=>true,
	'type'=>'vertical',
)); ?>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>255)); ?>

		<?php echo $form->html5EditorRow($model, 'description', array('class'=>'span3', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true))); ?>

		<?php echo $form->datePickerRow($model,'event_date',array('options'=>array('format'=>'yyyy-mm-dd'))); ?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Zapisz')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->