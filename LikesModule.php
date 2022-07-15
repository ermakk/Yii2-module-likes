<?php

namespace ermakk\likes;

use Yii;

/**
 * modues module definition class
 */
class LikesModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'ermakk\likes\controllers';
    public $token = 'ermakk-likes';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
