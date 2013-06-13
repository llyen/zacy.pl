<?php
/* @var $this GroupsController */
/* @var $model Groups */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'GRUPA'),
	array('label'=>'Członkowie', 'url'=>array('groups/index'), 'icon'=>'user'),
);
?>

<h3>Stwórz grupę</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>