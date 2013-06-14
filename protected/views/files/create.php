<?php
/* @var $this FilesController */
/* @var $model Files */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'SKŁAD PLIKÓW'),
	array('label'=>'Pliki w składzie', 'url'=>array('files/index'), 'icon'=>'th-large'),
	array('label'=>'Wgraj plik do składu', 'url'=>array('files/create'), 'active'=>true, 'icon'=>'download-alt'),
);
?>

<h3>Wybierz plik</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>