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
	    	<div id="control" <?php if(!Yii::app()->user->isGuest && Yii::app()->user->gid === null || !Yii::app()->user->isGuest && !Yii::app()->user->isConfirmed()): ?> style="width: 100px;" <?php endif; ?>>
			<div id="login-info">
				<?php if(Yii::app()->user->isGuest): ?>
				Nie jesteś zalogowany.<br><?php echo CHtml::link('Zarejestruj się', array('users/register')); ?> aby&nbsp;uzyskać&nbsp;dostęp do podstawowych funkcjonalności serwisu.
				<?php else: ?>
				Jesteś zalogowany jako <em><?php echo Yii::app()->user->name; ?></em><br><?php echo CHtml::link('Wyloguj się', array('site/logout')); ?>
				<?php endif; ?>
			</div>
			<div id="menu">
			<ul>
				<?php if(!Yii::app()->user->isGuest): ?> <li><?php echo CHtml::link('grupa', array('groups/index')); ?></li><?php endif; ?>
				<?php if(!Yii::app()->user->isGuest && Yii::app()->user->gid !== null && Yii::app()->user->isConfirmed()): ?>
				<li><?php echo CHtml::link('wiadomości', array('messages/index')); ?></li>
				<li><?php echo CHtml::link('forum', array('threads/index')); ?></li>
				<li><?php echo CHtml::link('skład plików', array('files/index')); ?></li>
				<li><?php echo CHtml::link('kalendarz', array('events/index')); ?></li>
				<?php endif; ?>
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
