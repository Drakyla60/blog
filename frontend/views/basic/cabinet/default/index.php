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
/** @var \core\entities\User $user */

?>
<div class="raw">
    <div class="cabinet-content col-md-8">
        <table class="table">
            <thead>
            <tr>
                <th>
                    Інформація
                </th>
            </tr>
            </thead>
            <tbody class="tab-pane">
            <tr >
                <th>Ваш ID</th>
                <th>Логін</th>
                <th>E-mail</th>
                <th>Дата реєстрації</th>
                <th>Дата останього оновлення</th>
            </tr>
            <tr>
                <th># <?= $user->id ?></th>
                <th><?= $user->username ?></th>
                <th><?= $user->email ?></th>
                <th><?= date('Y-m-d', $user->created_at) ?></th>
                <th><?= date('Y-m-d', $user->updated_at) ?></th>
            </tr>

            </tbody>
        </table>

    </div>
    <div class="cabinet-menu col-md-4">
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