<?php

class Login extends Controller
{
    public function index(): void
    {
        $this->view('login/index');
    }

    public function verify(): void
    {
        $u = $_POST['username'] ?? '';
        $p = $_POST['password'] ?? '';

        $user = $this->model('User');

        if ($user->lockedOut($u)) {
            $_SESSION['flash'] = 'Too many failed attempts – try again in 60 s.';
            header('Location: /login'); exit;
        }

        $row = $user->authenticate($u, $p);   // now an array or null

        if ($uid = $user->authenticate($u, $p)) {   // authenticate now returns id
            $_SESSION['auth']     = 1;
            $_SESSION['uid']      = $uid;           // ← NEW: save user id for Notes
            $_SESSION['username'] = ucwords($u);
            header('Location: /home'); exit;
        }

        /* failure */
        $_SESSION['flash'] = 'Invalid credentials.';
        header('Location: /login'); exit;
    }

}
