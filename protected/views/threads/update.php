<?php
/* @var $this ThreadsController */
/* @var $model Threads */

$this->breadcrumbs=array(
	'Threads'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Threads', 'url'=>array('index')),
	array('label'=>'Create Threads', 'url'=>array('create')),
	array('label'=>'View Threads', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Threads', 'url'=>array('admin')),
);
?>

<h1>Update Threads <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>