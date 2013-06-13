<?php

class WebUser extends CWebUser
{
    private $_model;
    
    public function getGid()
    {
        $user = $this->loadModel(Yii::app()->user->id);
        return $user->group_id;
    }
    
    public function isGroupAdmin()
    {
        $user = $this->loadModel(Yii::app()->user->id);
        if($user->group_id !== null)
        {
            $group = Groups::model()->findByPk($user->group_id);
            if($user->username === $group->admin)
                return true;    
        }
        return false;
    }
    
    public function isConfirmed()
    {
        $user = $this->loadModel(Yii::app()->user->id);
        return (bool) $user->confirmed;
    }

    protected function loadModel($id=null)
    {
        if($this->_model === null)
        {
            if($id !== null)
            {
                $this->_model = Users::model()->findByPk($id);
            }
        }
        return $this->_model;
    }

}