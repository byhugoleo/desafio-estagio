<?php

/**
 * This is the model class for table "motorista".
 *
 * The followings are the available columns in table 'motorista':
 * @property string $id
 * @property string $nome
 * @property string $nascimento
 * @property string $email
 * @property string $telefone
 * @property string $placa_veiculo
 * @property string $status
 * @property string $data_hora_status
 * @property string $obs
 */
class Motorista extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'motorista';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// geral rules
			array('nome, nascimento, email, telefone, placa_veiculo', 'required'),
			array('email, telefone, placa_veiculo', 'unique'),

			// attribute nome rules.
			array('nome', 'length', 'min'=>6, 'max'=>32),
			array('nome', 'validateNome'),

			// attribute email rules.
			array('email', 'length', 'max'=>255),
			array('email', 'email'),

			// attribute telefone rules.
			array('telefone', 'length', 'min'=>14, 'max'=>16),
			array('telefone', 'validateTelefone'),

			// attribute placa_veiculo rules.
			array('placa_veiculo', 'length', 'min'=>7, 'max'=>8),
			array('placa_veiculo', 'validatePlacaVeiuculo'),

			// attribute status rules.
			array('status', 'length', 'max'=>1, 'min'=>1),

			// atribute obs rules.
			array('obs', 'length', 'max'=>200),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nome, email, telefone, placa_veiculo status', 'safe', 'on'=>'search'),
		);
	}

	public function validateNome($attribute)
	{
		$attributeValue = $this->getAttribute($attribute);
		if (!mb_strlen($attributeValue))
			return;
		$regPattern = '/[\d]+/m';
		if (preg_match($regPattern, $attributeValue)) {
			$this->addError($attribute, 'Nome não deve conter números.');
			return;
		}
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
		if (!mb_strlen($attributeValue))
			return;
		$regPattern = '/^[+][\d]{2}[-]{1}[\d]{1,2}[-]{1}[\d]{8,9}$/m';
		if (!preg_match($regPattern, $attributeValue))
			$this->addError($attribute, 'Telefone inválido. Esperado: +99-99-999999999');
	}

	public function validatePlacaVeiuculo($attribute)
	{
		$attributeValue = $this->getAttribute($attribute);
		$attributeValueSize = mb_strlen($attributeValue);
		if (!$attributeValueSize)
			return;
		if ($attributeValueSize == 7)
			$regPattern = '/^[A-Z]{3}[\d]{1}[A-Z]{1}[\d]{2}$/m';
		else if ($attributeValueSize == 8)
			$regPattern = '/^[A-Z]{3}[-]{1}[\d]{4}$/m';
		if (!preg_match($regPattern, $attributeValue))
			$this->addError($attribute, 'Placa inválida. Esperado: AAA-9999 ou AAA9A99');
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
			'placa_veiculo' => 'Placa Veiculo',
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
		// $criteria->compare('nascimento',$this->nascimento,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefone',$this->telefone,true);
		$criteria->compare('placa_veiculo',$this->placa_veiculo,true);
		$criteria->compare('status',$this->status,true);
		// $criteria->compare('data_hora_status',$this->data_hora_status,true);
		// $criteria->compare('obs',$this->obs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Motorista the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
