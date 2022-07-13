<?php

/**
 * This is the model class for table "passageiro".
 *
 * The followings are the available columns in table 'passageiro':
 * @property string $id
 * @property string $nome
 * @property string $nascimento
 * @property string $email
 * @property string $telefone
 * @property string $status
 * @property string $data_hora_status
 * @property string $obs
 */
class Passageiro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'passageiro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		date_default_timezone_set('America/Sao_Paulo');
		return array(
			// geral rules
			array('nome, nascimento, email, telefone', 'required'),
			array('email, telefone', 'unique'),

			// attribute nome rules.
			array('nome', 'length', 'min'=>6, 'max'=>100),
			array('nome', 'validateNome'),

			// attribute email rules.
			array('email', 'length', 'max'=>255),
			array('email', 'email'),

			// attribute telefone rules.
			array('telefone', 'length', 'max'=>16),
			array('telefone', 'validateTelefone'),

			// attribute status rules.
			array('status', 'filter', 'filter'=>function($value) {return $value ? 'A' : 'I';}),

			// attribute status rules.
			array('data_hora_status', 'default', 'value'=>date('Y-m-d H:i:s')),

			// atribute obs rules.
			array('obs', 'length', 'max'=>200),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nome, nascimento, email, telefone, status, data_hora_status, obs', 'safe', 'on'=>'search'),
		);
	}

	public function validateNome($attribute)
	{
		$attributeValue = $this->getAttribute($attribute);
		if (!mb_strlen($attributeValue))
			return;
		// TODO: usar expressão regular para verificar se há digitos no nome.
		$words = explode(' ', $attributeValue);
		if (count($words) < 2) {
			$this->addError($attribute, 'Nome deve ter no mínimo duas palavras.');
			return;
		}
		foreach($words as $word) {
			if (mb_strlen($word) < 3) {
				$this->addError($attribute, 'Cada palavra de nome deve ter no mínimo 3 caracteres.');
				return;
			}
		}
	}

	public function validateTelefone($attribute)
	{
		$attributeValue = $this->getAttribute($attribute);
		$regPattern = '/^[+\d]+[-]{1}[\d]{1,2}[-]{1}[\d]{8,9}$/m';
		if (!preg_match_all($regPattern, $attributeValue))
			$this->addError($attribute, 'Telefone inválido. Esperado: +99-99-999999999');
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'nascimento' => 'Nascimento',
			'email' => 'Email',
			'telefone' => 'Telefone',
			'status' => 'Status',
			'data_hora_status' => 'Data Hora Status',
			'obs' => 'Obs',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('nascimento',$this->nascimento,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefone',$this->telefone,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('data_hora_status',$this->data_hora_status,true);
		$criteria->compare('obs',$this->obs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Passageiro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
