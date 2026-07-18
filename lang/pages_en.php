<?php
return ['pages' => [
    'home_metrics' => [
        'soc_accuracy' => 'SoC prediction accuracy',
    ],
    'pricing' => [
        'seo_title' => 'Pricing — FREE and PREMIUM | EVSmartRoute', 'seo_description' => 'Compare EVSmartRoute FREE and PREMIUM. Start a one-month Premium Trial with no card required.',
        'eyebrow' => 'Transparent pricing', 'title' => 'Choose the freedom to travel farther.', 'intro' => 'Start free and move to Premium when your journeys become more ambitious.',
        'billing_label' => 'Billing period', 'monthly' => 'Monthly', 'yearly' => 'Yearly', 'save' => 'Save 33%',
        'free_description' => 'Essential tools for short everyday EV journeys.', 'monthly_description' => 'A flexible monthly plan you can cancel at any time.', 'yearly_description' => 'The best value for year-round travel — only €{{premium.yearly_month_equivalent}} per month.',
        'per_month' => '/ month', 'per_year' => '/ year', 'recommended' => 'Recommended',
        'free_features' => ['{{free.daily_routes}} route plans per day', 'Routes up to {{free.max_route_km}} km', '{{free.garage_cars}} vehicle', 'Essential station filters'],
        'premium_features' => ['Unlimited routes', 'Multi-stop and international journeys', 'Live Traffic by TomTom', 'Unlimited EV garage', 'Fast and Budget modes'],
        'comparison_eyebrow' => 'No fine print', 'comparison_title' => 'Detailed comparison', 'feature' => 'Feature',
        'comparison' => [
            ['Plans per day', '{{free.daily_routes}}', 'Unlimited'], ['Maximum distance', '{{free.max_route_km}} km', 'Unlimited'], ['Garage vehicles', '{{free.garage_cars}}', 'Unlimited'],
            ['Multi-stop', '—', 'Included'], ['Live Traffic', '—', 'TomTom Live'], ['Fast / Budget mode', '—', 'Included'], ['Detailed SoC forecast', 'Basic', 'Advanced'],
        ],
        'faq_title' => 'Payment questions', 'faq_intro' => 'Clear answers before you start Premium.',
        'faq_items' => [
            ['question' => 'How does the one-month Premium Trial work?', 'answer' => 'You receive Premium access for one month. No card is required to start; any paid renewal terms will be shown clearly in advance.'],
            ['question' => 'Can I cancel at any time?', 'answer' => 'Yes. Cancellation stops the next renewal and Premium remains available until the end of the already-paid period.'],
            ['question' => 'Which payment methods are supported?', 'answer' => 'Payments will be securely processed through Stripe using major credit and debit cards and available local wallet methods.'],
            ['question' => 'Can I switch from monthly to yearly?', 'answer' => 'Yes. Plan changes are managed from your account and applied transparently to your current billing period.'],
        ],
    ],
    'features' => [
        'seo_title' => 'EVSmartRoute Features', 'seo_description' => 'Multi-stop routes, Battery Intelligence, TomTom Live Traffic, charging filters and PWA.',
        'eyebrow' => 'Technology for the real road', 'title' => 'More than a line between two points.', 'intro' => 'EVSmartRoute plans around your vehicle, battery, conditions and charging infrastructure — not distance alone.',
        'features' => [
            ['eyebrow' => 'Multi-stop', 'title' => 'Complex journeys, one clear route.', 'text' => 'Add intermediate destinations and let the system optimise charging between them.', 'items' => ['Reorder stops', 'Automatic charging breaks', 'SoC for each leg'], 'visual' => 'route', 'metric' => '4 stops', 'label' => 'Optimised route'],
            ['eyebrow' => 'Battery Intelligence', 'title' => 'An SoC forecast for every part of the road.', 'text' => 'The model considers efficiency, temperature, terrain, payload and a safety buffer.', 'items' => ['Arrival SoC', 'Seasonal adjustments', 'Critical reserve'], 'visual' => 'battery', 'metric' => '18%', 'label' => 'Arrival reserve'],
            ['eyebrow' => 'TomTom Live Traffic', 'title' => 'The route adapts to traffic.', 'text' => 'Live Traffic adjusts time, energy use and recommended stations around congestion and incidents.', 'items' => ['Live conditions', 'Adaptive ETA', 'Recalculation'], 'visual' => 'traffic', 'metric' => '+14 min', 'label' => 'Current delay'],
            ['eyebrow' => 'Charging filters', 'title' => 'Only stations that work for your car.', 'text' => 'Filter by connector, power, operator and current availability.', 'items' => ['CCS2, CHAdeMO, Type 2', 'Minimum power in kW', 'Preferred operators'], 'visual' => 'filter', 'metric' => '150+ kW', 'label' => 'CCS2 · Available'],
            ['eyebrow' => 'Travel modes', 'title' => 'Fast or Budget — your choice.', 'text' => 'Fast minimises total time; Budget favours affordable stations and sensible speed.', 'items' => ['Minimum time', 'Minimum cost', 'Personal preferences'], 'visual' => 'modes', 'metric' => '−18 min', 'label' => 'Fast mode'],
            ['eyebrow' => 'PWA & Mobile', 'title' => 'Your route follows you across devices.', 'text' => 'An installable PWA with architecture ready for future iOS, Android and in-car applications.', 'items' => ['Responsive PWA', 'Offline-ready shell', 'Future native apps'], 'visual' => 'mobile', 'metric' => 'PWA', 'label' => 'Web · Mobile · Car'],
        ],
        'cta_eyebrow' => 'Ready to try', 'cta_title' => 'See the technology on a real route.', 'cta_text' => 'Start free and add your electric vehicle.',
    ],
    'real-time-data' => [
        'seo_title' => 'Real-time charging station data | EVSmartRoute', 'seo_description' => 'How EVSmartRoute processes status, availability, station and pricing data through OCPI, OCPP and partner APIs.',
        'eyebrow' => 'Data transparency', 'title' => 'From operator to map — with a clear status.', 'intro' => 'EVSmartRoute combines partner live feeds with verified static information without presenting stale status as guaranteed availability.', 'image_alt' => 'Modern ultra-fast charging station with an active status',
        'freshness' => 'Partner statuses are usually refreshed approximately every minute', 'flow_aria' => 'Data flow from operators through EVSmartRoute to the application',
        'flow_operators' => 'CPO operators', 'flow_normalize' => 'Validation and normalisation', 'flow_app' => 'Application and map',
        'layers_eyebrow' => 'Three layers, one dependable view', 'layers_title' => 'What sits behind every point on the map', 'layers_intro' => 'Different information types have different update frequencies and confidence levels.',
        'layers' => [
            ['icon' => '◉', 'title' => 'Dynamic status', 'text' => 'A direct integration supplies availability and EVSE or connector state.', 'items' => ['OCPI/OCPP and partner APIs', 'AVAILABLE, OCCUPIED, OUT_OF_SERVICE', 'Last-update timestamp']],
            ['icon' => '⌖', 'title' => 'Static database', 'text' => 'The stable foundation describes the physical charging infrastructure.', 'items' => ['Coordinates and address', 'CCS2, CHAdeMO and Type 2', 'AC/DC power and operator']],
            ['icon' => '€', 'title' => 'Pricing', 'text' => 'When operators supply tariffs, we normalise them into an estimated charging cost.', 'items' => ['Per-kWh, minute or session pricing', 'Currency and tax', 'Tariff validity']],
        ],
        'offline_eyebrow' => 'When the connection drops', 'offline_title' => '“Unknown” is more honest than a false “Available”.', 'offline_text' => 'Without fresh data, the system retains the last update, lowers confidence and may exclude the station from automatic route selection.',
        'offline_items' => ['Show when the latest status was received', 'Mark stale data as unknown', 'Recommend checking the operator application'],
        'offline_last_update' => 'Last update', 'offline_unknown' => 'Status: unknown',
        'promise_eyebrow' => 'Our promise', 'promise_title' => 'No false precision.', 'promise_text' => 'A live status is an operational signal, not a reservation. Another vehicle may occupy the connector or the operator may change its state before you arrive.',
        'cpo_title' => 'Do you operate a charging network?', 'cpo_text' => 'Connect your OCPI Locations, EVSE, Status and Tariffs to EVSmartRoute and reach more EV drivers across the region.', 'cpo_button' => 'Integrate your network',
        'faq_title' => 'Questions about live data', 'faq_items' => [
            ['question' => 'Do all stations have a real-time status?', 'answer' => 'No. Real-time status is shown only when a sufficiently current direct operator connection exists. Other stations use static information and a clearly marked unknown status.'],
            ['question' => 'How often is availability updated?', 'answer' => 'Partner integrations commonly transmit changes approximately every minute, although frequency depends on each operator and its connection to the station.'],
            ['question' => 'Is the price shown in the app final?', 'answer' => 'It is an estimate based on the latest supplied tariff. The operator determines the final amount, which may include time, session, roaming or other fees.'],
        ],
    ],
    'route-planning' => [
        'seo_title' => 'Intelligent EV route planning', 'seo_description' => 'EV routes with automatic charging stops, SoC forecasts and a personal reserve.', 'eyebrow' => 'Route Intelligence', 'title' => 'A route designed around your car.', 'intro' => 'The system combines the road, real-world range and charging stations into an executable plan.', 'cta' => 'Plan a route',
        'sections' => [
            ['icon' => '↗', 'title' => 'Automatic charging stops', 'text' => 'We select compatible stations based on the route, connector and charging curve.', 'items' => ['Optimised dwell time', 'Nearby backup option']],
            ['icon' => '◎', 'title' => 'Multi-stop', 'text' => 'Arrange every destination and see the energy forecast for each leg.', 'items' => ['Intermediate addresses', 'Live recalculation']],
            ['icon' => '◫', 'title' => 'SoC forecast', 'text' => 'Track the expected battery on arrival and after each charging stop.', 'items' => ['Safety buffer', 'Climate adjustment']],
        ],
    ],
    'charging-network' => [
        'seo_title' => 'Charging network and live data | EVSmartRoute', 'seo_description' => 'Operators, connectors, power, tariffs and availability in one place, with transparent OCPI/OCPP live-data explanations.', 'eyebrow' => 'Charging Network', 'title' => 'More operators. One consistent view.', 'intro' => 'Find compatible stations without jumping between multiple maps.', 'cta' => 'Open the map', 'image_alt' => 'Electric vehicle at a modern mountain charging station', 'visual_caption' => 'One map for regional and international charging networks.',
        'sections' => [
            ['icon' => '⚡', 'title' => 'Connectors and power', 'text' => 'CCS2, CHAdeMO and Type 2 with clear AC/DC power.', 'items' => ['Power filter', 'Vehicle compatibility']],
            ['icon' => '◉', 'title' => 'Operator and status', 'text' => 'Unified data from regional and international networks.', 'items' => ['Live partner status', 'Last update']],
            ['icon' => '€', 'title' => 'Estimated cost', 'text' => 'Tariffs and an expected amount when provided by the operator.', 'items' => ['Energy and time components', 'Currency and taxes']],
        ],
    ],
    'battery-intelligence' => [
        'seo_title' => 'Battery Intelligence and real EV range', 'seo_description' => 'Dynamic SoC, climate factors and an adaptive safety reserve.', 'eyebrow' => 'Battery Intelligence', 'title' => 'Range changes. Your plan should too.', 'intro' => 'A realistic model considers factors a laboratory WLTP result cannot predict for a particular day.',
        'sections' => [
            ['icon' => '℃', 'title' => 'Climate and season', 'text' => 'Temperature, heating, cooling and tyres influence consumption.', 'items' => ['Winter adjustment', 'Climate energy use']],
            ['icon' => '◫', 'title' => 'Vehicle and payload', 'text' => 'Battery, efficiency, passengers and luggage shape the forecast.', 'items' => ['Usable capacity', 'Personal EV profile']],
            ['icon' => '!', 'title' => 'Adaptive reserve', 'text' => 'The system protects a critical buffer and avoids risky legs.', 'items' => ['Minimum SoC', 'Backup station']],
        ],
    ],
    'live-traffic' => [
        'seo_title' => 'TomTom Live Traffic for EV routes', 'seo_description' => 'Traffic contributes to both time and energy forecasts.', 'eyebrow' => 'Live Traffic', 'title' => 'Traffic changes more than arrival time.', 'intro' => 'Congestion, diversions and speed affect energy consumption and the charging plan.',
        'sections' => [
            ['icon' => '≋', 'title' => 'TomTom integration', 'text' => 'Current conditions, incidents and expected delay.', 'items' => ['Live ETA', 'Road events']],
            ['icon' => '↻', 'title' => 'Adaptive route', 'text' => 'We recalculate the route and charging stops after material change.', 'items' => ['Alternative route', 'New SoC forecast']],
            ['icon' => '⚡', 'title' => 'Energy effect', 'text' => 'A different traffic profile changes expected consumption.', 'items' => ['Speed profile', 'Updated arrival']],
        ],
    ],
    'about' => [
        'seo_title' => 'About EVSmartRoute | More predictable electric journeys',
        'seo_description' => 'Meet the mission, vision and principles behind EVSmartRoute — intelligent planning for real-world range and charging infrastructure.',
        'eyebrow' => 'About EVSmartRoute',
        'title' => 'A clearer road to an electric tomorrow.',
        'intro' => 'We turn complex battery, route, traffic and charging data into one calm and predictable journey.',
        'hero_badge' => 'Built for the real road',
        'story_eyebrow' => 'Our story',
        'story_title' => 'EV travel should not begin with uncertainty.',
        'story_text_1' => 'EVSmartRoute grew from a practical problem: vehicle capability, remaining charge, traffic, tariffs and station availability all live in different places. Drivers are expected to connect the pieces precisely when they need confidence most.',
        'story_text_2' => 'We are building a unified intelligence layer for electric mobility. It matches the vehicle with real road conditions and presents more than a route — it creates a realistic arrival plan.',
        'metric_models' => 'EV configurations', 'metric_locations' => 'charging locations', 'metric_languages' => 'launch languages',
        'mission_eyebrow' => 'Mission and vision',
        'mission_title' => 'Make the transition to electric travel feel natural.',
        'mission_text' => 'Our mission is to remove range anxiety and give every EV driver a clear, honest and useful forecast before and during the journey.',
        'vision_title' => 'Our vision',
        'vision_text' => 'A connected Europe where vehicles, charging networks and road data work together — making the sustainable choice the easiest one too.',
        'freedom_eyebrow' => 'Electric freedom',
        'freedom_title' => 'A journey should not end where another network begins.',
        'freedom_text' => 'Borders, different operators and incompatible applications should not define how far you can travel. EVSmartRoute brings the route, vehicle and charging infrastructure into one consistent plan — from the daily commute to a long European journey.',
        'freedom_points' => ['Open to every EV brand', 'Routes across different charging networks', 'For cities, highways and international travel', 'Continuously expanding regional coverage'],
        'freedom_label' => 'One route · Fewer boundaries',
        'intelligence_badge' => 'Route · Battery · Charging · Traffic',
        'intelligence_caption' => 'One data layer. One understandable travel plan.',
        'values_eyebrow' => 'What drives us', 'values_title' => 'Principles built into the product.',
        'values' => [
            ['icon' => '◎', 'title' => 'Transparent', 'text' => 'We show what we know, where the data comes from and where uncertainty remains. No promises the road cannot keep.'],
            ['icon' => '↗', 'title' => 'Reliable', 'text' => 'We compare multiple signals and protect an arrival reserve because a useful forecast must work beyond the laboratory.'],
            ['icon' => '⌁', 'title' => 'Regionally aware', 'text' => 'We understand the Balkans — its operators, mountain routes, borders and uneven charging density.'],
            ['icon' => '✦', 'title' => 'Always improving', 'text' => 'We work iteratively, measure real behaviour and strengthen the algorithm with every new integration.'],
        ],
        'help_eyebrow' => 'One platform. More confidence.', 'help_title' => 'Creating value across the EV ecosystem.',
        'help' => [
            ['title' => 'For drivers', 'text' => 'Real-world range, compatible charging stops, expected costs and a clear arrival reserve.'],
            ['title' => 'For CPOs', 'text' => 'Clearer network visibility, OCPI integration and relevant traffic directed to charging locations.'],
            ['title' => 'For partners', 'text' => 'A technology foundation for automotive, energy and mobility services that want to deliver a better EV experience.'],
        ],
        'cta_eyebrow' => 'Your next route', 'cta_title' => 'Ready to travel with more confidence?', 'cta_text' => 'Plan your first route free or contact us to explore a partnership.', 'cta_primary' => 'Plan a route', 'cta_secondary' => 'Contact us',
    ],
    'faq' => [
        'seo_title' => 'Frequently asked questions | EVSmartRoute', 'seo_description' => 'Answers about routes, vehicles, charging stations and subscriptions.', 'eyebrow' => 'Help', 'title' => 'Frequently asked questions.', 'intro' => 'Short answers about the platform’s core capabilities.',
        'sections' => [
            ['icon' => '?', 'title' => 'Is registration required?', 'text' => 'You can explore the product, while an account saves vehicles, preferences and routes.'],
            ['icon' => '⚡', 'title' => 'Is station availability guaranteed?', 'text' => 'No. A live status is the latest received signal and may change before arrival.'],
            ['icon' => '◫', 'title' => 'How accurate is the SoC forecast?', 'text' => 'It is an estimate based on available data and improves with an accurate vehicle profile and conditions.'],
            ['icon' => '€', 'title' => 'Is there a free plan?', 'text' => 'Yes. FREE includes up to {{free.daily_routes}} daily plans and routes up to {{free.max_route_km}} km.'],
        ],
    ],
    'contact' => [
        'seo_title' => 'Contact | EVSmartRoute', 'seo_description' => 'Contact EVSmartRoute for support, partnerships and CPO integrations.', 'eyebrow' => 'Contact', 'title' => 'Let’s talk.', 'intro' => 'Choose the right channel for support, partnership or integration.',
        'sections' => [
            ['icon' => '@', 'title' => 'General enquiries', 'text' => 'hello@evsmartroute.com', 'items' => ['Product and feedback']],
            ['icon' => '⚡', 'title' => 'CPO partnerships', 'text' => 'partners@evsmartroute.com', 'items' => ['OCPI, OCPP and API integration']],
            ['icon' => '◇', 'title' => 'Support', 'text' => 'support@evsmartroute.com', 'items' => ['Accounts and routes']],
        ],
    ],
    'privacy' => [
        'seo_title' => 'Privacy policy | EVSmartRoute', 'seo_description' => 'How EVSmartRoute handles and protects personal data.', 'eyebrow' => 'Legal', 'title' => 'Privacy policy', 'intro' => 'We process only the information required to provide, secure and improve the service.',
        'sections' => [
            ['title' => 'Data we process', 'text' => 'Account data, vehicle preferences, saved routes and security logs.', 'items' => ['No sale of personal data', 'Data minimisation']],
            ['title' => 'Legal basis and rights', 'text' => 'Processing relies on contract, legitimate interest, consent or legal obligation.', 'items' => ['Access and correction', 'Deletion and restriction', 'Portability']],
            ['title' => 'Retention and security', 'text' => 'Data is retained only as needed and protected by appropriate technical measures.', 'items' => ['Access controls', 'Encrypted transport']],
        ], 'note_title' => 'Privacy contact', 'note' => 'For privacy requests: privacy@evsmartroute.com. This text will receive final legal review before production launch.',
    ],
    'terms' => [
        'seo_title' => 'Terms of use | EVSmartRoute',
        'seo_description' => 'Terms governing the EVSmartRoute website, EV planner, accounts and subscription services.',
        'eyebrow' => 'Legal',
        'title' => 'Terms of use',
        'intro' => 'These terms govern access to the EVSmartRoute website, EV planner, user accounts and related services.',
        'last_updated_label' => 'Last updated',
        'last_updated' => '18 July 2026',
        'toc_title' => 'Contents',
        'toc_aria' => 'Terms of use contents',
        'acceptance' => 'By accessing or using EVSmartRoute, you confirm that you have read and accept these terms. If you use the service on behalf of an organisation, you represent that you have authority to bind it to these terms.',
        'sections' => [
            [
                'id' => 'scope', 'title' => '1. Scope and contracting party',
                'paragraphs' => [
                    'EVSmartRoute is a web and application service for planning electric-vehicle journeys. In these terms, “EVSmartRoute”, “we”, “us” and “our” mean the service operator identified on the contact page.',
                    'The service includes free and paid features and may use maps, traffic, weather, charging infrastructure and other resources supplied by third parties.',
                ],
            ],
            [
                'id' => 'intended-use', 'title' => '2. Intended use',
                'paragraphs' => ['EVSmartRoute is intended for good-faith planning of your own electric-vehicle journeys. You receive a limited, personal, non-exclusive and non-transferable right to use the service under your selected plan.'],
                'items' => ['Comply with these terms and applicable third-party provider rules.', 'Do not rely on the results as the sole source for safety-critical decisions.', 'Notify us if you suspect a breach or misuse of the service.'],
            ],
            [
                'id' => 'navigation-safety', 'title' => '3. Navigation and safety',
                'paragraphs' => [
                    'Routes, travel time, consumption, SoC and recommended charging stops are computational forecasts. They do not replace driver judgement, official road signs, traffic rules or directions from competent authorities.',
                    'Do not enter information or interact with the interface in a way that distracts you while driving. Monitor the remaining charge and maintain a reasonable reserve and an alternative charging option.',
                ],
                'items' => ['GPS positioning and map data may be inaccurate or incomplete.', 'Actual range is affected by temperature, wind, speed, elevation, traffic, payload, tyres, climate control and battery condition.', 'The driver remains responsible for safe and lawful operation of the vehicle.'],
            ],
            [
                'id' => 'accounts', 'title' => '4. Accounts and security',
                'paragraphs' => ['You are responsible for accurate registration information, protecting your credentials and activity performed through your account. Do not grant access to another person unless we provide a feature expressly designed for sharing or delegated access.'],
                'items' => ['Report unauthorised access without delay.', 'Keep an active email address for important notices.', 'Social sign-in is also subject to the relevant provider terms.'],
            ],
            [
                'id' => 'plans-payments', 'title' => '5. FREE, PREMIUM, trials and payments',
                'paragraphs' => [
                    'The features, limits, prices and duration of each plan are described on the Subscriptions page and in the application before activation. A Premium trial converts into a paid subscription only where this is clearly disclosed and you provide the required consent and payment details.',
                    'Where applicable, fees are collected in advance through an external payment processor. We may restrict paid features following a failed payment. Statutory cancellation, refund and consumer-protection rights remain unaffected.',
                ],
            ],
            [
                'id' => 'user-data', 'title' => '6. User-provided data and content',
                'paragraphs' => [
                    'You may provide coordinates, routes, vehicle settings, telemetry, preferences and feedback. You retain your rights in that content and permit us to process it only as necessary to provide, secure and improve the service.',
                    'You represent that you have the right to use submitted data. Do not submit another person’s private, confidential or protected information without a valid legal basis and consent.',
                ],
            ],
            [
                'id' => 'acceptable-use', 'title' => '7. Prohibited use',
                'paragraphs' => ['You must not use EVSmartRoute in a way that violates the law, the rights of others, security or the normal operation of the service.'],
                'items' => [
                    'No automated extraction, bots, spiders, bulk caching, meta-searching or systematic copying without written API authorisation.',
                    'No circumvention of access controls, authentication, rate limits or other technical safeguards.',
                    'No reverse engineering, decompilation or attempts to derive algorithms, models, source code or trade secrets, except where expressly permitted by law.',
                    'No resale, republication or creation of a competing database from stations, tariffs, results or service content.',
                    'No unauthorised vulnerability testing, overloading, interference, malicious code, spam or monitoring of another person without their knowledge and valid consent.',
                ],
            ],
            [
                'id' => 'third-party-data', 'title' => '8. Third-party data and services',
                'paragraphs' => [
                    'EVSmartRoute combines information from mapping providers, charging networks, public registers, traffic, geocoding, weather and other partner sources. That information remains subject to the relevant provider rights and terms.',
                    'An “available” status is the latest operational signal received, not a reservation. A displayed tariff is an estimate; the charging operator determines the final price, fees, access and charging conditions.',
                ],
            ],
            [
                'id' => 'accuracy', 'title' => '9. Accuracy and no warranties',
                'paragraphs' => [
                    'The service is supplied “as is” and on the basis of information currently available. We aim for accuracy and reliability but do not guarantee uninterrupted operation, a particular route, charger availability, connector compatibility, price, charging time, arrival time or remaining charge.',
                    'We recommend validating the vehicle profile, maintaining an energy safety margin and checking critical information in the charging operator’s application.',
                ],
            ],
            [
                'id' => 'service-changes', 'title' => '10. Service changes and availability',
                'paragraphs' => ['We may add, change or remove features, perform maintenance and temporarily restrict access for technical, security, legal or business reasons. For material changes to a paid service, we will provide information and remedies required by applicable law.'],
            ],
            [
                'id' => 'liability', 'title' => '11. Limitation of liability',
                'paragraphs' => [
                    'To the maximum extent permitted by law, EVSmartRoute is not liable for indirect or consequential loss, lost profits, data loss, business interruption or loss arising from inaccurate third-party information, an unavailable charging station, or third-party hardware, networks or services.',
                    'Nothing in these terms excludes or limits liability that cannot lawfully be excluded, including mandatory consumer rights.',
                ],
            ],
            [
                'id' => 'suspension', 'title' => '12. Suspension and termination',
                'paragraphs' => [
                    'You may stop using the service and request account closure. We may temporarily restrict or terminate access following a material breach, abuse, a security risk, a legal requirement or an unpaid amount that is due.',
                    'Cancellation of a paid plan operates under the terms displayed at purchase. Data retention and deletion are governed by the Privacy Policy and applicable law.',
                ],
            ],
            [
                'id' => 'intellectual-property', 'title' => '13. Intellectual property',
                'paragraphs' => ['The EVSmartRoute name, brand, design, software, algorithms, database structure, original content and documentation are owned by us or used under licence. These terms do not transfer ownership or trade-mark rights.'],
            ],
            [
                'id' => 'privacy', 'title' => '14. Privacy and cookies',
                'paragraphs' => ['We process personal data under the Privacy Policy. Optional cookies and similar technologies are used only according to your selection in the consent panel. You are responsible for not using the service to violate privacy or track another person without a lawful basis.'],
            ],
            [
                'id' => 'updates-notices', 'title' => '15. Changes to these terms and notices',
                'paragraphs' => ['We may update these terms following changes to the service, law or business model. We will publish the new date and notify material changes through the application, website or supplied email address. Continued use after the effective date constitutes acceptance; if you disagree, you must stop using the service.'],
            ],
            [
                'id' => 'law-disputes', 'title' => '16. Governing law and disputes',
                'paragraphs' => ['These terms are governed by the laws of the Republic of Bulgaria and applicable European Union law. Disputes should first be submitted through our contact page. Court jurisdiction and mandatory consumer rights remain governed by applicable law and the consumer’s country of habitual residence.'],
            ],
            [
                'id' => 'final-provisions', 'title' => '17. Final provisions',
                'paragraphs' => ['If a provision is held unenforceable, the remaining provisions continue in effect. Failure to enforce a right is not a waiver. You may not transfer your account or rights without our consent; we may transfer the service as part of a reorganisation or acquisition subject to applicable law and consumer rights.'],
            ],
        ],
        'note_title' => 'Legal review required',
        'note' => 'This is an original working draft aligned with EVSmartRoute functionality. Before payments and commercial launch, it must be approved by qualified legal counsel and completed with the full legal name, registration number, address and contact details of the actual service operator.',
    ],
    'cookies' => [
        'seo_title' => 'Cookie policy | EVSmartRoute', 'seo_description' => 'Information about essential, analytical and preference cookies.', 'eyebrow' => 'Legal', 'title' => 'Cookie policy', 'intro' => 'We use essential technologies to operate the service and optional ones only after your choice.',
        'sections' => [
            ['title' => 'Essential', 'text' => 'Maintain sessions, security and the language and colour theme explicitly selected by the visitor.', 'items' => ['Always active', 'Not used for advertising']],
            ['title' => 'Preferences', 'text' => 'Enable additional personalisation beyond the essential interface settings.', 'items' => ['Consent required', 'Can be disabled at any time']],
            ['title' => 'Analytics', 'text' => 'Help us understand aggregate page use.', 'items' => ['Consent required', 'Consent can be withdrawn']],
            ['title' => 'Management', 'text' => 'Preferences can be changed at any time through the consent panel.', 'items' => ['Clear choice', 'No preselected optional categories']],
        ],
    ],
    'eu-data-act' => [
        'seo_title' => 'EU Data Act | EVSmartRoute', 'seo_description' => 'Information about access, portability and use of connected data.', 'eyebrow' => 'European data', 'title' => 'EU Data Act and your data', 'intro' => 'We are preparing transparent access and portability mechanisms within the scope of Regulation (EU) 2023/2854.',
        'sections' => [
            ['title' => 'Data access', 'text' => 'Users will be able to obtain service-generated data in a structured format.', 'items' => ['Clear request', 'Machine-readable format']],
            ['title' => 'Sharing by choice', 'text' => 'Transfer to a third party occurs only after a valid user request.', 'items' => ['User control', 'Recipient validation']],
            ['title' => 'Protection and limitations', 'text' => 'Personal data, trade secrets and security requirements continue to apply.', 'items' => ['GDPR alignment', 'Protected business data']],
        ], 'note_title' => 'Status', 'note' => 'This page will be updated alongside the actual export functionality and final legal assessment.',
    ],
    'blog' => [
        'seo_title' => 'EVSmartRoute Blog', 'seo_description' => 'Practical guides to EV routes, charging and batteries.', 'eyebrow' => 'Knowledge for the road', 'title' => 'EVSmartRoute Blog', 'intro' => 'Practical articles about routes, charging networks, tariffs and real-world range are coming soon.',
        'sections' => [
            ['icon' => '01', 'title' => 'How do live statuses work?', 'text' => 'Why not every station has a real-time link and how to read freshness.'],
            ['icon' => '02', 'title' => 'Winter range', 'text' => 'How temperature and heating change route planning.'],
            ['icon' => '03', 'title' => 'CCS2, CHAdeMO and Type 2', 'text' => 'A practical connector and charging-power guide.'],
        ],
    ],
]];
