<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'FORUM'),
	array('label'=>'Tematy', 'url'=>array('threads/index'), 'icon'=>'list'),
	array('label'=>'Nowy temat', 'url'=>array('threads/create'), 'icon'=>'comment'),
        array('label'=>'Powrót', 'url'=>array("threads/view/$tid"), 'icon'=>'share-alt'),
);
?>

<h3>Dodaj post</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>