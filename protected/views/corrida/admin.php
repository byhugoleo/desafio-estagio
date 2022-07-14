<?php
/* @var $this CorridaController */
/* @var $model Corrida */

$this->breadcrumbs=array(
	'Corridas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Corrida', 'url'=>array('index')),
	array('label'=>'Create Corrida', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#corrida-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Corridas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'corrida-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'origem_endereco',
		'origem_lat',
		'origem_lng',
		'destino_endereco',
		'destino_lat',
		/*
		'destino_lng',
		'data_hora_incio',
		'status',
		'previsao_chegada',
		'tarifa',
		'data_hora_finalizacao',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
