<?php
/* @var $this CalendarsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Calendars',
);

$this->menu=array(
	array('label'=>'Create Calendars', 'url'=>array('create')),
	array('label'=>'Manage Calendars', 'url'=>array('admin')),
);
?>

<h1>Calendars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
