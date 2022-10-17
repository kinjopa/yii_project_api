<?php

/** @var yii\web\View $this
 * @var \frontend\models\Users $user
 * @var array $comments
 */

use yii\widgets\DetailView;

$this->title = 'Yii Application';
$this->registerJsFile('@web/js/index.js');
?>
<div class="site-index">
    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'id',
            'name',
            'patronymic',
            'surname',
            'email:email',
            'phone',
            [
                'attribute' => 'city',
                'value' => $user->city['name'],
            ],
            [
                'attribute' => 'avatar',
                'value' => Yii::getAlias('@images') . $user->avatar['url'],
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],

        ],
    ]) ?>
    <?= \yii\helpers\Html::a('Добавить комментарий', '/comments/view', ['class' => 'btn btn-success'])?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Статус</th>
            <th scope="col">Комментарий</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дата обновления</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $index => $comment) { ?>
            <tr class="comment-id-<?= $comment['id'] ?>">
                <th scope="row"><?= ++$index ?></th>
                <th class="comment-status"><?= $comment['status'] ? 'Опубликован' : 'Не опубликован' ?></th>
                <td><?= $comment['comment'] ?></td>
                <td><?= $comment['created_at'] ?></td>
                <td class="comment-updated"><?= $comment['updated_at'] ?></td>
                <td>
                    <span class="comment-status-ico"
                          onclick="set_status('<?= $comment['id'] ?>')"><?= $comment['status'] ? '<i class="fa-solid fa-square-check"></i>' : '<i class="fa-regular fa-square-check"></i>' ?></span>
                    <span onclick="delete_item('<?= $comment['id'] ?>')"><i class="fa-solid fa-trash-can"></i></span>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>