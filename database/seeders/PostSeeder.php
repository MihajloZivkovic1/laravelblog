<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // category_id: 1=Technology, 2=Travel, 3=Food, 4=Lifestyle, 5=Business
        // tag_id: 1=Laravel, 2=PHP, 3=JavaScript, 4=Travel, 5=Food, 6=Health, 7=Finance, 8=Tips

        $posts = [

            // ── Technology ──────────────────────────────────────────────────
            [
                'title'       => 'Getting Started with Laravel 12',
                'body'        => 'Laravel 12 brings many exciting features to the table. In this post we will explore the new features and how to get started with the latest version of Laravel. Laravel continues to be one of the most popular PHP frameworks, known for its elegant syntax and powerful features. The framework provides tools needed for large, robust applications. With the release of Laravel 12, the team has focused heavily on developer experience, introducing improved Artisan commands, a revamped routing system, and enhanced support for modern PHP 8.3 features. If you are coming from an older version, the upgrade path is smooth thanks to the comprehensive migration guide available in the official documentation.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 2],
            ],
            [
                'title'       => 'JavaScript Tips Every Developer Should Know',
                'body'        => 'JavaScript is one of the most widely used programming languages in the world. Whether you are a beginner or an experienced developer, there is always something new to learn. In this post we share some essential JavaScript tips and tricks that will help you write better, cleaner code. These tips cover everything from ES6 features to performance optimization. Understanding closures, the event loop, and prototype chains are fundamental to writing professional JavaScript. We also look at modern patterns like optional chaining, nullish coalescing, and how to leverage async/await effectively in real-world applications.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 3],
            ],
            [
                'title'       => 'Building REST APIs with Laravel Sanctum',
                'body'        => 'Authentication is one of the most critical parts of any web application. Laravel Sanctum provides a simple, lightweight solution for API token authentication and SPA authentication. In this tutorial we will build a fully functional REST API from scratch, implementing registration, login, and protected routes. We will also explore best practices for structuring your API resources, handling errors consistently, and writing feature tests to keep your API reliable as the codebase grows.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 2],
            ],
            [
                'title'       => 'Understanding PHP 8.3 Features',
                'body'        => 'PHP 8.3 introduces a range of improvements that make the language faster and more expressive. From typed class constants and readonly properties on cloned objects to the new json_validate function and improved random extension, there is plenty to explore. In this post we break down each new feature with practical code examples, so you can start taking advantage of them in your projects today. We also discuss the deprecations you should be aware of when upgrading existing applications.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [2],
            ],
            [
                'title'       => 'Mastering Eloquent Relationships in Laravel',
                'body'        => 'Eloquent is one of Laravel\'s most powerful features, and understanding its relationship system is key to writing efficient database queries. In this deep dive we cover hasOne, hasMany, belongsTo, belongsToMany, hasManyThrough, and polymorphic relationships. We look at eager loading vs lazy loading, how to avoid the N+1 query problem, and advanced techniques like relationship query scopes and custom pivot models. By the end of this post you will have a solid grasp of how to model complex data relationships cleanly.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 2],
            ],
            [
                'title'       => 'Vue 3 Composition API: A Complete Guide',
                'body'        => 'The Composition API is one of the most significant changes in Vue 3, offering a more flexible way to organize component logic. Unlike the Options API, the Composition API lets you group related logic together regardless of which option it belongs to. In this guide we walk through ref, reactive, computed, watch, and lifecycle hooks. We also explore how to extract reusable logic into composables, which are the Vue 3 equivalent of React hooks. Practical examples throughout help illustrate real use cases.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [3],
            ],
            [
                'title'       => 'Docker for PHP Developers: Getting Started',
                'body'        => 'Docker has become an essential tool for modern web development. It allows you to create consistent development environments that mirror production, eliminating the classic "it works on my machine" problem. In this guide we set up a Docker environment for a Laravel application from scratch, covering PHP-FPM, Nginx, MySQL, and Redis containers. We also look at Docker Compose for managing multi-container setups, volume mounting for live code reloading, and tips for optimising image sizes for faster builds.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [2, 8],
            ],
            [
                'title'       => 'Writing Cleaner Code with SOLID Principles',
                'body'        => 'SOLID is an acronym for five design principles that help developers write more maintainable and scalable code. Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, and Dependency Inversion — these principles apply regardless of the language you use. In this post we explore each principle with PHP examples, showing common violations and how to refactor them. Following SOLID leads to code that is easier to test, extend, and reason about.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [2, 8],
            ],
            [
                'title'       => 'Introduction to Redis Caching in Laravel',
                'body'        => 'Caching is one of the most effective ways to improve the performance of a web application. Laravel has built-in support for Redis, a blazing-fast in-memory data store. In this tutorial we explore the Laravel cache API, how to configure Redis, and practical strategies for caching database queries, API responses, and rendered views. We also discuss cache invalidation strategies and how to use cache tags for grouped invalidation.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 2],
            ],
            [
                'title'       => 'Test Driven Development with PHPUnit and Laravel',
                'body'        => 'Test Driven Development is a methodology where you write tests before writing the actual code. It sounds counterintuitive at first, but TDD leads to better-designed, more reliable software. In this post we explore TDD in the context of a Laravel application, using PHPUnit and Laravel\'s powerful testing helpers. We cover unit tests, feature tests, database testing with factories, mocking external services, and how to structure your test suite for long-term maintainability.',
                'category_id' => 1,
                'status'      => 'published',
                'tags'        => [1, 2],
            ],

            // ── Travel ──────────────────────────────────────────────────────
            [
                'title'       => 'Top 10 Travel Destinations in 2026',
                'body'        => 'Traveling the world is one of the most enriching experiences a person can have. In this post we explore the top 10 destinations you should visit in 2026. From the beaches of Southeast Asia to the mountains of South America, there is something for every type of traveler. Make sure to plan your trips in advance to get the best deals on flights and accommodation. Our list includes hidden gems alongside perennial favorites, with tips on the best time to visit each destination.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4],
            ],
            [
                'title'       => 'How to Travel on a Budget in Europe',
                'body'        => 'Europe is often considered an expensive destination, but with the right planning it is entirely possible to explore the continent without breaking the bank. In this guide we cover budget airlines, hostel booking strategies, free walking tours, city passes, and how to eat well without spending a fortune. We share our favorite budget-friendly cities including Krakow, Lisbon, Budapest, and Porto, with estimated daily costs for each.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4, 8],
            ],
            [
                'title'       => 'A Week in Japan: The Ultimate Itinerary',
                'body'        => 'Japan is a destination unlike any other. In just one week you can experience ancient temples, futuristic cities, world-class cuisine, and breathtaking natural landscapes. This itinerary takes you from Tokyo to Kyoto via Hakone, with stops that balance iconic sights and off-the-beaten-path discoveries. We also include practical tips on using the JR Pass, navigating the subway system, and etiquette rules that will make you a respectful visitor.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4, 8],
            ],
            [
                'title'       => 'Solo Travel Safety Tips for 2026',
                'body'        => 'Solo travel is one of the most transformative things you can do for personal growth. But it also comes with unique challenges around safety and logistics. In this post we share practical advice for staying safe while traveling alone, covering accommodation choices, digital security, how to blend in, staying connected with people back home, and what to do if something goes wrong. Whether you are a first-time solo traveler or a seasoned backpacker, these tips are worth revisiting.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4, 8],
            ],
            [
                'title'       => 'The Most Beautiful Beaches in Southeast Asia',
                'body'        => 'Southeast Asia is home to some of the most stunning beaches on the planet. From the pristine white sands of the Philippines to the dramatic cliffs of Thailand\'s Krabi province, the region offers an incredible variety of coastal experiences. In this post we rank our favorite beaches, share the best time to visit each one, and give honest assessments of how crowded they tend to get. We also recommend some lesser-known alternatives for travelers who want to escape the tourist trail.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4],
            ],
            [
                'title'       => 'Road Tripping Through the American Southwest',
                'body'        => 'The American Southwest is one of the world\'s great road trip destinations. The sheer scale of the landscape — red rock canyons, vast desert plains, towering mesas — is something that has to be experienced from the road to be fully appreciated. This guide covers a two-week route through Utah, Arizona, Nevada, and New Mexico, including the best national parks, scenic drives, campgrounds, and small towns worth stopping in. We also include a packing list and tips for driving in extreme heat.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4, 8],
            ],
            [
                'title'       => 'Hidden Gems of the Balkans',
                'body'        => 'While most tourists flock to Croatia\'s Dalmatian Coast, the broader Balkans region remains wonderfully under-explored. Countries like Albania, North Macedonia, Kosovo, and Bosnia and Herzegovina offer dramatic landscapes, rich history, and incredibly warm hospitality at a fraction of the cost of Western Europe. In this post we highlight our favorite towns, hikes, and experiences across the region, with practical advice on border crossings, currency, and getting around.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4],
            ],
            [
                'title'       => 'How to Pack Light for a Two-Week Trip',
                'body'        => 'Overpacking is one of the most common mistakes travelers make. Lugging a heavy suitcase through airports, cobblestone streets, and hostel staircases takes a real toll on your trip enjoyment. In this guide we share the carry-on-only system we have refined over years of travel. We cover a flexible capsule wardrobe, the best packing cubes, toiletry strategies, and how to handle laundry on the road. Once you go carry-on only, you will never go back.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4, 8],
            ],
            [
                'title'       => 'The Best Train Journeys in the World',
                'body'        => 'There is something uniquely romantic about long-distance train travel. Watching the landscape change outside your window, meeting fellow travelers in the dining car, and arriving at your destination feeling rested rather than jet-lagged — it is a completely different experience from flying. In this post we round up the world\'s most spectacular rail journeys, from the Trans-Siberian Railway to the Glacier Express in Switzerland, the Ghan in Australia, and the Maharajas Express in India.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4],
            ],
            [
                'title'       => 'Digital Nomad Hotspots for 2026',
                'body'        => 'Remote work has fundamentally changed the way many people think about travel. Why stay in one place when your laptop goes with you? In this guide we review the best cities for digital nomads in 2026, evaluating them on fast internet, coworking space quality, cost of living, visa options, safety, and social scene. Our top picks include Chiang Mai, Medellín, Tbilisi, Lisbon, and Bali, with practical advice on setting up as a remote worker in each.',
                'category_id' => 2,
                'status'      => 'published',
                'tags'        => [4, 7],
            ],

            // ── Food ────────────────────────────────────────────────────────
            [
                'title'       => 'The Best Pasta Recipes You Need to Try',
                'body'        => 'Pasta is one of the most versatile and beloved foods in the world. Whether you prefer a classic carbonara or a hearty bolognese, there is a pasta dish for everyone. In this post we share our favorite pasta recipes that are easy to make at home. These recipes use simple ingredients that you can find at any grocery store. We also share tips on making fresh pasta from scratch, including the right flour to use and how to achieve the perfect al dente texture every time.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5],
            ],
            [
                'title'       => 'A Beginner\'s Guide to Sourdough Bread',
                'body'        => 'Making sourdough bread at home sounds intimidating, but once you understand the basic principles it becomes a deeply satisfying hobby. In this guide we walk through creating a starter from scratch, maintaining it, understanding fermentation, and baking your first loaf. We cover hydration levels, scoring techniques, and how to achieve that coveted open crumb and blistered crust. Common mistakes and how to troubleshoot them are covered in detail so you do not have to learn the hard way.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 8],
            ],
            [
                'title'       => 'Exploring Japanese Street Food',
                'body'        => 'Japan\'s street food culture is one of the most vibrant and delicious in the world. From takoyaki in Osaka to taiyaki in Tokyo, creamy ramen in Sapporo to fresh seafood at Tsukiji market, eating your way through Japan is an adventure in itself. In this post we introduce 20 must-try street foods, where to find the best versions of each, and the etiquette around eating on the go in Japanese culture.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 4],
            ],
            [
                'title'       => 'Easy Weeknight Dinners Under 30 Minutes',
                'body'        => 'After a long day, the last thing most people want to do is spend an hour cooking dinner. These ten recipes prove that quick meals do not have to mean boring meals. From a vibrant Thai basil chicken stir-fry to a creamy one-pan lemon pasta, each dish comes together in 30 minutes or less using ingredients you are likely to have on hand. We include full prep and cook times, ingredient substitution suggestions, and storage tips for leftovers.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 8],
            ],
            [
                'title'       => 'The Science of Perfect Coffee at Home',
                'body'        => 'Great coffee at home is less about expensive equipment and more about understanding the variables that affect extraction: grind size, water temperature, brew ratio, and contact time. In this post we demystify coffee brewing, covering pour-over, French press, AeroPress, moka pot, and espresso methods. We explain how to dial in each method, what to look for when buying beans, proper storage, and why your water quality matters more than you might think.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5],
            ],
            [
                'title'       => 'Plant-Based Meals That Actually Taste Good',
                'body'        => 'One of the biggest misconceptions about plant-based eating is that it means sacrificing flavor. In this post we challenge that assumption with fifteen recipes that are genuinely satisfying, protein-rich, and full of complex flavors. From a smoky black bean chili to a rich butternut squash and chickpea curry, these dishes will appeal to omnivores and vegans alike. We also discuss practical tips for transitioning to a more plant-forward diet without feeling deprived.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 6],
            ],
            [
                'title'       => 'How to Host a Dinner Party on a Budget',
                'body'        => 'Hosting a dinner party does not require a professional kitchen or a large budget. With some smart planning and a menu that leans on seasonal, affordable ingredients, you can create a memorable evening for your friends without the stress. In this post we share a complete budget dinner party menu — including a starter, main, and dessert — with a step-by-step timeline, shopping list, and cost breakdown. We also share tips on setting a beautiful table without expensive decorations.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 7],
            ],
            [
                'title'       => 'Fermentation at Home: Kimchi, Kombucha, and More',
                'body'        => 'Fermented foods are having a well-deserved moment in the spotlight. Beyond their gut health benefits, fermented foods like kimchi, sauerkraut, kombucha, and kefir offer complex, addictive flavors that you simply cannot get from fresh ingredients. In this beginner\'s guide we walk through the science of lacto-fermentation and yeast fermentation, with step-by-step recipes for classic kimchi, a basic kombucha brew, and a simple water kefir. Safety, equipment, and troubleshooting are all covered.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 6],
            ],
            [
                'title'       => 'Regional Italian Cuisine Beyond Pizza and Pasta',
                'body'        => 'When most people think of Italian food, pizza and pasta come to mind immediately. But Italian cuisine is extraordinarily regional, and many of its greatest dishes are virtually unknown outside Italy. In this post we explore the food traditions of Emilia-Romagna, Puglia, Sicily, Piedmont, and Sardinia, highlighting signature dishes, key ingredients, and the history behind each region\'s culinary identity. Consider this your guide to eating authentically in Italy.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 4],
            ],
            [
                'title'       => 'Knife Skills Every Home Cook Should Master',
                'body'        => 'A sharp knife and proper technique will make more difference to your cooking than almost any piece of equipment you can buy. In this post we cover the fundamental knife skills every home cook should develop: the rock chop, the push cut, julienne, brunoise, chiffonade, and how to break down a whole chicken. We also explain how to choose the right knife for different tasks, how to keep your knives sharp with a honing rod and whetstone, and proper storage.',
                'category_id' => 3,
                'status'      => 'published',
                'tags'        => [5, 8],
            ],

            // ── Lifestyle ───────────────────────────────────────────────────
            [
                'title'       => 'How to Live a Healthier Lifestyle',
                'body'        => 'Living a healthy lifestyle does not have to be complicated. Small changes in your daily routine can have a big impact on your overall health and wellbeing. In this post we share practical tips for eating better, exercising more, and reducing stress. Start with small steps and gradually build healthy habits that will last a lifetime. We focus on sustainable changes rather than fad diets or extreme fitness challenges, because consistency is what actually moves the needle on long-term health.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'Building a Morning Routine That Actually Works',
                'body'        => 'The way you start your morning sets the tone for the entire day. But not every productivity guru\'s 5am routine is right for everyone. In this post we help you design a morning routine that is realistic, sustainable, and tailored to your goals. We cover the science of sleep inertia, the benefits of delaying your phone check, light exposure for circadian rhythm regulation, and how to sequence activities for maximum mental clarity. Start small and build from there.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'The Minimalist Home: Decluttering Your Space',
                'body'        => 'A cluttered environment leads to a cluttered mind. The minimalist approach to home design is not about living with nothing — it is about being intentional with what you keep. In this post we walk through a room-by-room decluttering process inspired by the KonMari method and Swedish Death Cleaning. We cover how to make decisions about what to keep, donate, or discard, how to organize what remains, and how to maintain a tidy space without it becoming a constant chore.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [8],
            ],
            [
                'title'       => 'How to Read More Books This Year',
                'body'        => 'Most people wish they read more, but struggle to find the time or maintain the habit. In this post we share a practical system for reading more books consistently, without carving out large blocks of time. We discuss habit stacking, audiobooks for commuting, the 20-page rule, how to choose books you will actually finish, and why it is completely fine to abandon a book that is not working for you. Small changes in your daily routine can add up to 20 or 30 books a year.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [8],
            ],
            [
                'title'       => 'Managing Stress in a Busy World',
                'body'        => 'Chronic stress is one of the defining health challenges of modern life. While we cannot eliminate all sources of stress, we can build resilience and develop effective coping strategies. In this post we look at the physiological effects of stress on the body, evidence-based interventions including mindfulness, exercise, sleep hygiene, and social connection, and practical techniques like the 4-7-8 breathing method and progressive muscle relaxation. Understanding your stress triggers is the first step.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'Creating a Sustainable Home on Any Budget',
                'body'        => 'Living more sustainably does not require a full home renovation or an unlimited budget. Many of the most impactful changes are simple and inexpensive. In this post we cover practical steps anyone can take: reducing single-use plastics, switching to energy-efficient lighting, composting kitchen scraps, buying second-hand, and making smarter choices at the grocery store. We also look at higher-investment changes like solar panels and heat pumps for those ready to go further.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'The Benefits of a Digital Detox',
                'body'        => 'The average person now spends over seven hours per day looking at screens. While technology has brought enormous benefits to our lives, the constant connectivity comes with a cost: increased anxiety, disrupted sleep, shorter attention spans, and a reduced capacity for deep focus. In this post we explore the science behind digital addiction, the benefits of intentional breaks from technology, and a practical guide to your first weekend digital detox. You might be surprised how much better you feel.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'Journaling for Mental Clarity: A Practical Guide',
                'body'        => 'Journaling is one of the simplest and most evidence-backed tools for mental wellbeing. Regular writing practice has been shown to reduce anxiety, improve self-awareness, help process difficult emotions, and clarify thinking. In this post we cover different journaling styles — gratitude journaling, morning pages, bullet journaling, and expressive writing — and help you figure out which approach suits your personality and goals. We also share prompts to get you started when you are staring at a blank page.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'How to Sleep Better Starting Tonight',
                'body'        => 'Sleep is the single most important thing you can do for your health, yet most people are chronically under-slept. In this evidence-based guide we cover sleep hygiene fundamentals, how to optimize your bedroom environment, the role of light and temperature, the relationship between exercise timing and sleep quality, and how to handle insomnia without medication. We also bust several common sleep myths, including the idea that you can meaningfully catch up on sleep over the weekend.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 8],
            ],
            [
                'title'       => 'Finding Balance: Work, Life, and Everything In Between',
                'body'        => 'Work-life balance is one of those phrases that gets thrown around constantly but is rarely examined critically. What does it actually mean, and is it even achievable in the modern economy? In this post we challenge the traditional framing and instead propose a work-life integration model that is more realistic for people with demanding careers. We cover setting boundaries, the importance of deliberate recovery time, how to protect weekends, and why saying no is a skill worth developing.',
                'category_id' => 4,
                'status'      => 'published',
                'tags'        => [6, 7, 8],
            ],

            // ── Business ────────────────────────────────────────────────────
            [
                'title'       => 'Building Your First Business — A Beginner Guide',
                'body'        => 'Starting a business can be one of the most rewarding and challenging things you will ever do. In this post we share a step by step guide for aspiring entrepreneurs who want to turn their ideas into reality. From writing a business plan to finding your first customers, we cover everything you need to know to get started on your entrepreneurial journey. We also discuss the most common reasons new businesses fail and how to avoid those pitfalls.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'How to Validate a Business Idea Before You Build',
                'body'        => 'Most startups fail not because they were poorly built, but because they were solving a problem nobody actually had. Validation is the process of testing your assumptions before you invest significant time and money. In this post we walk through lean validation techniques including customer interviews, landing page tests, pre-sales, and concierge MVPs. We also discuss how to interpret the feedback you get and how to know when you have validated enough to move forward.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'Freelancing in 2026: Everything You Need to Know',
                'body'        => 'Freelancing has never been more accessible, but it is also more competitive than ever. In this comprehensive guide we cover everything from setting up as a sole trader, pricing your services, finding clients, managing contracts and invoices, handling taxes, and avoiding the feast-or-famine income cycle. Whether you are a developer, designer, writer, or consultant, the fundamentals of running a successful freelance practice are the same. This guide gives you the foundation to build a sustainable independent career.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'Content Marketing Strategies That Actually Work',
                'body'        => 'Content marketing is one of the highest ROI marketing strategies available to small businesses, but most companies do it wrong. They produce content without a clear strategy, targeting, or distribution plan, then wonder why nothing happens. In this post we share a practical content marketing framework: defining your audience, identifying the topics they care about, choosing the right content formats, SEO fundamentals, and a distribution strategy that gets your content in front of the right people.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'Personal Finance Fundamentals for Young Professionals',
                'body'        => 'The financial decisions you make in your twenties and thirties have a disproportionate impact on your long-term financial security. In this post we cover the fundamentals every young professional should understand: building an emergency fund, paying off high-interest debt, understanding compound interest, the basics of investing in index funds, and how to think about retirement savings early. We use clear, jargon-free language because personal finance should not require a finance degree.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'How to Write a Business Plan That Gets Funded',
                'body'        => 'A well-written business plan is still one of the most important documents an entrepreneur can produce, whether you are seeking investment, a bank loan, or simply want to think through your business model rigorously. In this guide we walk through every section of a business plan: executive summary, market analysis, competitive landscape, business model, go-to-market strategy, financial projections, and team overview. We include examples and templates to help you get started.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7],
            ],
            [
                'title'       => 'Growing a Small Business with Social Media',
                'body'        => 'Social media is one of the most cost-effective tools available to small businesses, but the landscape changes fast. In this up-to-date guide we cover the platforms that matter most for small business growth in 2026, how to develop a content strategy for each, organic growth tactics versus paid advertising, and how to measure whether your efforts are actually driving business results. We also address the time management challenge of maintaining a consistent social media presence.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'Productivity Systems for Entrepreneurs',
                'body'        => 'Running a business means managing an enormous volume of tasks, decisions, and information every day. Without a reliable productivity system, important things fall through the cracks and reactive work crowds out strategic thinking. In this post we compare several popular productivity methodologies — GTD, PARA, time blocking, the Ivy Lee Method — and discuss how to adapt them for the unique demands of entrepreneurship. The goal is not to be busy, it is to make consistent progress on what matters most.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'Understanding SaaS Metrics That Matter',
                'body'        => 'If you are building a SaaS product, understanding your metrics is not optional — it is the foundation of every important decision you will make. In this post we break down the metrics that actually matter: Monthly Recurring Revenue, Churn Rate, Customer Acquisition Cost, Lifetime Value, Net Revenue Retention, and the LTV:CAC ratio. We explain how to calculate each one, what good benchmarks look like, and how they relate to each other. Getting fluent in these numbers will transform how you run your business.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],
            [
                'title'       => 'How to Hire Your First Employee',
                'body'        => 'Hiring your first employee is a significant milestone for any small business, and it comes with a set of legal, financial, and cultural responsibilities that many founders underestimate. In this guide we walk through the entire process: defining the role, writing a job description, sourcing candidates, conducting structured interviews, making an offer, and onboarding. We also cover the legal requirements around employment contracts, payroll, and workplace policies, so you can get it right from the start.',
                'category_id' => 5,
                'status'      => 'published',
                'tags'        => [7, 8],
            ],

            // ── Draft (one, consistent with original) ───────────────────────
            [
                'title'       => 'Draft Post — Work in Progress',
                'body'        => 'This post is still being written and is not yet ready for publication.',
                'category_id' => 1,
                'status'      => 'draft',
                'tags'        => [1],
            ],
        ];

        foreach ($posts as $data) {
            $tags = $data['tags'];
            unset($data['tags']);

            $post = Post::create(array_merge($data, [
                'user_id' => 1,
                'slug'    => \Str::slug($data['title']),
            ]));

            $post->tags()->sync($tags);
        }
    }
}
