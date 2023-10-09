<?php
class Sessao
{
    private $logado = false;
    public $user_id;
    public $user_name;
    function __construct()
    {
        session_start();
        $this->verificar_login();
    }
    //função que verifica os dados de login
    private function verificar_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->user_name = $_SESSION['user_name'];
            $this->logado = true;
        } else {
            unset($this->user_id);
            // unset($this->acesso);
            $this->logado = false;
        }
    }
    //função que verifica se usuário está autenticado 
    public function esta_logado()
    {
        return $this->logado;
    }
    //função de autenticação
    public function login($usuario)
    {
        if ($usuario) {
            $_SESSION['user_id'] = $usuario['id'];
            $this->user_id = $_SESSION['user_id'];
            $_SESSION['user_name'] = $usuario['nome'];
            $this->user_name = $_SESSION['user_name'];
            $this->logado = true;
        }
    }
    //função para remover as variáveis de sessão 
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        unset($_SESSION['user_name']);
        $this->logado = false;
    }
}
//inicializamos o objecto
$sessao = new Sessao();
