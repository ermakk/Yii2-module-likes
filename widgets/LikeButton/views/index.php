<?php

/**
* @var $likes \ermakk\likes\models\Likes
* @var $count integer
* @var $url string
* @var $id integer
* @var $class string
* @var $pluginOptions array
* @var $behaviors array
 **/

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

$heart = $pluginOptions['icoFalseState'];
$heart_fill = $pluginOptions['icoTrueState'];
$buttonClass =  $pluginOptions['buttonClass'];
$buttonClassTrueState =  $pluginOptions['buttonClassTrueState'];
$buttonClassFalseState =  $pluginOptions['buttonClassFalseState'];
$counterClass =  $pluginOptions['counterClass'];
$actionClass =  $pluginOptions['actionClass'];

$js = "
$('.".$actionClass."').on('click', function(){
    ".(new \yii\web\JsExpression($behaviors['beforeLike']))."
    let button = this;
    let url = $(this).attr('data-url');
    like = '".str_replace(array("\r\n", "\r", "\n"),'', $heart)." "."'
    like_fill = '".str_replace(array("\r\n", "\r", "\n"),'', $heart_fill)." "."'
    $.getJSON(url, function(data){
        if (data.message.type == 'success'){
            if (data.message.content.toggleState) {
               $(button).html(like_fill + data.message.content.count);
               button.classList.add('".$buttonClassFalseState."'); 
               button.classList.remove('".$buttonClassTrueState."'); 
            } else {
               $(button).html(like + data.message.content.count);
               button.classList.add('".$buttonClassTrueState."'); 
               button.classList.remove('".$buttonClassFalseState."'); 
            }
        } else if(data.message.type == 'error') {
           console.log(data.message.content)
        }
    });
    ".(new \yii\web\JsExpression($behaviors['afterLike']))."
});
";

$this->registerJs($js, View::POS_READY);
if ($likes == null) {?>
    <?= Html::button($heart.' <span class="'.$counterClass.'">'.$count.'</span>', ['class' => $actionClass.' '.$buttonClass.' '.$buttonClassTrueState, 'data-url' => $url]); ?>
<?php } else { ?>
    <?= Html::button($heart_fill.' <span class="'.$counterClass.'">'.$count.'</span>',['class' => $actionClass.' '.$buttonClass.' '.$buttonClassFalseState, 'data-url' => $url]); ?>
<?php } ?>