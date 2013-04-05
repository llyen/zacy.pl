<?php
/* @var $this CalendarsController */
/* @var $model Calendars */

$this->breadcrumbs=array(
	'Calendars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Calendars', 'url'=>array('index')),
	array('label'=>'Manage Calendars', 'url'=>array('admin')),
);
?>

<h1>Create Calendars</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>