<?php
/* @var $this CalendarsController */
/* @var $model Calendars */

$this->breadcrumbs=array(
	'Calendars'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Calendars', 'url'=>array('index')),
	array('label'=>'Create Calendars', 'url'=>array('create')),
	array('label'=>'View Calendars', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Calendars', 'url'=>array('admin')),
);
?>

<h1>Update Calendars <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>