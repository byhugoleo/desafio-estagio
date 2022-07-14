<?php

/**
 * This is the model class for table "corrida".
 *
 * The followings are the available columns in table 'corrida':
 * @property string $id
 * @property string $origem_endereco
 * @property string $origem_lat
 * @property string $origem_lng
 * @property string $destino_endereco
 * @property string $destino_lat
 * @property string $destino_lng
 * @property string $data_hora_incio
 * @property string $status
 * @property string $previsao_chegada
 * @property string $tarifa
 * @property string $data_hora_finalizacao
 *
 * The followings are the available model relations:
 * @property Passageiro $passageiro_id
 * @property Motorista $motorista_id
 */
class Corrida extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'corrida';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('origem_endereco, origem_lat, origem_lng, destino_endereco, destino_lat, destino_lng, status', 'required'),
			array('origem_endereco, destino_endereco', 'length', 'max'=>255),
			array('origem_lat, origem_lng, destino_lat, destino_lng, tarifa', 'length', 'max'=>10),
			array('status', 'length', 'max'=>12),
			array('data_hora_incio, previsao_chegada, data_hora_finalizacao', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, origem_endereco, origem_lat, origem_lng, destino_endereco, destino_lat, destino_lng, data_hora_incio, status, previsao_chegada, tarifa, data_hora_finalizacao', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'passageiro_id' => array(self::BELONGS_TO, 'Passageiro', 'id'),
			'motorista_id' => array(self::BELONGS_TO, 'Motrista', 'id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'origem_endereco' => 'Origem Endereco',
			'origem_lat' => 'Origem Lat',
			'origem_lng' => 'Origem Lng',
			'destino_endereco' => 'Destino Endereco',
			'destino_lat' => 'Destino Lat',
			'destino_lng' => 'Destino Lng',
			'data_hora_incio' => 'Data Hora Incio',
			'status' => 'Status',
			'previsao_chegada' => 'Previsao Chegada',
			'tarifa' => 'Tarifa',
			'data_hora_finalizacao' => 'Data Hora Finalizacao',
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
		$criteria->compare('origem_endereco',$this->origem_endereco,true);
		$criteria->compare('origem_lat',$this->origem_lat,true);
		$criteria->compare('origem_lng',$this->origem_lng,true);
		$criteria->compare('destino_endereco',$this->destino_endereco,true);
		$criteria->compare('destino_lat',$this->destino_lat,true);
		$criteria->compare('destino_lng',$this->destino_lng,true);
		$criteria->compare('data_hora_incio',$this->data_hora_incio,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('previsao_chegada',$this->previsao_chegada,true);
		$criteria->compare('tarifa',$this->tarifa,true);
		$criteria->compare('data_hora_finalizacao',$this->data_hora_finalizacao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Corrida the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
