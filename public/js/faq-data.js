(function () {
  "use strict";

  window.EISEN_FAQ = {
    defaultSlug: "general-questions",
    topics: [
      {
        slug: "general-questions",
        label: { en: "General Questions", ja: "一般的なご質問" },
        questions: [
          {
            q: { en: "What are your business hours?", ja: "営業時間を教えてください。" },
            a: {
              en: "Our export desk is available Monday to Friday, 9:00–18:00 JST. Email inquiries received outside these hours are answered on the next business day.",
              ja: "輸出デスクは月曜〜金曜 9:00〜18:00（日本時間）です。時間外のメールは翌営業日に返信いたします。",
            },
          },
          {
            q: { en: "What languages do you support?", ja: "対応言語は何ですか？" },
            a: {
              en: "We support English and Japanese on our website. Our team can also assist in other languages depending on your market.",
              ja: "サイトは英語と日本語に対応しています。市場に応じて他言語でのサポートも可能な場合があります。",
            },
          },
          {
            q: { en: "Are there any membership or signup fees?", ja: "会員登録料はかかりますか？" },
            a: {
              en: "Browsing inventory and submitting inquiries is free. Dealer accounts may require verification; any applicable service fees are explained before you confirm a purchase.",
              ja: "在庫閲覧とお問い合わせは無料です。ディーラーアカウントは確認が必要な場合があります。該当する手数料は購入確定前にご説明します。",
            },
          },
          {
            q: { en: "What are the regulations for importing a vehicle?", ja: "輸入規制について教えてください。" },
            a: {
              en: "Import rules depend on your destination country. You are responsible for local compliance, but we provide export documents and guidance based on your port requirements.",
              ja: "輸入規制は仕向国により異なります。現地法令の遵守はお客様の責任ですが、書類と港要件に基づくガイドを提供します。",
            },
          },
          {
            q: { en: "Why should I trust Eisen?", ja: "アイゼンを信頼する理由は？" },
            a: {
              en: "Eisen combines Japan auction access, inspection support, and export logistics with transparent communication at every stage of your purchase.",
              ja: "アイゼンは日本オークション、検査サポート、輸出物流を組み合わせ、購入の各段階で透明な連絡を行います。",
            },
          },
        ],
      },
      {
        slug: "account-assistance",
        label: { en: "Account Assistance", ja: "アカウントサポート" },
        questions: [
          {
            q: { en: "How do I create a dealer account?", ja: "ディーラーアカウントの作成方法は？" },
            a: {
              en: "Contact our team via the contact page or login area. We will verify your business details and enable dealer pricing after approval.",
              ja: "お問い合わせまたはログインからご連絡ください。事業内容確認後、ディーラー価格を有効化します。",
            },
          },
          {
            q: { en: "I forgot my password. What should I do?", ja: "パスワードを忘れました。" },
            a: {
              en: "Use the Forgot password link on the login page. A reset link will be sent to your registered email address.",
              ja: "ログインページのパスワード忘れからリセットしてください。登録メールにリンクが届きます。",
            },
          },
          {
            q: { en: "Can I update my company details later?", ja: "会社情報は後から変更できますか？" },
            a: {
              en: "Yes. Email export@eisen-corp.com with your account email and the updated information you need changed.",
              ja: "はい。登録メールと変更内容を export@eisen-corp.com までお送りください。",
            },
          },
        ],
      },
      {
        slug: "inventory-availability",
        label: { en: "Inventory & Availability", ja: "在庫と空き状況" },
        questions: [
          {
            q: { en: "How often is inventory updated?", ja: "在庫はどのくらいの頻度で更新されますか？" },
            a: {
              en: "Listings are updated regularly as auction results and stock change. Popular units may sell quickly—confirm availability before payment.",
              ja: "オークション結果と在庫に応じて定期的に更新されます。人気車両は早く売れるため、支払前に空きをご確認ください。",
            },
          },
          {
            q: { en: "Can you source a vehicle not listed on the site?", ja: "サイトにない車両も調達できますか？" },
            a: {
              en: "Yes. Share make, model, year, budget, and destination port. Our team can search Japan auctions on your behalf.",
              ja: "可能です。メーカー、モデル、年式、予算、仕向港をお知らせください。代行検索いたします。",
            },
          },
        ],
      },
      {
        slug: "vehicle-inspection",
        label: { en: "Vehicle Inspection", ja: "車両検査" },
        questions: [
          {
            q: { en: "What inspection reports do you provide?", ja: "どの検査報告を提供しますか？" },
            a: {
              en: "We provide auction sheet summaries, grading notes, and additional inspection on request before export confirmation.",
              ja: "オークションシート要約、グレード情報、ご依頼に応じた追加検査を輸出確定前に提供します。",
            },
          },
          {
            q: { en: "Can I request extra photos or video?", ja: "追加写真や動画は依頼できますか？" },
            a: {
              en: "Yes, subject to auction yard access and timing. Request extras when you submit your inquiry.",
              ja: "はい、ヤードの状況と時間により可能です。お問い合わせ時にご依頼ください。",
            },
          },
        ],
      },
      {
        slug: "buying-process",
        label: { en: "Buying Process", ja: "購入プロセス" },
        questions: [
          {
            q: { en: "What are the steps to buy a vehicle?", ja: "購入の流れを教えてください。" },
            a: {
              en: "Inquiry → availability check → invoice/deposit → export documentation → shipping → delivery at destination port.",
              ja: "お問い合わせ → 空き確認 → 請求/デポジット → 輸出書類 → 船積み → 仕向港到着。",
            },
          },
          {
            q: { en: "How long do I have to complete payment?", ja: "支払期限はどのくらいですか？" },
            a: {
              en: "Payment terms are stated on your invoice. Late payment may result in cancellation or relisting of the vehicle.",
              ja: "請求書に記載されます。遅延するとキャンセルまたは再出品となる場合があります。",
            },
          },
        ],
      },
      {
        slug: "payment-methods",
        label: { en: "Payment Methods", ja: "お支払い方法" },
        questions: [
          {
            q: { en: "Which payment methods do you accept?", ja: "利用できる支払方法は？" },
            a: {
              en: "We primarily accept bank wire transfer. Other methods may be available for verified dealer accounts—ask your export coordinator.",
              ja: "主に銀行振込です。認証済みディーラー向けに他方法がある場合があります。担当者へご確認ください。",
            },
          },
          {
            q: { en: "Is a deposit required?", ja: "デポジットは必要ですか？" },
            a: {
              en: "A deposit may be required to secure auction bidding or stock. The amount and refund terms are confirmed in writing before you pay.",
              ja: "落札や在庫確保のためデポジットが必要な場合があります。金額と返金条件は事前に書面で確認します。",
            },
          },
        ],
      },
      {
        slug: "shipping",
        label: { en: "Shipping", ja: "配送・船積み" },
        questions: [
          {
            q: { en: "How is shipping cost calculated?", ja: "配送費はどう計算されますか？" },
            a: {
              en: "Freight depends on vehicle size, port pair, and carrier schedule. We quote shipping separately from the vehicle price.",
              ja: "車両サイズ、港間、船会社スケジュールにより異なります。車両代とは別に見積します。",
            },
          },
          {
            q: { en: "How long does delivery take?", ja: "納期はどのくらいですか？" },
            a: {
              en: "Transit time varies by destination and season. Estimated dates are provided after booking but are not guaranteed due to port or customs delays.",
              ja: "仕向国と時期により異なります。目安日は予約後にお伝えしますが、港や通関遅延により保証されません。",
            },
          },
        ],
      },
      {
        slug: "after-sales-services",
        label: { en: "After-sales services", ja: "アフターセールス" },
        questions: [
          {
            q: { en: "Who handles customs clearance at destination?", ja: "仕向国の通関は誰が行いますか？" },
            a: {
              en: "The buyer or their local agent handles import clearance. We supply export-side documents required by most ports.",
              ja: "買主または現地代理店が行います。多くの港で必要な輸出側書類を提供します。",
            },
          },
          {
            q: { en: "Can I get spare parts through Eisen?", ja: "部品も手配できますか？" },
            a: {
              en: "Yes, for many models. Share VIN/chassis details and the parts you need; availability and lead time will be quoted separately.",
              ja: "多くのモデルで可能です。車台番号と部品名をお知らせください。別途お見積りします。",
            },
          },
        ],
      },
      {
        slug: "glossary-of-terms",
        label: { en: "Glossary of Terms", ja: "用語集" },
        questions: [
          {
            q: { en: "What does FOB mean?", ja: "FOBとは？" },
            a: {
              en: "FOB (Free On Board) means the seller delivers the vehicle to the port; buyer arranges and pays ocean freight from there.",
              ja: "FOBは船積み港まで売主が引渡し、海上運賃は買主負担となる条件です。",
            },
          },
          {
            q: { en: "What is an auction grade?", ja: "オークショングレードとは？" },
            a: {
              en: "Auction houses grade exterior and interior condition (e.g. 3.5, 4, 4.5). It helps compare vehicles but should be read with the full auction sheet.",
              ja: "外装・内装の評価（例 3.5、4、4.5）です。比較に役立ちますがシート全体の確認が必要です。",
            },
          },
        ],
      },
    ],
  };
})();
