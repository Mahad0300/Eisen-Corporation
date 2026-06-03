(function () {
  "use strict";

  const messages = {
    en: {
      "page.title": "Eisen Corporation | Premium Auto Dealership",
      "page.description":
        "Eisen Corporation — premium imported vehicles, auction-grade stock, and expert export services.",
      "skip": "Skip to content",
      "locale.language": "Language",
      "locale.currency": "Currency",
      "nav.home": "Home",
      "nav.about": "About Us",
      "nav.blog": "Blog",
      "nav.news": "News",
      "nav.sellers": "For Sellers",
      "nav.contacts": "Contacts",
      "nav.menu": "Menu",
      "search.aria": "Site search",
      "search.label": "Search on site",
      "search.placeholder": "Search On Site",
      "search.btn": "search",
      "hero.aria": "Featured vehicles and search",
      "spec.mileage": "Mileage",
      "spec.engine": "Engine",
      "spec.price": "Price",
      "slider.slides": "Featured slides",
      "slider.prev": "Previous slide",
      "slider.next": "Next slide",
      "slider.slide": "Slide",
      "filter.title": "Search Auto",
      "filter.manufacturer": "Manufacturer",
      "filter.model": "Model",
      "filter.yearFrom": "Year from",
      "filter.yearTo": "Year to",
      "filter.priceFrom": "Price from",
      "filter.priceTo": "Price to",
      "filter.mileageFrom": "Mileage from",
      "filter.mileageTo": "Mileage to",
      "filter.newOnly": "Only new cars",
      "filter.submit": "Search",
      "filter.allManufacturers": "All manufacturers",
      "filter.allModels": "All models",
      "filter.any": "Any",
      "filter.sedan": "Sedan",
      "filter.suv": "SUV",
      "filter.hatchback": "Hatchback",
      "filter.hybrid": "Hybrid",
      "listings.title": "Recent Listings",
      "listings.viewAll": "View all inventory",
      "cta.buy.title": "Looking for a car?",
      "cta.buy.text": "1000 new offers everyday 35,000 car offers on site",
      "cta.buy.btn": "Search",
      "cta.sell.title": "Want to sell a car?",
      "cta.sell.text": "200000 visitors everyday. Add your offer now",
      "cta.sell.btn": "Sell",
      "blog.title": "Recent from the blog",
      "blog.viewAll": "View all blog",
      "blog.card.title": "The importance of luxury SUV sales expand",
      "blog.card.date": "September, 16, 2020",
      "blog.excerpt1":
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
      "blog.excerpt2":
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco.",
      "blog.excerpt3":
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate velit.",
      "directory.aria": "Directory",
      "directory.dealers": "Dealers",
      "directory.service": "Service Stations",
      "directory.insurance": "Insurance",
      "directory.countDealers": "Found 454 dealers",
      "directory.countService": "Found 128 service stations",
      "directory.countInsurance": "Found 86 insurance partners",
      "sidebar.title": "Auto news",
      "sidebar.allNews": "All news",
      "news.title": "Unofficial Porsche 918 Spyder pricing pops up",
      "news.date": "September, 16, 2020",
      "news.excerpt1":
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus error.",
      "news.excerpt2":
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nemo enim ipsam voluptatem quia voluptas sit.",
      "video.title": "Video Review",
      "video.viewAll": "View all Reviews",
      "video.card.title": "The importance of luxury SUV sales explained",
      "video.meta1": "10 min 32 sec (12.4 Mb)",
      "video.meta2": "8 min 15 sec (9.8 Mb)",
      "video.meta3": "12 min 05 sec (14.2 Mb)",
      "newsletter.title": "Get Daily News",
      "newsletter.email": "Email address",
      "newsletter.placeholder": "Enter Your Email",
      "newsletter.subscribe": "Subscribe",
      "urgent.label": "Urgent car purchase",
      "footer.tagline":
        "Premium imported vehicles from Japan auctions. Inspection, logistics, and worldwide export for dealers and private buyers.",
      "footer.quickLinks": "Quick Links",
      "footer.services": "Our Services",
      "footer.contact": "Contact Us",
      "footer.hoursTitle": "Business hours",
      "footer.hoursLine1": "Lorem – Ipsum: 00:00 – 00:00",
      "footer.hoursLine2": "Dolor: Sit amet consectetur",
      "footer.copy": "Eisen Corporation. All rights reserved.",
      "footer.privacy": "Privacy Policy",
      "footer.terms": "Terms of Use",
      "footer.sitemap": "Sitemap",
      "footer.home": "Home",
      "footer.about": "About Us",
      "footer.blog": "Blog",
      "footer.news": "News",
      "footer.inventory": "Inventory",
      "footer.contacts": "Contacts",
      "footer.listings": "Vehicle Listings",
      "footer.auction": "Japan Auction Sourcing",
      "footer.dealerDir": "Dealer Directory",
      "footer.serviceIns": "Service & Insurance",
      "footer.videoReviews": "Video Reviews",
      "footer.urgent": "Urgent Purchase",
    },
    ja: {
      "page.title": "アイゼン株式会社 | プレミアム自動車販売",
      "page.description":
        "アイゼン株式会社 — 日本オークションからの輸入車、厳選在庫、輸出サポート。",
      "skip": "コンテンツへスキップ",
      "locale.language": "言語",
      "locale.currency": "通貨",
      "nav.home": "ホーム",
      "nav.about": "会社概要",
      "nav.blog": "ブログ",
      "nav.news": "ニュース",
      "nav.sellers": "出品者向け",
      "nav.contacts": "お問い合わせ",
      "nav.menu": "メニュー",
      "search.aria": "サイト内検索",
      "search.label": "サイト内検索",
      "search.placeholder": "サイト内を検索",
      "search.btn": "検索",
      "hero.aria": "注目車両と検索",
      "spec.mileage": "走行距離",
      "spec.engine": "エンジン",
      "spec.price": "価格",
      "slider.slides": "注目スライド",
      "slider.prev": "前のスライド",
      "slider.next": "次のスライド",
      "slider.slide": "スライド",
      "filter.title": "車両検索",
      "filter.manufacturer": "メーカー",
      "filter.model": "モデル",
      "filter.yearFrom": "年式（から）",
      "filter.yearTo": "年式（まで）",
      "filter.priceFrom": "価格（から）",
      "filter.priceTo": "価格（まで）",
      "filter.mileageFrom": "走行距離（から）",
      "filter.mileageTo": "走行距離（まで）",
      "filter.newOnly": "新車のみ",
      "filter.submit": "検索",
      "filter.allManufacturers": "すべてのメーカー",
      "filter.allModels": "すべてのモデル",
      "filter.any": "指定なし",
      "filter.sedan": "セダン",
      "filter.suv": "SUV",
      "filter.hatchback": "ハッチバック",
      "filter.hybrid": "ハイブリッド",
      "listings.title": "最新出品",
      "listings.viewAll": "すべての在庫を見る",
      "cta.buy.title": "お探しの車はありますか？",
      "cta.buy.text": "毎日1000件の新着、サイトに35,000台の出品",
      "cta.buy.btn": "検索",
      "cta.sell.title": "車を売りたいですか？",
      "cta.sell.text": "毎日20万人の訪問者。今すぐ出品を追加",
      "cta.sell.btn": "出品",
      "blog.title": "ブログ最新記事",
      "blog.viewAll": "ブログ一覧",
      "blog.card.title": "高級SUV販売拡大の重要性",
      "blog.card.date": "2020年9月16日",
      "blog.excerpt1":
        "高級SUV市場は世界的に拡大しており、日本からの輸入需要も高まっています。在庫選定と価格設定が販売成功の鍵となります。",
      "blog.excerpt2":
        "ディーラー向けに、オークション落札から納車までの流れを整理しました。書類・検査・物流の各段階で注意すべき点を解説します。",
      "blog.excerpt3":
        "新規モデルの需要予測と中古価格の推移を比較し、今後数四半期の販売戦略に役立つポイントをまとめました。",
      "directory.aria": "ディレクトリ",
      "directory.dealers": "ディーラー",
      "directory.service": "サービスステーション",
      "directory.insurance": "保険",
      "directory.countDealers": "454件のディーラーが見つかりました",
      "directory.countService": "128件のサービスステーションが見つかりました",
      "directory.countInsurance": "86件の保険パートナーが見つかりました",
      "sidebar.title": "自動車ニュース",
      "sidebar.allNews": "すべてのニュース",
      "news.title": "非公式ポルシェ918スパイダー価格が流出",
      "news.date": "2020年9月16日",
      "news.excerpt1":
        "欧州メディアで報じられた想定価格は、従来のスーパーカー相場を大きく上回る水準です。正式発表まで慎重な見方が続いています。",
      "news.excerpt2":
        "限定生産モデルの二次流通では、走行距離と整備履歴が価格に直結します。買い手は鑑定レポートの確認が不可欠です。",
      "video.title": "動画レビュー",
      "video.viewAll": "すべてのレビュー",
      "video.card.title": "高級SUV販売の重要性を解説",
      "video.meta1": "10分32秒（12.4 MB）",
      "video.meta2": "8分15秒（9.8 MB）",
      "video.meta3": "12分05秒（14.2 MB）",
      "newsletter.title": "毎日のニュースを受け取る",
      "newsletter.email": "メールアドレス",
      "newsletter.placeholder": "メールアドレスを入力",
      "newsletter.subscribe": "登録",
      "urgent.label": "緊急車両購入",
      "footer.tagline":
        "日本オークションからのプレミアム輸入車。検査、物流、世界中への輸出をディーラー・個人のお客様に。",
      "footer.quickLinks": "クイックリンク",
      "footer.services": "サービス",
      "footer.contact": "お問い合わせ",
      "footer.hoursTitle": "営業時間",
      "footer.hoursLine1": "平日: 00:00 – 00:00",
      "footer.hoursLine2": "土日: 要お問い合わせ",
      "footer.copy": "アイゼン株式会社。無断転載を禁じます。",
      "footer.privacy": "プライバシーポリシー",
      "footer.terms": "利用規約",
      "footer.sitemap": "サイトマップ",
      "footer.home": "ホーム",
      "footer.about": "会社概要",
      "footer.blog": "ブログ",
      "footer.news": "ニュース",
      "footer.inventory": "在庫",
      "footer.contacts": "お問い合わせ",
      "footer.listings": "車両一覧",
      "footer.auction": "日本オークション調達",
      "footer.dealerDir": "ディーラー一覧",
      "footer.serviceIns": "サービス・保険",
      "footer.videoReviews": "動画レビュー",
      "footer.urgent": "緊急購入",
    },
  };

  function t(key, lang) {
    const pack = messages[lang] || messages.en;
    return pack[key] ?? messages.en[key] ?? key;
  }

  function apply(lang) {
    const code = lang === "ja" ? "ja" : "en";
    document.documentElement.lang = code;

    document.title = t("page.title", code);
    const metaDesc = document.querySelector('meta[name="description"]');
    if (metaDesc) metaDesc.setAttribute("content", t("page.description", code));

    document.querySelectorAll("[data-i18n]").forEach((el) => {
      const key = el.getAttribute("data-i18n");
      if (!key) return;
      const value = t(key, code);
      if (el.hasAttribute("data-i18n-html")) {
        el.innerHTML = value;
      } else {
        el.textContent = value;
      }
    });

    document.querySelectorAll("[data-i18n-placeholder]").forEach((el) => {
      const key = el.getAttribute("data-i18n-placeholder");
      if (key) el.placeholder = t(key, code);
    });

    document.querySelectorAll("[data-i18n-aria]").forEach((el) => {
      const key = el.getAttribute("data-i18n-aria");
      if (key) el.setAttribute("aria-label", t(key, code));
    });

    document.querySelectorAll("[data-i18n-aria-label]").forEach((el) => {
      const key = el.getAttribute("data-i18n-aria-label");
      if (key) el.setAttribute("aria-label", t(key, code));
    });

    document.querySelectorAll(".hero-slider__dot").forEach((btn, i) => {
      btn.setAttribute("aria-label", t("slider.slide", code) + " " + (i + 1));
    });
  }

  window.EisenI18n = { apply, t, messages };
})();
