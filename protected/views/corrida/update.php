<?php
/* @var $this CorridaController */
/* @var $model Corrida */

$this->breadcrumbs=array(
	'Corridas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Corrida', 'url'=>array('index')),
	array('label'=>'Create Corrida', 'url'=>array('create')),
	array('label'=>'View Corrida', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Corrida', 'url'=>array('admin')),
);
?>

<h1>Update Corrida <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>