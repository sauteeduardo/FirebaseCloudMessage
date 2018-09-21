//tem que ter no root do projeto o FCM 
public function notificacao($codigo,$notification_body,$data){

	if($codigo > 0){


		if(isset($data->can_firebase_api_key && !empty(data->can_firebase_api_key)){


			$parametros = [

				"username" => "empresa",

				"password" => "empresa.123",

				"codigo_user" => $_SESSION['codigo_user'],

				"codigo" => $codigo,

				"tip_codigo" => 1,

				"lik_dispositivo_uuid" => "",

				"pagina" => 1

			];



			$notification = [

				"title" => $_SESSION["nome"],

				"body" => $notification_body

			];
			$dataArray = ["modulo" => "tela1", "dados" => $data;

			$tamanho_json = strlen(json_encode($dataArray));

			if($tamanho_json > 4096){

				$dataArray["dados"] = ["codigo" => $codigo];

			}
    //chama o fcm do index(neste caso não vai ter, é somente implementação de envio)
			$this->fcm = new FCM(FCM::CONTENT_JSON, 60*60*24*5, null);

			$this->fcm->set([

				"api_key" => $data->can_firebase_api_key,

				"url" => "https://fcm.googleapis.com/fcm/send"

			]);

			$this->fcm->headers();

			$this->fcm->message = [

				"to" => "/topics/".$codigo.".news",

				"notification" => $notification,

				"data" => $dataArray

			];

			return $this->fcm->send();

			


		}

	}

}

public function sendTest(){
  $newObj = array("can_firebase_api_key=>"ad0a8duj09jkempokwdpok","Texto"=>"test");
  $notificationBody = "teste,teste AAAAAAAAAA";
  //converte pra stdClass();
  $resultado_notificacao = $this->notificacao(1,$notification_body,(object)$newObj);
}
