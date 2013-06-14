<?php
/* @var $this EventsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Events',
);

$this->menu=array(
	array('label'=>'WYDARZENIA'),
	array('label'=>'Aktualne wydarzenia', 'url'=>array('events/index'), 'active'=>true, 'icon'=>'calendar'),
	array('label'=>'Utwórz wydarzenie', 'url'=>array('events/create'), 'icon'=>'list-alt'),
);
?>
<?php

$this->widget('bootstrap.widgets.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'×', // close link text - if set to false, no close link is displayed
		'htmlOptions'=>array(
			'style'=>'margin-top: 15px;',	
		),
	));

?>
<h3>Wydarzenia</h3>
<table>
	<thead>
		<tr>
			<th style="width: 200px;">Nazwa</th>
			<th style="width: 350px;">Szczegóły</th>
			<th style="width: 50px;">Data</th>
		</tr>
	</thead>
	<tbody>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'',
	'emptyText'=>'<tr><td style="text-align:left;">Nie dodano jeszcze żadnego wydarzenia.</td><td></td><td></td></tr>',
)); ?>
	</tbody>
</table>
