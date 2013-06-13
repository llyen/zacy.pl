<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'groups-form',
		'enableAjaxValidation'=>true,
	        'type'=>'horizontal',
	));

	echo $form->errorSummary($model);
	echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>100));
?>
<div class="form-actions">
<?php
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Utwórz'));
?>
</div>
<?php
	$this->endWidget();
?>
</div>