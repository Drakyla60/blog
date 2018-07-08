<?php
/**
 * Created by PhpStorm.
 * User: Roma Volkov
 * Email: Drakyla60@gmail.com
 * Date: 7/8/2018
 * Time: 5:02 PM
 */

use yii\helpers\Html;
$this->title = Yii::t('app', 'Cabinet');
$this->params['breadcrumbs'][] = $this->title;

use kartik\sidenav\SideNav;


?>
<div class="raw">
    <div class="cabinet-content col-md-9">

    </div>
    <div class="cabinet-menu col-md-3">
        <?php echo SideNav::widget([
            'type' => SideNav::TYPE_INFO,
            'heading' => 'Настройки',
            'items' => [
                [
                    'url' => 'cabinet/lol',
                    'label' => 'Home',
                    'icon' => 'home'
                ],
                [
                    'label' => 'Help',
                    'icon' => 'question-sign',
                    'items' => [
                        ['label' => 'About', 'icon'=>'info-sign', 'url'=>'#'],
                        ['label' => 'Contact', 'icon'=>'phone', 'url'=>'#'],
                    ],
                ],
            ],
        ]);?>
    </div>
</div>