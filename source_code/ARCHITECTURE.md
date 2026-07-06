# Comprehensive Architecture & System Documentation: e-commerce_23

## 1. Executive Summary
This document provides a highly detailed, comprehensive breakdown of the technical architecture, core features, database structure, and explicit modifications applied to **e-commerce_23**. This project is hosted within the Shohoj Solution Demo Portal environment and is accessible at `http://e-commerce_23.ecommerce.localhost:8080/`.

## 2. Technical Stack & Core Architecture
- **Base Framework:** Laravel ^7.0
- **PHP Version Requirement:** ^7.2.5
- **Detected CMS / Platform:** Custom Laravel Framework
- **Application Root:** `/var/www/html/ecommerce/e-commerce_23/core`

This project appears to be a bespoke Laravel application.

### Core Dependencies
The application relies on several critical composer packages to function. A snapshot of the production dependencies includes:
- `php`: ^7.2.5
- `anhskohbo/no-captcha`: ^3.3
- `authorizenet/authorizenet`: ^2.0
- `cartalyst/stripe-laravel`: ^12.0
- `doctrine/dbal`: ^2.12.1
- `fideloper/proxy`: ^4.2
- `fruitcake/laravel-cors`: ^1.0
- `guzzlehttp/guzzle`: ^6.3
- `intervention/image`: ^2.6
- `laravel/framework`: ^7.0
- `laravel/socialite`: ^5.2
- `laravel/tinker`: ^2.0
- `mercadopago/dx-php`: 2.2.1
- `mollie/laravel-mollie`: ^2.0
- `paypal/rest-api-sdk-php`: ^1.14
- `phpmailer/phpmailer`: ^6.1
- `rachidlaasri/laravel-installer`: ^4.1
- `razorpay/razorpay`: ^2.5
- `spatie/laravel-cookie-consent`: ^2.12
- `spatie/laravel-sitemap`: ^5.8.0
- `twilio/sdk`: ^6.28
- `zanysoft/laravel-zip`: ^1.0


## 3. Database Schema & Data Models
The application is connected to the MySQL database `demo_ecommerce_e-commerce_23`.
The database consists of **44** tables, which form the structural backbone of the e-commerce operations. 

**Complete Table Overview:**
> admins, attribute_options, attributes, banners, bcategories, brands, campaign_items, categories, chield_categories, countries, currencies, email_templates, extra_settings, faqs, fcategories, galleries, home_cutomizes, items, languages, messages, migrations, notifications, orders, pages, payment_settings, posts, promo_codes, reviews, roles, services, settings, shipping_services, sitemaps, sliders, socials, states, subcategories, subscribers, taxes, tickets, track_orders, transactions, users, wishlists

*Analysis of the schema reveals the complexity of the application, encompassing standard e-commerce flows (products, orders, customers) alongside extended features like localized translations, robust settings management, and varied payment gateway configurations.*

## 4. Application Routing & Endpoints
The routing topology dictates how incoming HTTP requests are mapped to controllers.
The following route definition files are present in the `routes/` directory:
> api.php, channels.php, console.php, web.php

*Typically, `web.php` handles standard storefront and frontend customer interactions, `api.php` dictates RESTful endpoints for mobile applications or headless frontends, and `admin.php` (if present) isolates backend managerial routes.*

## 5. Controller Architecture & Business Logic
Controllers orchestrate the business logic of the application. The system contains **" . count(Array) . "** distinct controllers.
A sample of the core controllers driving this application:
> ForgotController, LoginController, ForgotController, LoginController, RegisterController, AccountController, AffiliateController, AttributeController, AttributeOptionController, BackupController, BcategoryController, BrandController, BulkDeleteController, CampaignController, CategoryController, ChieldCategoryController, CsvProductController, CurrencyController, EmailSettingController, FaqController, FcategoryController, FeatureController, HomePageController, ItemController, LanguageController, NotificationController, OrderController, PageController, PaymentSettingController, PostController, PromoCodeController, ReviewController, RoleController, ServiceController, SettingController, ShippingServiceController, SitemapController, SliderController, SmsSettingController, SocialController, StaffController, StateController, SubCategoryController, SubscriberController, TaxController, TicketController, TranactionController, UserController, Controller, CartController ... and 16 more.

## 6. Core Features & Capabilities Deep Dive
Based on the programmatic analysis of the database schema and application structure, this project supports the following advanced capabilities:

Standard E-Commerce Features (Products, Categories, Orders, Users).

### Security & Authentication
The platform utilizes Laravel's native authentication scaffolding. Security is enforced via robust middleware protecting the admin routes, alongside CSRF token verification for all standard web forms. Passwords are securely hashed using Bcrypt.

### Media & Asset Management
Uploaded media, product images, and categorical banners are managed through a centralized storage driver (typically mapped to `storage/app/public` and symlinked to `public/storage`).

## 7. Modifications & Environment Preparation
To integrate this project into the automated Demo Portal, several precise architectural modifications were applied. These changes ensure seamless previews and reliable master administration access.

### Applied Modifications:
- **Master Admin Seeded:** A master admin account (`siteadmin@shohojsolution.com` / `@Testadmin2026`) was cloned and injected directly into the database using Eloquent via `add_admin.php`.
- **Portal Admin Mapping:** The specific admin login route was dynamically mapped and cached in the central `metadata.json` for the Demo Portal.

## 8. Debugging & Maintenance Playbook
For developers attempting to debug or modify this system in the future, adhere to the following protocols:

1. **Environment Context:** Always execute CLI commands from within the PHP-FPM Docker container. 
   - `docker compose exec php sh`
   - `cd /var/www/html/ecommerce/e-commerce_23/core`
2. **Cache Clearing:** If modifications to `.env` or configurations are not reflecting, clear the caches:
   - `php artisan optimize:clear`
3. **Asset Resolution Issues:** If the site appears broken (missing CSS/JS) and assets are attempting to load on port 80 instead of 8080, verify that the `URL::forceRootUrl` hack remains intact within `AppServiceProvider.php`.

---
*Document automatically generated by the Antigravity Code Analysis System. Last Updated: " . date('Y-m-d H:i:s') . "*