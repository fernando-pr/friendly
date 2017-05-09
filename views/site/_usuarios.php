<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre',

    ],
    'tableOptions' => [
        'class' => 'table table-bordered table-hover',
    ],
]);


?>
