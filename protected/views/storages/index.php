<?php
/* @var $this StoragesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Storages',
);

$this->menu=array(
	array('label'=>'Create Storages', 'url'=>array('create')),
	array('label'=>'Manage Storages', 'url'=>array('admin')),
);
?>

<h1>Storages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
