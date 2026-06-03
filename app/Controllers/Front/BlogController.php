<?php
namespace App\Controllers\Front;

use App\Core\Controller;

class BlogController extends Controller {
    public function index() {
        $posts = $this->getPosts();
        $categories = $this->getCategories();

        $featured = null;
        foreach ($posts as $post) {
            if (!empty($post['featured'])) {
                $featured = $post;
                break;
            }
        }

        $gridPosts = array_values(array_filter($posts, function ($post) {
            return empty($post['featured']);
        }));

        $this->view('front/blog', [
            'posts' => $posts,
            'gridPosts' => $gridPosts,
            'featured' => $featured,
            'categories' => $categories,
        ]);
    }

    public function show($slug) {
        $posts = $this->getPosts();
        $post = null;

        foreach ($posts as $item) {
            if ($item['slug'] === $slug) {
                $post = $item;
                break;
            }
        }

        if (!$post) {
            http_response_code(404);
            echo '<h1>404 Not Found</h1><p>Article not found. <a href="' . BASE_URL . '/blog">Back to blog</a></p>';
            exit;
        }

        $post['body'] = $this->getArticleBody($post);
        $related = $this->getRelatedPosts($posts, $post, 3);

        $this->view('front/blog-detail', [
            'post' => $post,
            'related' => $related,
        ]);
    }

    private function getRelatedPosts(array $posts, array $current, int $limit): array {
        $related = [];

        foreach ($posts as $post) {
            if ($post['slug'] === $current['slug']) {
                continue;
            }
            if ($post['categoryKey'] === $current['categoryKey']) {
                $related[] = $post;
            }
        }

        if (count($related) < $limit) {
            foreach ($posts as $post) {
                if ($post['slug'] === $current['slug']) {
                    continue;
                }
                if ($post['categoryKey'] !== $current['categoryKey']) {
                    $related[] = $post;
                }
                if (count($related) >= $limit) {
                    break;
                }
            }
        }

        return array_slice($related, 0, $limit);
    }

    private function getArticleBody(array $post): array {
        $bodies = [
            'read-uss-auction-sheet' => [
                ['type' => 'p', 'text' => 'Every vehicle listed at USS Tokyo, TAA, and other major Japan auction houses ships with a standardized inspection sheet. For importers, that sheet is your first filter — long before you calculate freight or customs.'],
                ['type' => 'h2', 'text' => 'Understanding the grade score'],
                ['type' => 'p', 'text' => 'The overall grade (typically 3.5 to 5 for passenger cars) reflects cosmetic and structural condition at auction time. A 4.5 grade usually means light wear; below 4.0 warrants closer review of panel notes and underbody photos.'],
                ['type' => 'ul', 'items' => [
                    'Grade 5 / 4.5 — Excellent to good cosmetic condition',
                    'Grade 4 / 3.5 — Visible wear, check repair history',
                    'Grade R — Repaired vehicle; verify work quality',
                    'Grade *** — Accident history flagged on sheet',
                ]],
                ['type' => 'tip', 'title' => 'Pro tip for importers', 'text' => 'Always cross-check the auction sheet with USS live photos and Eisen\'s pre-export inspection report before confirming a bid.'],
                ['type' => 'h2', 'text' => 'Inspector notes and chassis codes'],
                ['type' => 'p', 'text' => 'Handwritten or stamped notes highlight rust, panel replacement, interior stains, and odometer verification. Match the chassis number on the sheet to export documents — mismatches delay clearance at destination ports.'],
                ['type' => 'p', 'text' => 'When you shortlist stock through Eisen, our team translates key sheet fields and flags vehicles that fit your market — saving hours of manual review across hundreds of weekly listings.'],
            ],
        ];

        if (isset($bodies[$post['slug']])) {
            return $bodies[$post['slug']];
        }

        return [
            ['type' => 'p', 'text' => $post['excerpt']],
            ['type' => 'h2', 'text' => 'Key takeaways for importers'],
            ['type' => 'p', 'text' => 'Japan auction sourcing rewards preparation. Review condition reports, confirm export documentation early, and align your bid with landed cost — not just hammer price at the lane.'],
            ['type' => 'ul', 'items' => [
                'Verify auction grade and inspector notes before bidding',
                'Plan shipping method and port timelines in advance',
                'Factor currency conversion and local compliance into budget',
                'Work with a partner who documents every handover step',
            ]],
            ['type' => 'tip', 'title' => 'Need help sourcing?', 'text' => 'Eisen supports dealers and private buyers from auction selection through export logistics. Browse current inventory or contact our team for a tailored sourcing plan.'],
            ['type' => 'p', 'text' => 'This article is part of our Insights series — practical guidance for anyone importing vehicles from Japan\'s wholesale auction network.'],
        ];
    }

    private function getCategories(): array {
        return [
            ['key' => 'all', 'label' => 'All topics'],
            ['key' => 'auctions', 'label' => 'Japan Auctions'],
            ['key' => 'export', 'label' => 'Import & Export'],
            ['key' => 'guides', 'label' => 'Buying Guides'],
            ['key' => 'market', 'label' => 'Market & Pricing'],
            ['key' => 'spotlights', 'label' => 'Vehicle Spotlights'],
            ['key' => 'company', 'label' => 'Company'],
        ];
    }

    private function getPosts(): array {
        return [
            [
                'slug' => 'read-uss-auction-sheet',
                'title' => 'How to Read a USS Auction Sheet Before You Bid',
                'category' => 'Japan Auctions',
                'categoryKey' => 'auctions',
                'date' => '2025-05-12',
                'dateLabel' => 'May 12, 2025',
                'readMin' => 8,
                'excerpt' => 'Learn what auction grades, inspector notes, and chassis codes mean so you can shortlist vehicles with confidence before export.',
                'image' => 'photo-1618843479313-40f8afb4b4d8',
                'featured' => true,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'jpy-usd-import-budget',
                'title' => 'How JPY–USD Moves Affect Your Import Budget',
                'category' => 'Market & Pricing',
                'categoryKey' => 'market',
                'date' => '2025-05-02',
                'dateLabel' => 'May 2, 2025',
                'readMin' => 6,
                'excerpt' => 'A practical guide for dealers tracking yen volatility, landed cost, and when to lock in conversion for Japan auction purchases.',
                'image' => 'photo-1553440569-bcc63803a83d',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'first-time-japan-import-checklist',
                'title' => 'First-Time Japan Import Checklist for Private Buyers',
                'category' => 'Buying Guides',
                'categoryKey' => 'guides',
                'date' => '2025-04-18',
                'dateLabel' => 'April 18, 2025',
                'readMin' => 10,
                'excerpt' => 'From auction selection to port arrival — documents, inspection, and timelines importers should plan before placing a bid.',
                'image' => 'photo-1606664515524-ed2f786a0bd6',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'export-shipping-timelines',
                'title' => 'Export Shipping Timelines: RoRo vs Container Explained',
                'category' => 'Import & Export',
                'categoryKey' => 'export',
                'date' => '2025-04-05',
                'dateLabel' => 'April 5, 2025',
                'readMin' => 7,
                'excerpt' => 'Compare roll-on roll-off and container options, typical port schedules, and how Eisen coordinates logistics for global buyers.',
                'image' => 'photo-1549317661-bd32c8ce0db2',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'hybrid-suv-demand-2025',
                'title' => 'Why Hybrid SUVs Dominate Japan Auction Demand in 2025',
                'category' => 'Vehicle Spotlights',
                'categoryKey' => 'spotlights',
                'date' => '2025-03-22',
                'dateLabel' => 'March 22, 2025',
                'readMin' => 5,
                'excerpt' => 'Market trends behind Toyota and Honda hybrid stock — resale appeal, grade availability, and what dealers are stocking overseas.',
                'image' => 'photo-1503376780353-7e6692767b70',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'dealer-vs-private-auction',
                'title' => 'Dealer vs Private Buyer: Choosing the Right Auction Lane',
                'category' => 'Buying Guides',
                'categoryKey' => 'guides',
                'date' => '2025-03-08',
                'dateLabel' => 'March 8, 2025',
                'readMin' => 6,
                'excerpt' => 'Understand lane access, fees, and volume advantages so your sourcing strategy matches your business model.',
                'image' => 'photo-1552519507-da3b142c6e3d',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'eisen-inspection-process',
                'title' => 'Inside Eisen\'s Pre-Export Inspection Process',
                'category' => 'Company',
                'categoryKey' => 'company',
                'date' => '2025-02-14',
                'dateLabel' => 'February 14, 2025',
                'readMin' => 5,
                'excerpt' => 'How our team verifies auction listings, documents condition reports, and prepares vehicles for international handover.',
                'image' => 'photo-1555215695-3004980ad54e',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'grade-r-repair-history',
                'title' => 'Grade R and Repair History: What Importers Should Know',
                'category' => 'Japan Auctions',
                'categoryKey' => 'auctions',
                'date' => '2025-01-30',
                'dateLabel' => 'January 30, 2025',
                'readMin' => 9,
                'excerpt' => 'When a repaired auction vehicle is worth considering, red flags on sheets, and how to price refurbishment into landed cost.',
                'image' => 'photo-1519641471654-76ce0107ad1b',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
            [
                'slug' => 'winter-auction-season-tips',
                'title' => 'Winter Auction Season: Bidding Tips for Snow-Belt Stock',
                'category' => 'Japan Auctions',
                'categoryKey' => 'auctions',
                'date' => '2025-01-12',
                'dateLabel' => 'January 12, 2025',
                'readMin' => 4,
                'excerpt' => 'Seasonal supply shifts, underbody rust checks, and models that hold value when sourced from northern Japan auctions.',
                'image' => 'photo-1492144534655-ae79c964c9d7',
                'featured' => false,
                'author' => 'Eisen Export Team',
            ],
        ];
    }
}
