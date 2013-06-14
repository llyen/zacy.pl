<?php
/* @var $this GroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'GRUPA'),
	array('label'=>'Członkowie', 'url'=>array('groups/index'), 'icon'=>'user'),
	array('label'=>'Akceptacja zgłoszeń', 'url'=>array('groups/applications'), 'active'=>true, 'icon'=>'check', 'visible'=>Yii::app()->user->isGroupAdmin()),
);
?>

<h3>Oczekujące na akceptację</h3>
<table>
	<thead>
		<tr>
			<th style="width: 200px;">Nazwa użytkownika</th>
                        <th style="width: 150px;">Operacje</th>
		</tr>
	</thead>
	<tbody>
<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_applications_view',
		'summaryText'=>'',
                'emptyText'=>'<tr><td>Brak oczekujących zgłoszeń.</td><td></td></tr>',
	));
?>
	</tbody>
</table>