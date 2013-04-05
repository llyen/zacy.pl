<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="author" content="Jakub Wawrzyniak [jakub@itpeople.pl]">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css');
        ?>
</head>

<body>

<div class="container-fluid" id="page">

	<div id="header" class="span9 wrapper">
	        <div id="logo"><img alt="<?php echo Yii::app()->name; ?>" src="<?php echo Yii::app()->baseUrl; ?>/images/logotype.png"></div>
	    	<div id="control">
			<div id="login-info">
				<?php if(Yii::app()->user->isGuest): ?>
				Nie jesteś zalogowany.<br>Możesz <?php echo CHtml::link('założyć konto dla grupy', array('groups/register')); ?> i&nbsp;administrować&nbsp;dostępem do niego.
				<?php else: ?>
				Jesteś zalogowany jako <em><?php echo Yii::app()->user->name; ?></em><br><?php echo CHtml::link('Wyloguj się', array('site/logout')); ?>
				<?php endif; ?>
			</div>
			<div id="menu">
			<ul>
				<li><?php echo CHtml::link('strona główna', Yii::app()->baseUrl); ?></li>
				<li><?php echo CHtml::link('wiadomości', array('messages/index')); ?></li>
				<li><?php echo CHtml::link('forum', array('forums/index')); ?></li>
				<li><?php echo CHtml::link('skład plików', array('storages/index')); ?></li>
				<li><?php echo CHtml::link('kalendarz', array('calendars/index')); ?></li>
			</ul>
			</div><!-- menu -->
		</div>
	</div><!-- header -->

	<div id="content-container" class="span9 wrapper">
		<div id="content">
			<?php echo $content; ?>
		</div>
	</div><!-- content -->

</div><!-- page -->

</body>
</html>
