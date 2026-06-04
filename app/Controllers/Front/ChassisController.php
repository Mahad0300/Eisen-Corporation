<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class ChassisController extends Controller
{
    public function index()
    {
        $makers = [
            'Toyota',
            'Nissan',
            'Honda',
            'Mazda',
            'Mitsubishi',
            'Subaru',
            'Suzuki',
            'Daihatsu',
            'Isuzu',
            'Lexus',
        ];

        $this->view('front/chassis-check', [
            'makers' => $makers,
        ]);
    }
}
