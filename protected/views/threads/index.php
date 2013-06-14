<?php
/* @var $this ThreadsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Threads',
);

$this->menu=array(
	array('label'=>'FORUM'),
	array('label'=>'Tematy', 'url'=>array('threads/index'), 'active'=>true, 'icon'=>'list'),
	array('label'=>'Nowy temat', 'url'=>array('threads/create'), 'icon'=>'comment'),
);
?>

<h3>Forum</h3>
<table class="forum">
	<thead>
		<tr>
			<th style="width: 300px;">Temat</th>
			<th style="width: 150px;">Autor</th>
			<th style="width: 50px;">Posty</th>
		</tr>
	</thead>
	<tbody>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'',
	'emptyText'=>'<tr><td>Nie utworzono jeszcze żadnego tematu.</td><td></td><td></td></tr>',
)); ?>
	</tbody>
</table>
