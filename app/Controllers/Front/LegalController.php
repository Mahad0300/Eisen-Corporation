<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class LegalController extends Controller
{
    public function privacy()
    {
        $this->view('front/privacy-policy');
    }

    public function terms()
    {
        $this->view('front/terms-and-condition');
    }
}
