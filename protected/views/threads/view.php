<?php
/* @var $this ThreadsController */
/* @var $model Threads */

$this->breadcrumbs=array(
	'Threads'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'FORUM'),
	array('label'=>'Tematy', 'url'=>array('threads/index'), 'icon'=>'list'),
	array('label'=>'Nowy temat', 'url'=>array('threads/create'), 'icon'=>'comment'),
);
?>

<h3><?php echo $model->name; ?></h3>
<?php
 $this->widget('bootstrap.widgets.TbButton',array(
                    'label' => 'Dodaj post',
                    'type' => 'primary',
                    'size' => 'small',
                    'url' => Yii::app()->createUrl('posts/create', array('tid'=>$tid)),
                    'htmlOptions'=>array(
                        'style'=>'float: right;',  
                    ),
                ));
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_posts_view',
	'summaryText'=>'',
)); ?>