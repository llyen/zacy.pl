<?php
/* @var $this ThreadsController */
/* @var $model Threads */

$this->breadcrumbs=array(
	'Threads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Threads', 'url'=>array('index')),
	array('label'=>'Manage Threads', 'url'=>array('admin')),
);
?>

<h1>Create Threads</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>