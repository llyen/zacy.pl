<?php
/* @var $this ThreadsController */
/* @var $model Threads */

$this->breadcrumbs=array(
	'Threads'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Threads', 'url'=>array('index')),
	array('label'=>'Create Threads', 'url'=>array('create')),
	array('label'=>'Update Threads', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Threads', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Threads', 'url'=>array('admin')),
);
?>

<h1>View Threads #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'forum_id',
		'owner_id',
		'name',
	),
)); ?>
