<?php
/* @var $this PostsController */
/* @var $model Posts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'posts-form',
		'enableAjaxValidation'=>true,
	        'type'=>'vertical',
	));
?>

	<?php echo $form->errorSummary($model); ?>	
	<?php echo $form->html5EditorRow($model, 'content', array('class'=>'span3', 'rows'=>8, 'height'=>'200', 'options'=>array('color'=>true))); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>($model->isNewRecord) ? 'Utwórz' : 'Zapisz')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->