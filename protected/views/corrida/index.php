<?php
/* @var $this CorridaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Corridas',
);

$this->menu=array(
	array('label'=>'Create Corrida', 'url'=>array('create')),
	array('label'=>'Manage Corrida', 'url'=>array('admin')),
);
?>

<h1>Corridas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
