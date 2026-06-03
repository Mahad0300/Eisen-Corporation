<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $channels = [
            [
                'title' => 'Export desk',
                'text' => 'Auction sourcing, vehicle inquiries, and shipping quotes.',
                'email' => 'export@eisen-corp.com',
                'phone' => '+81 45-000-0000',
                'titleKey' => 'contact.channel.export.title',
                'textKey' => 'contact.channel.export.text',
            ],
            [
                'title' => 'Dealer partnerships',
                'text' => 'Volume sourcing, dealer accounts, and wholesale support.',
                'email' => 'dealers@eisen-corp.com',
                'phone' => '+81 45-000-0001',
                'titleKey' => 'contact.channel.dealer.title',
                'textKey' => 'contact.channel.dealer.text',
            ],
        ];

        $subjects = [
            ['value' => 'general', 'label' => 'General inquiry', 'key' => 'contact.subject.general'],
            ['value' => 'auction', 'label' => 'Japan auction sourcing', 'key' => 'contact.subject.auction'],
            ['value' => 'shipping', 'label' => 'Shipping & logistics', 'key' => 'contact.subject.shipping'],
            ['value' => 'dealer', 'label' => 'Dealer partnership', 'key' => 'contact.subject.dealer'],
        ];

        $this->view('front/contact', [
            'channels' => $channels,
            'subjects' => $subjects,
        ]);
    }
}
