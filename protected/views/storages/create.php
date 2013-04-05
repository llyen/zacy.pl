<?php
/* @var $this StoragesController */
/* @var $model Storages */

$this->breadcrumbs=array(
	'Storages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Storages', 'url'=>array('index')),
	array('label'=>'Manage Storages', 'url'=>array('admin')),
);
?>

<h1>Create Storages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>