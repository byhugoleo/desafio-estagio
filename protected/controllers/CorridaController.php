<?php
class CorridaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'solicitarcorrida'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Corrida;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Corrida']))
		{
			$model->attributes=$_POST['Corrida'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Solicita uma nova corrida.
	 */
	public function actionSolicitarCorrida()
	{
		$modelCorrida = new Corrida;
		$corrida_json = json_decode(file_get_contents('php://input'));
		$corrida_headers = getallheaders();
	
		$render_json_falha = function() {
			header('Content-Type: application/json');
			echo json_encode(array(
				'sucesso'=>false, 
				'erros'=>array(
					"Nenhum motorista disponível",
					"Origem deve conter logradouro e bairro",
					"Origem e destino muito próximos"
				)
			), JSON_UNESCAPED_UNICODE);
		};

		$render_json_sucesso = function($dados) {
			header('Content-Type: application/json');
			echo json_encode($dados, JSON_UNESCAPED_UNICODE);
		};

		// Verifica json recebido
		if (!isset($corrida_json)) {
			$render_json_falha();
			return;
		}
		
		// Verifica o token
		if ($corrida_headers['token'] != (file_get_contents('protected/config/secrete.txt'))) {
			$render_json_falha();
			return;
		}

		// Verifica se passageiro existe
		$passageiro_id = $corrida_json->{'passageiro'}->{'id'};
		$passageiro_obj = Passageiro::model()->findByAttributes(array('id'=>$passageiro_id, 'status'=>'A'));
		if (!isset($passageiro_obj)) {
			$render_json_falha();
			return;
		}
		
		// Atribui passageiro
		$modelCorrida->passageiro = $passageiro_obj;
		$modelCorrida->passageiro_id = $passageiro_id;

		// Verifica se passageiro já não está em corrida
		if (Corrida::model()->findByAttributes(array('passageiro_id'=>$passageiro_id, 'status'=>'Em andamento'))) {
			$render_json_falha();
			return;
		}

		// Verifica se endereço de destino é diferente do de origem
		if ($corrida_json->{'origem'}->{'endereco'} == $corrida_json->{'destino'}->{'endereco'}) {
			$render_json_falha();
			return;
		}
		$origem_lat = number_format($corrida_json->{'origem'}->{'lat'}, 4, '.', '');
		$origem_lng = number_format($corrida_json->{'origem'}->{'lng'}, 4, '.', '');
		$destino_lat = number_format($corrida_json->{'destino'}->{'lat'}, 4, '.', '');
		$destino_lng = number_format($corrida_json->{'destino'}->{'lng'}, 4, '.', '');
		if ($origem_lat != $destino_lat && $origem_lng != $origem_lng) {
			$render_json_falha();
			return;
		}
		
		// Atribui atributos relacionado a endereço
		$modelCorrida->origem_endereco = $corrida_json->{'origem'}->{'endereco'};
		$modelCorrida->origem_lat = $origem_lat;
		$modelCorrida->origem_lng = $origem_lng;
		$modelCorrida->destino_endereco = $corrida_json->{'destino'}->{'endereco'};
		$modelCorrida->destino_lat = $destino_lat;
		$modelCorrida->destino_lng = $destino_lng;

		// Calcula distancia entre origem e destino em linha reta
		// distância(A, B) = R * acos(sin(latA) * sin(latB) + cos(latA) * cos(latB) * cos(lngA-lngB))
		$R = 6372.795477598;
		$origem_lat *= M_PI / 180;
		$origem_lng *= M_PI / 180;
		$destino_lat *= M_PI / 180;
		$destino_lng *= M_PI / 180;
		$distanciaOrigemDestino = number_format($R * acos(
			sin($origem_lat)
			* sin($destino_lat)
			+ cos($origem_lat)
			* cos($destino_lat)
			* cos($origem_lng - $destino_lng)
		), 4, '.', '');
		
		// Verifica se distancia não é menor ou igual a 100 metros
		if ((float)$distanciaOrigemDestino <= 0.100) {
			$render_json_falha();
			return;
		}

		// Verifica os motoristas ativos
		$motoristas_obj = Motorista::model()->findAllByAttributes(array('status'=>'A'));
		if (!isset($motoristas_obj)) {
			$render_json_falha();
			return;
		}
		
		// Verifica qual motorista está livre
		$motoristaEscolhido = null;
		foreach ($motoristas_obj as $motorista_obj) {
			if (!Corrida::model()->findByAttributes(array('motorista_id'=>$motorista_obj['id'], 'status'=>'Em andamento'))) {
				$motoristaEscolhido = $motorista_obj;
				break;
			}
		}

		// Atribui motorista caso tiver
		$modelCorrida->motorista = $motoristaEscolhido;
		$modelCorrida->motorista_id = isset($motoristaEscolhido) ? $motoristaEscolhido['id'] : null;

		// Atribui status
		$modelCorrida->status = isset($motoristaEscolhido) ? 'Em andamento' : 'Não Atendida';

		// Atribui data e hora de início e previsão de chegada
		if (isset($motoristaEscolhido)) {
			date_default_timezone_set('America/Sao_Paulo');
			$modelCorrida->data_hora_incio = date('Y-m-d H:i');
			$duracaoCorrida = number_format($distanciaOrigemDestino / 0.2 + 3, 0, '.', '');
			$tempoPrevisao = new DateInterval('PT' . $duracaoCorrida . 'M');
			$modelCorrida->previsao_chegada = (new DateTime($modelCorrida->data_hora_incio))->add($tempoPrevisao)->format('Y-m-d H:i');
			
			// Verifica corrida se tem duração maior que 8 horas.
			if (($duracaoCorrida / 60) > 8) {
				$render_json_falha();
				return;
			}

			// Atribui tarifa
			$tarifa = 2 * $distanciaOrigemDestino + 0.5 * $duracaoCorrida + 5;
			$modelCorrida->tarifa = $tarifa;
		}

		if($modelCorrida->save()) {
			if (isset($motoristaEscolhido)) {
				$render_json_sucesso(array(
					'sucesso'=>true,
					'corrida'=>array(
						'id'=>$modelCorrida->id, 
						'previsao_chegada_destino'=>$modelCorrida->previsao_chegada
					),
					'motorista'=>array(
						'nome'=>$motoristaEscolhido['nome'],
						'placa'=>$motoristaEscolhido['placa_veiculo'],
						'quantidade_corridas'=>count($modelCorrida->findAllByPk($motoristaEscolhido['id']))
					)
				));
				return;
			}
		}
		$render_json_falha();
		Yii::app()->end();
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Corrida']))
		{
			$model->attributes=$_POST['Corrida'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Corrida');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Corrida('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Corrida']))
			$model->attributes=$_GET['Corrida'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Corrida the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Corrida::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Corrida $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='corrida-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
