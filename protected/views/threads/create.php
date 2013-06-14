<?php
/* @var $this ThreadsController */
/* @var $model Threads */

$this->breadcrumbs=array(
	'Threads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'FORUM'),
	array('label'=>'Tematy', 'url'=>array('threads/index'), 'icon'=>'list'),
	array('label'=>'Nowy temat', 'url'=>array('threads/create'), 'active'=>true, 'icon'=>'comment'),
);
?>

<h3>Nowy temat</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,'postModel'=>$postModel)); ?>