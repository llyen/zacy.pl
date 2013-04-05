<?php
/* @var $this MessagesController */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>'WIADOMOŚCI'),
	array('label'=>'Odebrane', 'url'=>array('messages/index'), 'active'=>true, 'icon'=>'envelope'),	
	);
?>
<h3> - odebrane wiadomości</h3>
<?php

if($mbox = @imap_open("{e-zacy.pl:110/pop3/novalidate-cert}INBOX", 'test@e-zacy.pl', 'test', OP_SILENT))
	{
	$check = @imap_mailboxmsginfo($mbox);
	if(is_numeric($check->Nmsgs))
		{
		for($i = 1; $i <= $check->Nmsgs; $i++)
			{
			var_dump(@imap_fetch_overview($mbox, $i, 0));
			}
		}
	@imap_close($mbox);
	}
else
	{
		var_dump(imap_errors());
	}

?>