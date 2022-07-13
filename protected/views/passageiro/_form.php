<?php
/* @var $this PassageiroController */
/* @var $model Passageiro */
/* @var $form CActiveForm */
/* FIXME: ao atualizar o registro, não está sendo atualizado a propriedade
data_hora_status.
*/ 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'passageiro-form',
	'focus'=>array($model, 'nome'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nascimento'); ?>
		<?php echo CHtml::activeDateField($model,'nascimento'); ?>
		<?php echo $form->error($model,'nascimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefone'); ?>
		<?php echo $form->textField($model,'telefone',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'telefone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo CHtml::activeDropDownList($model,'status',array('I','A'),array('size'=>1,'maxlength'=>1,'disabled'=>$model->isNewRecord?true:false)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'obs'); ?>
		<?php echo CHtml::activeTextArea($model,'obs',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'obs'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->