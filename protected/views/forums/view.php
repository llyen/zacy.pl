<?php
/* @var $this ForumsController */
/* @var $model Forums */

$this->breadcrumbs=array(
	'Forums'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Forums', 'url'=>array('index')),
	array('label'=>'Create Forums', 'url'=>array('create')),
	array('label'=>'Update Forums', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Forums', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Forums', 'url'=>array('admin')),
);
?>

<h1>View Forums #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id',
		'name',
	),
)); ?>
