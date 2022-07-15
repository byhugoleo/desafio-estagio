<?php
/* @var $this CorridaController */
/* @var $data Corrida */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passageiro_id')); ?>:</b>
	<?php echo CHtml::encode($data->passageiro_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motorista_id')); ?>:</b>
	<?php echo CHtml::encode($data->motorista_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origem_endereco')); ?>:</b>
	<?php echo CHtml::encode($data->origem_endereco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origem_lat')); ?>:</b>
	<?php echo CHtml::encode($data->origem_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origem_lng')); ?>:</b>
	<?php echo CHtml::encode($data->origem_lng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destino_endereco')); ?>:</b>
	<?php echo CHtml::encode($data->destino_endereco); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('destino_lat')); ?>:</b>
	<?php echo CHtml::encode($data->destino_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destino_lng')); ?>:</b>
	<?php echo CHtml::encode($data->destino_lng); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_hora_incio')); ?>:</b>
	<?php echo CHtml::encode($data->data_hora_incio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('previsao_chegada')); ?>:</b>
	<?php echo CHtml::encode($data->previsao_chegada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarifa')); ?>:</b>
	<?php echo CHtml::encode($data->tarifa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_hora_finalizacao')); ?>:</b>
	<?php echo CHtml::encode($data->data_hora_finalizacao); ?>
	<br />

	*/ ?>

</div>