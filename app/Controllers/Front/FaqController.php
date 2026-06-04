<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class FaqController extends Controller
{
    private const DEFAULT_SLUG = 'general-questions';

    private const TOPIC_SLUGS = [
        'general-questions',
        'account-assistance',
        'inventory-availability',
        'vehicle-inspection',
        'buying-process',
        'payment-methods',
        'shipping',
        'after-sales-services',
        'glossary-of-terms',
    ];

    public function index(?string $slug = null): void
    {
        $slug = $this->resolveSlug($slug);

        $this->view('front/faq', [
            'initialTopic' => $slug,
        ]);
    }

    private function resolveSlug(?string $slug): string
    {
        $slug = trim((string) $slug, '/');

        if ($slug !== '' && in_array($slug, self::TOPIC_SLUGS, true)) {
            return $slug;
        }

        return self::DEFAULT_SLUG;
    }
}
