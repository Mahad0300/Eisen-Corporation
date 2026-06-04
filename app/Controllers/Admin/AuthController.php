<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;

class AuthController extends Controller {
    
    public function showLoginForm() {
        $flash = Session::getFlash();
        $activeTab = ($_GET['tab'] ?? '') === 'signup' ? 'signup' : 'login';

        $this->view('admin/login', [
            'flash' => $flash,
            'activeTab' => $activeTab,
        ]);
    }

    public function login() {
        Session::set('is_logged_in', true);
        Session::set('user_role', 'admin');
        Session::set('user_name', 'Eisen Admin');
        Session::set('user_email', trim($_POST['email'] ?? 'admin@eisen.com'));

        $this->redirect('/admin');
    }

    public function signup() {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            Session::setFlash('error', 'Please fill in all required fields.');
            $this->redirect('/admin/login?tab=signup');
            return;
        }

        if ($password !== $passwordConfirm) {
            Session::setFlash('error', 'Passwords do not match.');
            $this->redirect('/admin/login?tab=signup');
            return;
        }

        Session::set('is_logged_in', true);
        Session::set('user_role', 'user');
        Session::set('user_name', $name);
        Session::set('user_email', $email);

        $this->redirect('/admin');
    }

    public function googleLogin() {
        Session::set('is_logged_in', true);
        Session::set('user_role', 'user');
        Session::set('user_name', 'Google User');
        Session::set('user_email', 'user@gmail.com');

        $this->redirect('/admin');
    }

    public function showForgotPasswordForm() {
        $flash = Session::getFlash();
        $this->view('admin/forgot-password', [
            'flash' => $flash,
        ]);
    }

    public function sendForgotPassword() {
        $email = trim($_POST['email'] ?? '');

        if ($email === '') {
            Session::setFlash('error', 'Please enter your email address.');
            $this->redirect('/admin/forgot-password');
            return;
        }

        Session::setFlash('success', 'If an account exists for that email, a reset link has been sent.');
        $this->redirect('/admin/forgot-password');
    }

    public function logout() {
        Session::destroy();
        $this->redirect('/admin/login');
    }
}
