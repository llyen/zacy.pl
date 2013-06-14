<?php
/* @var $this FilesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Files',
);

$this->menu=array(
	array('label'=>'SKŁAD PLIKÓW'),
	array('label'=>'Pliki w składzie', 'url'=>array('files/index'), 'active'=>true, 'icon'=>'th-large'),
	array('label'=>'Wgraj plik do składu', 'url'=>array('files/create'), 'icon'=>'download-alt'),
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
<h3>Pliki w składzie</h3>
<table>
	<thead>
		<tr>
			<th style="width: 300px;">Nazwa</th>
			<th style="width: 150px;">Operacje</th>
		</tr>
	</thead>
	<tbody>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'',
	'emptyText'=>'<tr><td style="text-align: left">Nie udostępniono jeszcze żadnego pliku w tym składzie.</td><td></td></tr>',
)); ?>
	</tbody>
</table>
