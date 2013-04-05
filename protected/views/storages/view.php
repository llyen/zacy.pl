<?php
/* @var $this StoragesController */
/* @var $model Storages */

$this->breadcrumbs=array(
	'Storages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Storages', 'url'=>array('index')),
	array('label'=>'Create Storages', 'url'=>array('create')),
	array('label'=>'Update Storages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Storages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Storages', 'url'=>array('admin')),
);
?>

<h1>View Storages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id',
		'path',
	),
)); ?>
