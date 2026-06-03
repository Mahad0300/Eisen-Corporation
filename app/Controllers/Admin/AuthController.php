<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;

class AuthController extends Controller {
    
    public function showLoginForm() {
        // Render the login view. Extract flash if any.
        $flash = Session::getFlash();
        $this->view('admin/login', [
            'flash' => $flash
        ]);
    }

    public function login() {
        // In the UI prototyping phase, we accept any credentials
        // Set mock admin session
        Session::set('is_logged_in', true);
        Session::set('user_role', 'admin');
        Session::set('user_name', 'Eisen Admin');
        Session::set('user_email', 'admin@eisen.com');

        // Redirect to admin dashboard
        $this->redirect('/admin');
    }

    public function logout() {
        Session::destroy();
        $this->redirect('/admin/login');
    }
}
