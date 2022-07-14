<?php
/* @var $this CorridaController */
/* @var $model Corrida */

$this->breadcrumbs=array(
	'Corridas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Corrida', 'url'=>array('index')),
	array('label'=>'Manage Corrida', 'url'=>array('admin')),
);
?>

<h1>Create Corrida</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>