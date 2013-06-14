<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="author" content="Jakub Wawrzyniak [jakub@itpeople.pl]">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css');
	    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.min.js', CClientScript::POS_HEAD);
	    $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.slides.min.js', CClientScript::POS_HEAD);
        ?>	
</head>

<body>

<div class="container-fluid" id="page">

	<div id="header" class="span9 wrapper">
		<div id="logo"><img alt="<?php echo Yii::app()->name; ?>" src="<?php echo Yii::app()->baseUrl; ?>/images/logotype.png"></div>
		<div id="control">
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
		
		<div id="splash" class="span9 wrapper">
			<div id="about">
				<h1>Organizacja komunikacji w grupie</h1>
				<p>Poznaj narzędzia, dzięki którym wymiana informacji w Twojej grupie będzie nie tylko sprawniejsza, ale również bardziej wiarygodna.</p>
				<p>
					<?php
					if(Yii::app()->user->isGuest)
					{
						$this->widget('bootstrap.widgets.TbButton', array(
							'type'=>'primary',
							'size'=>'large',
							'label'=>'Zaloguj się',
							'url'=>array('site/login'),
						));
					}
					?>
				</p>
			</div>
			<div id="carousel">
				<img src="<?php echo Yii::app()->baseUrl; ?>/images/carousel_1.png">
				<img src="<?php echo Yii::app()->baseUrl; ?>/images/carousel_2.png">
				<img src="<?php echo Yii::app()->baseUrl; ?>/images/carousel_1.png">
				<img src="<?php echo Yii::app()->baseUrl; ?>/images/carousel_2.png">
			</div>
		</div><!-- splash -->
		
	</div><!-- header -->
	
	
	
	<div id="middle"></div><!-- middle -->
	
	<div id="content-container">
		<div id="content" class="span9 wrapper">
			<?php echo $content; ?>
		</div>
	</div><!-- content -->

</div><!-- page -->
<script>
    $(function(){
      $("#carousel").slidesjs({
        width: 400,
        height: 190,
	navigation: {
		active: false,
	},
	play: {
          active: false,
          auto: true,
	  effect: 'fade',
          interval: 4000,
          swap: false,
          pauseOnHover: false,
          restartDelay: 2500
        },
      });
    });
</script>
</body>
</html>
