<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register',
);

?>

<h3>Zarejestruj się</h3>

<?php echo $this->renderPartial('_register_form', array('model'=>$model)); ?>