<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'WYDARZENIA'),
	array('label'=>'Aktualne wydarzenia', 'url'=>array('events/index'), 'icon'=>'calendar'),
	array('label'=>'Utwórz wydarzenie', 'url'=>array('events/create'), 'active'=>true, 'icon'=>'list-alt'),
);
?>

<h3>Nowe wydarzenie</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>