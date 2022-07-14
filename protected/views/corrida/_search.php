<?php
/* @var $this CorridaController */
/* @var $model Corrida */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origem_endereco'); ?>
		<?php echo $form->textField($model,'origem_endereco',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origem_lat'); ?>
		<?php echo $form->textField($model,'origem_lat',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origem_lng'); ?>
		<?php echo $form->textField($model,'origem_lng',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destino_endereco'); ?>
		<?php echo $form->textField($model,'destino_endereco',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destino_lat'); ?>
		<?php echo $form->textField($model,'destino_lat',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destino_lng'); ?>
		<?php echo $form->textField($model,'destino_lng',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_hora_incio'); ?>
		<?php echo $form->textField($model,'data_hora_incio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'previsao_chegada'); ?>
		<?php echo $form->textField($model,'previsao_chegada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tarifa'); ?>
		<?php echo $form->textField($model,'tarifa',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_hora_finalizacao'); ?>
		<?php echo $form->textField($model,'data_hora_finalizacao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->