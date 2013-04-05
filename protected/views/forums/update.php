<?php
/* @var $this ForumsController */
/* @var $model Forums */

$this->breadcrumbs=array(
	'Forums'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Forums', 'url'=>array('index')),
	array('label'=>'Create Forums', 'url'=>array('create')),
	array('label'=>'View Forums', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Forums', 'url'=>array('admin')),
);
?>

<h1>Update Forums <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>