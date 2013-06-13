<?php
/* @var $this MessagesController */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>'WIADOMOŚCI'),
	array('label'=>'Odebrane', 'url'=>array('messages/index'), 'active'=>true, 'icon'=>'envelope'),	
	);

//imap functions
function flattenParts($messageParts, $flattenedParts = array(), $prefix = '', $index = 1, $fullPrefix = true) {

	foreach($messageParts as $part) {
		$flattenedParts[$prefix.$index] = $part;
		if(isset($part->parts)) {
			if($part->type == 2) {
				$flattenedParts = flattenParts($part->parts, $flattenedParts, $prefix.$index.'.', 0, false);
			}
			elseif($fullPrefix) {
				$flattenedParts = flattenParts($part->parts, $flattenedParts, $prefix.$index.'.');
			}
			else {
				$flattenedParts = flattenParts($part->parts, $flattenedParts, $prefix);
			}
			unset($flattenedParts[$prefix.$index]->parts);
		}
		$index++;
	}

	return $flattenedParts;
			
}

function getPart($connection, $messageNumber, $partNumber, $encoding) {
	
	$data = imap_fetchbody($connection, $messageNumber, $partNumber);
	switch($encoding) {
		case 0: return $data; // 7BIT
		case 1: return $data; // 8BIT
		case 2: return $data; // BINARY
		case 3: return base64_decode($data); // BASE64
		case 4: return quoted_printable_decode($data); // QUOTED_PRINTABLE
		case 5: return $data; // OTHER
	}
	
	
}

function getFilenameFromPart($part) {

	$filename = '';
	
	if($part->ifdparameters) {
		foreach($part->dparameters as $object) {
			if(strtolower($object->attribute) == 'filename') {
				$filename = $object->value;
			}
		}
	}

	if(!$filename && $part->ifparameters) {
		foreach($part->parameters as $object) {
			if(strtolower($object->attribute) == 'name') {
				$filename = $object->value;
			}
		}
	}
	
	return $filename;
	
}

?>
<h3>Wiadomość #<?php echo $msgno; ?> - Szczegóły</h3>
<?php

if($mbox = @imap_open("{".Yii::app()->params['hostURL'].":".Yii::app()->params['hostPort']."/pop3/novalidate-cert}INBOX", $mailbox['name'].'@'.Yii::app()->params['hostURL'], $mailbox['pass'], OP_SILENT))
{
	$attachments = array();
	$structure = imap_fetchstructure($mbox, $msgno);
        if($structure->type === 0)
	{
		$message = getPart($mbox, $msgno, 1, $structure->encoding);
	}
	else
	{
		$flattenedParts = flattenParts($structure->parts);
        
		foreach($flattenedParts as $partNumber => $part) {

		    switch($part->type) {
		
			case 0:
				$message = getPart($mbox, $msgno, $partNumber, $part->encoding);
			break;
	
			case 1:
				// multi-part headers, can ignore
		
			break;
			case 2:
				// attached message headers, can ignore
			break;
		
			case 3: // application
			case 4: // audio
			case 5: // image
			case 6: // video
			case 7: // other
		                $attachments[] = array(
		                    'partno' => $partNumber-1,
		                    'fileName' => mb_convert_encoding(imap_mime_header_decode(getFilenameFromPart($part))[0]->text, 'utf-8', 'iso-8859-2'),
		                );
			break;
	
		    }
	
		}
	}
	$overview = imap_fetch_overview($mbox, $msgno, 0);
        
	echo '<div class="well"><strong>Od:</strong> '.$overview[0]->from.'<br><strong>Temat:</strong> '.imap_utf8($overview[0]->subject).'<br><strong>Otrzymano:</strong> '.date('Y.m.d', strtotime($overview[0]->date)).'<hr><p>'.mb_convert_encoding($message, 'utf-8', mb_detect_encoding($message, array('iso-8859-2', 'utf-8', 'iso-8859-1'))).'</p></div>';
        
        
        if(sizeof($attachments)>0)
        {
            echo '<h4>Załączniki:</h4>';
            foreach($attachments as $idx=>$attachment)
            {
                echo ($idx+1).'. <a href="'.Yii::app()->createUrl('messages/downloadAttachment', array('msgno'=>$msgno, 'partno'=>$attachment['partno'])).'">'.$attachment['fileName'].'</a><br>';
            }    
        }
        
	@imap_close($mbox);
}
else
{
	var_dump(imap_errors());
}

?>