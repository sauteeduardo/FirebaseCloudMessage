<?php


//extende do codeigniter.
class Notificacao_Model extends CI_Model {

    private $api_key = "";

    public function __construct(){
    //chama a lib
        $this->load->library("fcm");

    }

    public function set($property,$value){

        $this->{$property} = $value;

    }

    public function topico($topico,$notification = [],$data = []){

        $this->fcm = new FCM(FCM::CONTENT_JSON, 60*60*24*5, null);

        $this->fcm->set([

            "api_key" => $this->api_key,

            "url" => "https://fcm.googleapis.com/fcm/send"

        ]);

        $this->fcm->headers();

        $this->fcm->message = [

            "to" => "/topics/".$topico,

            "notification" => $notification

            "data" => $data

        ];

        return $this->fcm->send();

    }

}
