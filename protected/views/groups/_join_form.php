<?php
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
        'type'=>'horizontal',
    ));

    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name'=>'group_id',
        'source'=>$dataProvider,
        'model'=>$model,
        // additional javascript options for the autocomplete plugin
        'options'=>array(
        'minLength'=>'2',
        ),
        'htmlOptions'=>array(
        'style'=>'height:20px; margin-right: 25px;'
        ),
    ));
    
    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Dołącz do grupy'));
    
    $this->endWidget();