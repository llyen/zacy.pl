<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'FORUM'),
	array('label'=>'Tematy', 'url'=>array('threads/index'), 'icon'=>'list'),
	array('label'=>'Nowy temat', 'url'=>array('threads/create'), 'icon'=>'comment'),
        array('label'=>'Powrót', 'url'=>array("threads/view/$model->thread_id"), 'icon'=>'share-alt'),
);
?>

<h3>Edytuj post</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>