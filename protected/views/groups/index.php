<?php
/* @var $this GroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'GRUPA'),
	array('label'=>'Członkowie', 'url'=>array('groups/index'), 'active'=>true, 'icon'=>'user'),
	array('label'=>'Akceptacja zgłoszeń', 'url'=>array('groups/applications'), 'icon'=>'check', 'visible'=>Yii::app()->user->isGroupAdmin()),
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

<?php if(Yii::app()->user->gid === null || !Yii::app()->user->isConfirmed()): ?>
<h3>Nie należysz jeszcze do żadnej grupy.</h3>
<p><?php echo CHtml::link('Stwórz', array('groups/create')); ?> własną grupę lub <?php echo CHtml::link('dołącz', array('groups/join')); ?> do istniejącej.</p>
<?php else: ?>
<h3>Członkowie grupy</h3>
<table>
	<thead>
		<tr>
			<th style="width: 200px;">Nazwa użytkownika</th>
		</tr>
	</thead>
	<tbody>
<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'summaryText'=>'',
	));
?>
	</tbody>
</table>
<?php endif; ?>