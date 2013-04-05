<?php
/* @var $this CalendarsController */
/* @var $model Calendars */

$this->breadcrumbs=array(
	'Calendars'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Calendars', 'url'=>array('index')),
	array('label'=>'Create Calendars', 'url'=>array('create')),
	array('label'=>'Update Calendars', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Calendars', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Calendars', 'url'=>array('admin')),
);
?>

<h1>View Calendars #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id',
	),
)); ?>
