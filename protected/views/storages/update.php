<?php
/* @var $this StoragesController */
/* @var $model Storages */

$this->breadcrumbs=array(
	'Storages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Storages', 'url'=>array('index')),
	array('label'=>'Create Storages', 'url'=>array('create')),
	array('label'=>'View Storages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Storages', 'url'=>array('admin')),
);
?>

<h1>Update Storages <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>