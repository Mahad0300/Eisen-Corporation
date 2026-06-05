<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Database;

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
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            Session::setFlash('error', 'Please fill in all fields.');
            $this->redirect('/admin/login');
            return;
        }

        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if (!$user || !password_verify($password, $user['password'])) {
                Session::setFlash('error', 'Invalid email or password.');
                $this->redirect('/admin/login');
                return;
            }

            // Verify if user has an administrative/staff role
            if (!in_array($user['role'], ['admin', 'finance_officer', 'caller_agent'])) {
                Session::setFlash('error', 'Access denied. Unauthorized area.');
                $this->redirect('/admin/login');
                return;
            }

            Session::set('is_logged_in', true);
            Session::set('user_role', $user['role']);
            Session::set('user_name', $user['name']);
            Session::set('user_email', $user['email']);

            $this->redirect('/admin');
        } catch (\Exception $e) {
            Session::setFlash('error', 'An error occurred during sign in: ' . $e->getMessage());
            $this->redirect('/admin/login');
        }
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
