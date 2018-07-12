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
/** @var \core\entities\User\User $user */

?>
<div class="raw">
    <div class="cabinet-content col-md-8">
	<h1 >Setting</h1>
	<table id="w0" class="table table-striped table-bordered detail-view">
		<tbody>
			<tr><th>Ваш ID</th><td># <?= $user->id ?></td></tr>
			<tr><th>Логін</th><td><?= $user->username ?></td></tr>
			<tr><th>Email</th><td><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td></tr>
			<tr><th>Status</th><td>10</td></tr>
			<tr><th>Дата реєстрації</th><td><?= date('Y-m-d', $user->created_at) ?></td></tr>
			<tr><th>Дата останього оновлення</th><td><?= date('Y-m-d', $user->updated_at) ?></td></tr>
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