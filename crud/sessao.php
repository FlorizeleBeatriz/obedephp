<?php
class Sessao {
    public static function iniciar() {
        session_start();
    }

    public static function encerrar() {
        session_destroy();
    }

    public static function logado() {
        return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
    }

    public static function definirUsuario($user_id, $user_name) {
        $_SESSION['logado'] = true;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
    }

    public static function getUsuarioID() {
        return $_SESSION['user_id'];
    }

    public static function getUsuarioNome() {
        return $_SESSION['user_name'];
    }
}

