<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class AboutController extends Controller {
    public function index() {
        $stats = [
            ['target' => 15, 'suffix' => '+', 'label' => 'Years in export', 'key' => 'about.stat.years'],
            ['target' => 926, 'suffix' => '+', 'label' => 'Auction listings', 'key' => 'about.stat.listings'],
            ['target' => 40, 'suffix' => '+', 'label' => 'Countries served', 'key' => 'about.stat.countries'],
            ['target' => 1280, 'suffix' => '+', 'label' => 'Vehicles exported', 'key' => 'about.stat.exported', 'comma' => true],
        ];

        $services = [
            [
                'title' => 'Japan auction sourcing',
                'text' => 'Direct access to USS, TAA, and partner lanes with grade-verified stock for dealers and private buyers.',
                'titleKey' => 'about.service.auction.title',
                'textKey' => 'about.service.auction.text',
            ],
            [
                'title' => 'Pre-export inspection',
                'text' => 'Condition reports, photo documentation, and sheet translation before vehicles leave Japan.',
                'titleKey' => 'about.service.inspection.title',
                'textKey' => 'about.service.inspection.text',
            ],
            [
                'title' => 'Global logistics',
                'text' => 'RoRo and container shipping coordinated from major ports with clear timelines and tracking.',
                'titleKey' => 'about.service.logistics.title',
                'textKey' => 'about.service.logistics.text',
            ],
            [
                'title' => 'Dealer & private support',
                'text' => 'Volume sourcing for dealers and guided purchasing for first-time importers worldwide.',
                'titleKey' => 'about.service.support.title',
                'textKey' => 'about.service.support.text',
            ],
        ];

        $this->view('front/about', [
            'stats' => $stats,
            'services' => $services,
        ]);
    }
}
