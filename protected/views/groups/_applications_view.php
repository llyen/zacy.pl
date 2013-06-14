<?php
/* @var $this GroupsController */
/* @var $data Groups */
?>

<tr>
	<td><?php echo $data['username']; ?></td>
        <td>
            <?php
                $this->widget('bootstrap.widgets.TbButton',array(
                    'label' => 'Akceptuj',
                    'type' => 'primary',
                    'size' => 'mini',
                    'url' => Yii::app()->createUrl('groups/confirmApplication', array('uid'=>$data['id'])),
                ));
                $this->widget('bootstrap.widgets.TbButton',array(
                    'label' => 'Odrzuć',
                    'type' => 'danger',
                    'size' => 'mini',
                    'url' => Yii::app()->createUrl('groups/rejectApplication', array('uid'=>$data['id'])),
                    'htmlOptions' => array(
                        'style' => 'margin-left: 10px;',
                    ),
                ));
            ?>
        </td>
</tr>