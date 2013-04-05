<?php
/* @var $this ForumsController */
/* @var $model Forums */

$this->breadcrumbs=array(
	'Forums'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Forums', 'url'=>array('index')),
	array('label'=>'Manage Forums', 'url'=>array('admin')),
);
?>

<h1>Create Forums</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>