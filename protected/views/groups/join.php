<?php
/* @var $this GroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'GRUPA'),
	array('label'=>'Członkowie', 'url'=>array('groups/index'), 'active'=>true, 'icon'=>'user'),
	array('label'=>'Akceptacja zgłoszeń', 'url'=>array('groups/applications'), 'icon'=>'check', 'visible'=>Yii::app()->user->isGroupAdmin()),
);
?>

<h3>Wybierz grupę, do której chcesz dołączyć</h3>
<?php $this->renderPartial('_join_form', array('dataProvider'=>$dataProvider, 'model'=>$model)); ?>