<?php
class Session
{
    private $signIn;
    public $user_id;

    public function __construct()
    {
        session_start();
        $this->check_the_login();
    }

    private function check_the_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signIn = true;
        } else {
            unset($this->user_id);
            $this->signIn = false;
        }
    }
}

$sesssion = new Session();