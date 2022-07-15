<?php
/* @var $this CorridaController */
/* @var $model Corrida */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'corrida-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'passageiro_id'); ?>
		<?php echo $form->textField($model,'passageiro_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'passageiro_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motorista_id'); ?>
		<?php echo $form->textField($model,'motorista_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'motorista_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origem_endereco'); ?>
		<?php echo $form->textField($model,'origem_endereco',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'origem_endereco'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origem_lat'); ?>
		<?php echo $form->textField($model,'origem_lat',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'origem_lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origem_lng'); ?>
		<?php echo $form->textField($model,'origem_lng',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'origem_lng'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destino_endereco'); ?>
		<?php echo $form->textField($model,'destino_endereco',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'destino_endereco'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destino_lat'); ?>
		<?php echo $form->textField($model,'destino_lat',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'destino_lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destino_lng'); ?>
		<?php echo $form->textField($model,'destino_lng',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'destino_lng'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_hora_incio'); ?>
		<?php echo $form->textField($model,'data_hora_incio'); ?>
		<?php echo $form->error($model,'data_hora_incio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'previsao_chegada'); ?>
		<?php echo $form->textField($model,'previsao_chegada'); ?>
		<?php echo $form->error($model,'previsao_chegada'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tarifa'); ?>
		<?php echo $form->textField($model,'tarifa',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'tarifa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_hora_finalizacao'); ?>
		<?php echo $form->textField($model,'data_hora_finalizacao'); ?>
		<?php echo $form->error($model,'data_hora_finalizacao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->