# e-commerce_23 Mission

## Core Goal

Maintain and develop the e-commerce_23 Laravel application (a bespoke Laravel ^7.0 platform).

## Current Status

Local Docker environment successfully running. Catalog data has been cleared from the database, and we just wiped the subcategories and child categories for a fresh start. Fixed an issue with blog post details displaying extremely large font sizes by enforcing a normalized font size and line height through CSS overrides. Resolved file permission errors when saving products, fixed Summernote text editor styling, and implemented rich landing-page styling for product description details supporting floating images, callout notification boxes, feature categories, grid layouts, and clean typography. Specifically updated the product view tab navigation UI to match a sleek white box with blue top-border design ("Description" and "Product Details"). Replaced legacy key-value pairs with a single Summernote WYSIWYG editor for specifications on create/edit product pages across all product types (Standard, Digital, License, Affiliate). Configured ItemRepository to save raw HTML specifications, and updated frontend product detail and compare views to use the `getHtmlSpecifications()` helper, ensuring both raw HTML and legacy JSON specifications render correctly.

**Media Integration:** Removed legacy external "Browse Image" buttons in favor of native toolbar integration. Modified Summernote initialization in `custom.js` to override the default video button, allowing users to upload native video files directly from their machine into the editor. Videos are uploaded asynchronously via AJAX and injected using Summernote's internal `insertNode` API to properly update the editor state. The PHP environment's `upload_max_filesize` and `post_max_size` limits were increased to 100MB via a custom `uploads.ini` generated in the Dockerfile.
Added a centralized Media Gallery in the Admin Panel to upload, view, delete, and easily copy URLs for images to be used across the site.
**Storefront & Admin UI Cleanup:**

- Removed redundant "Manage FAQ" sidebar items from admin interfaces.
- Simplified "Category Management" by removing image upload fields/previews from forms and tables.
- Enabled "Featured Products" section on the homepage and populated it by updating product `is_type` attributes.
- Integrated a full-width promotional banner ("Regenerative Medicine") into the "Our Current Highlight" section for Theme 2.
- Created a new "Highlight Banner" configuration tab in the Admin Panel to dynamically upload and replace the "Our Current Highlight" image without needing manual file uploads.

**SMS Integration:**

- Configured dual SMS notification system for order confirmations using smsbangladesh.com.
- Implemented robust `OrderTotal` calculations for SMS content to display accurate pricing.
- Rewrote SMS trigger functionality to execute asynchronously in the background via `exec()` cURL calls, resolving frontend checkout delay bottlenecks.
- Extended the Admin Panel (Settings -> SMS) to expose a new text area specifically for "Merchant Notification (New Order)".
- Made the SMS messaging completely dynamic, allowing the merchant to configure custom SMS bodies using parsed tags (e.g., `{customer_name}`, `{order_items}`, `{customer_address}`, `{payment_method}`) for both customers and merchants.

**Tiered/Bulk Pricing:**

- Updated the database schema (`items` table) to store dynamic `tier_prices` as JSON.
- Extended `ItemRepository` to calculate tiered pricing on the cart session dynamically based on current item quantity thresholds.
- Added dynamic "add/remove tier" JavaScript logic to the admin dashboard (create and edit pages), enabling dynamic quantity thresholds and their corresponding custom prices.
- Configured frontend views to display a real-time table of bulk pricing tiers beneath the product's short description.

**Courier Integration:**

- **Completed (2026-07-07): Steadfast Courier Integration & API Migration**
  - Integrated "Send to Courier" button in the admin `orders.index` table for bulk-like efficiency.
  - Replaced dead `portal.steadfast.com.bd` endpoint with active `portal.packzy.com` in backend API logic.
  - Added non-JSON response handling to display actual API account errors (like "Account is not active!") instead of failing silently to generic errors.
- Extended the `orders` table to store `steadfast_consignment_id`, `steadfast_tracking_code`, and `steadfast_status`.
- Designed interactive Steadfast integration blocks directly on the Admin Order Invoice page and the main Admin Orders list, with "Send to Courier" and "Update Status" features.

Cleaned up the `[null]` corrupted strings in the database, fixed the 404 jQuery asset reference error in `back-login.blade.php`, and resolved the 500 Internal Server Error on the frontend product detail page and product comparison page by removing legacy `json_decode` references on HTML specifications. Fixed "Undefined property: stdClass::$is_facebook_capi" error on the admin system settings page by introducing null coalescing operators (`??`) to gracefully handle missing database columns prior to running migrations.

**Product Detail Page Refinements:**

- Moved the FAQ and Rating summary (Customer Reviews snapshot) from the top-left product gallery section down into the main Reviews section, displaying them side-by-side.
- Added an "Order via WhatsApp" button on the product details page directly beneath the "Add to Cart" and "Buy Now" buttons.
- Re-aligned the "Add to Cart" and "Buy Now" buttons vertically for a cleaner interface.
- Removed the mandatory tax validation from the admin product creation/edit forms.
- Replaced the duplicate "Product Tags" Key Features rendering with a dedicated `features` column in the database and a new "Key Features" editor field in the Admin Panel.
- Removed the old, redundant review summary box from the product description column and expanded the review column to full width.
- Added a high-level customer review summary section and a responsive FAQ accordion below the product image gallery, now fully refactored to use standard Bootstrap 5 components for correct expand/collapse functionality and visibility.
- Fixed a layout issue where WYSIWYG (Summernote) inline images inside the product description tab were floating out of the container and overlapping the edge and other elements; enforced `display: block` and `float: none` with a `.product-landing-details` clearfix.
- Fixed a bug where Tagify JSON arrays (e.g. `[{"value":"Safe"}]`) would appear visually broken on the frontend by updating `ItemRepository` to robustly `json_decode` the string before storing and updating the frontend `product.blade.php` to decode legacy JSON strings.
- Fixed horizontal overflow on mobile viewports for the product action buttons ("Quantity", "Add to Cart", "Order via WhatsApp", "Buy Now") by implementing flexible wrapping (`flex-wrap`).

## Goal Pivots

N/A

## Production Roadmap

- [x] Establish a functional local Docker development environment (PHP 7.4-apache and MySQL 5.7).
- [x] Resolve database connection and initialization issues.
- [x] Update menu bar items to PRP, PRF, INJECTION, Labware, Dermalfiller, MICRONEEDLING, Care, Threadlifting, Med courses.
- [x] Adjust categories box size and site menu layout so all menu items fit on one line.
- [x] Perfectly align header topbar (Logo, Search Bar, and Compare/Wishlist/Cart toolbar items).
- [x] Hide mobile search icon and menu toggle button from desktop header toolbar.
- [x] Update homepage hero slider banner to `banner 1.png`.
- [x] Update service section to "Nationwide Delivery" and refresh subtitle.
- [x] Remove 3-column promotional banner sections, 2-column discount banner section, Top Rated section, and Flash Sales section from homepage.
- [x] Replace product grid under "Our Current Highlight" with full `banner 2.png` banner view.
- [x] Remove Payment Options section from homepage.
- [x] Clear demo products from Featured Products and Best Seller sections, leaving them ready for manual product additions.
- [x] Update footer "Get In Touch" contact information (Address, Phone, WhatsApp, Email) and social links (Facebook Page/Profile, Instagram, YouTube, WhatsApp), removing working hours and TikTok link.
- [x] Update footer copyright to "All rights reserved By Mac Scientific | Website Designed By : Shohoj Solution".
- [x] Update browser tab title (`title` and `home_page_title`) to "Mac Scientific".
- [x] Update About Us page with Mac Scientific company profile, Mission, and Vision statements.
- [x] Update Privacy Policy page with effective date June 30, 2026 and official policy text.
- [x] Update Terms & Service page with effective date June 30, 2026 and 10 terms & conditions points.
- [x] Update Return Policy page with effective date June 30, 2026 and full Return & Refund policy details.
- [x] Replace FAQ link with Legal Notice page (Effective Date: June 30, 2026).
- [x] Replace How It Works page with Medical Disclaimer page (Effective Date: June 30, 2026).
- [x] Replace legacy key-value pair specifications with a single Summernote WYSIWYG editor.
- [x] Persist raw HTML for specifications instead of JSON-encoded arrays in ItemRepository.
- [x] Modify front compare and product detail views to render specifications raw HTML directly.
- [x] Configure Summernote AJAX image uploading for drag-and-drop/selection of images.
- [x] Implement Summernote specifications editor for all product types (Digital, License, Affiliate).
- [x] Clean up database `[null]` specification string values.
- [x] Resolve `jquery.3.2.1.min.js` 404 asset loading error.
- [x] Resolve 500 Internal Server Error on frontend product detail and compare pages.
- [x] Remove the announcement/newsletter modal popup from the front-end layout.
- [x] Implement dynamic tiered/bulk pricing thresholds configured via the admin dashboard.
- [x] Integrate real-time tiered pricing calculation based on quantity into the session-based cart system.
- [x] Display a bulk pricing table on the frontend product details page.
- [x] Integrate Steadfast Courier API for parcel dispatching and tracking.
- [x] Moved the FAQ and Rating system into the main review section on the product details page.
- [x] Added "Order via WhatsApp" functionality directly on the product view page.
- [x] Updated the default FAQ questions on the product details page to cover COD, delivery times, couriers, tracking, and delivery charges.
- [x] Fixed review submission logic to auto-approve reviews and allow all logged-in users to review without requiring prior purchase.
- [x] Repolished the Customer Reviews summary card with premium UI/UX, gradient progress bars, and properly styled solid golden stars.
- [x] Integrated bKash and Nagad manual payment gateways into the checkout page.
- [x] Styled and customized the checkout payment gateway selection buttons (fitting 4 per row with smaller logos).
- [x] Uploaded custom bKash and Nagad logos as requested by the merchant.
- [x] Fixed `cod_amount` validation error in Steadfast Courier API integration by sending unformatted numeric values instead of comma-formatted strings.
- [x] Determine user requirements for further development or production deployment (Deployed to cPanel).
- [x] Standardized hero slider layout across all themes to match header navigation max-width constraints (boxed layout instead of full-width).
- [x] Applied a 12px border-radius to the hero slider wrapper for a modern curved look.
- [x] Implemented automatic AVIF to WebP image conversion interceptor for seamless media optimization.
- [x] Integrated product media tab system (Photos/Video) on product details page with lazy-loaded YouTube embeds.
- [x] Refactored Product Details layout (Removed left-column stats, stacked action buttons, responsive 50/50 delivery/warranty blocks).
- [x] Removed Delivery Information, Warranty, and Payment Methods sections from the right column of the frontend product details page.
- [x] Rebuilt and relocated the Delivery, Warranty, and Payment Methods block below the product gallery image with an updated bordered design.
- [x] Implemented performance and accessibility optimizations: Added lazy loading to images across all themes, added aria-labels to forms and inputs, and fixed deferred scripts execution logic.
- [x] Fixed missing `<style>` tag around dynamically generated CSS in `master/front.blade.php` that caused raw CSS to render on the live storefront.
- [x] Resolved image visibility issue by migrating from deferred JS `data-src` lazy-loading to native `loading="lazy"` with standard `src` attributes, ensuring above-the-fold images render immediately.
- [x] Fixed Lighthouse accessibility issues (contrast, alt text, target sizes) and layout shifts (unsized images) on themes.
- [x] Converted all existing images to WebP format and modified ImageHelper to automatically encode all future uploads to WebP for optimization and enforcement.
- [x] Added Blog link to the Usefull Links section in the footer.
- [x] Fixed "CSS Broken" issue on live storefront by forcing HTTPS via `AppServiceProvider.php` to prevent browsers from blocking mixed content (HTTP assets over HTTPS).
- [x] Added `latest_db_dump.sql` to Git tracking and automated DB import on the live server to load catalog data instead of the empty template.
- [x] Restored missing `prp_logo.png` image file referenced by the live database to fix the broken header logo.
- [x] Implemented a database image path recovery script (`/fix-db-images`) to rescue missing `.webp` images and revert database fields to the available `.jpg` files after a git deployment wiped out ephemeral storage uploads on Coolify.
- [x] Added persistent volume storage to Coolify container for `/var/www/html/assets/images` to prevent future data loss.
- [x] Switched Coolify application domain from `msbd.shohojsolution.com` to `ms-bd.com` and `www.ms-bd.com`.
- [x] Diagnosed SSLCommerz Sandbox/Test Mode redirect issue for bKash.
- [x] Added missing cPanel product images to the repository to rescue broken images on the new Coolify server.
- [x] Guided user through updating cPanel Zone Editor A and MX records to safely launch the Coolify site while preserving business emails.
- [x] Finalized full site migration from cPanel to Coolify.
- [x] Fixed DomPDF `Class Not Found` error by pushing an updated `vendor.zip` via bash script, correctly installing all required backend packages.
- [x] Configured DomPDF `public_path` and `chroot` options to ensure image assets load properly in the PDF regardless of execution context.
- [x] Changed Steadfast API Key and Secret Key input fields to `password` types in the Shipping settings to ensure privacy (showing as `****`).
- [x] Implemented a dedicated "Download Invoice" button directly on the checkout success view and connected it to a secure new route for guest PDF generation.
- [x] Completely revamped the invoice layout (`print.blade.php`) with a clean, professional, table-based design optimized specifically for DomPDF, avoiding rendering issues caused by complex Bootstrap flexbox/grid classes.
- [x] Changed PDF font to `DejaVu Sans` to natively support Unicode currency symbols (e.g., Taka `৳`), fixing the issue where they displayed as `?`.
- [x] Implemented a "Trash Bin" for deleted orders using Laravel's SoftDeletes, preserving related tracks/notifications, complete with "Restore" and "Permanently Delete" functionality and a new sidebar menu.
- [x] Added a "Total Orders" purchase history column to the admin order tables to instantly see how many previous orders a specific customer (by ID or email) has made.
- [x] Fixed slider image browser caching issue by dynamically appending cache-busting timestamps to image URLs across all frontend themes.
- [x] Resolved PDF invoice generation crash by updating the `barryvdh/laravel-dompdf` facade namespace for v2 compatibility in `config/app.php` and re-zipping `vendor.zip` (Coolify deployment strictly relies on `vendor.zip` extraction rather than `composer install`).
- [x] Added an immediate "Download Invoice" button to the checkout success page for buyers (works for guests and logged-in users).
- [x] Built a modular API Payment Gateway architecture starting with the `BkashTokenizedService` and `BkashPaymentController`, enabling fully automated Tokenized bKash Checkout and B2B Webhook IPN integrations for instant order payment statuses.
- [x] Refactored slider creation/edit UI to remove hardcoded theme tabs, instead automatically adopting the system's global active theme.
- [x] Removed required validation constraints and brand logo inputs from the slider forms as requested.
- [x] Standardized slider image size recommendations to 3550x1440 across the board.
- [x] Patched frontend slider CSS to allow responsive 'height: auto' rendering on mobile displays, preventing unwanted image shrinking or context clipping.
- [x] Diagnosed slider missing image bug. Found that Coolify persistent volume was wrongly mounted to `/var/www/html/assets/images` instead of the web server's correct upload path `/var/www/html/source_code/assets/images`. 
- [x] Corrected the volume mount in Coolify and redeployed. Future uploads will now correctly persist across Git deployments.
- [x] Added a status column to the services table and an active/deactive dropdown toggle in the admin panel to allow hiding/unhiding individual features in the frontend Services section.
- [x] Fixed PDF invoice generation to support Bengali text and the Taka sign (৳) by downloading and registering the `kalpurush` TTF font and explicitly defining it in the `@font-face` of the print views.
- [x] Fixed an `Invalid argument supplied for foreach()` error during checkout submission by globally protecting against empty or expired cart sessions in the `CheckoutController`.
- [x] Updated the "All Products" section on the homepage to display 8 products across 2 rows instead of the default 4 products.
- [x] Added a "Made with Shohoj Solution" watermark to the bottom right corner of the admin login page.
- [x] Fixed the "Total Orders" column in the admin orders table to calculate based on the billing phone or email first, ensuring that orders placed by admins on behalf of customers correctly display the individual customer's total order count instead of the admin's.
- [x] Converted bKash back to the REAL API payment integration, replacing the manual payment form by removing the manual redirect and adding the bKash API checkout modal.
- [x] Added bKash API credential fields (App Key, App Secret, Username, Password, Sandbox Checkbox) directly to the Admin Panel (Settings -> Payment), so users no longer need to edit the .env file manually.
- [x] Restored the Admin Payment Settings sidebar to only show local gateways (COD, SSL Commerz, Bank Transfer, bKash, Nagad) and added API credential fields (Merchant ID, Public Key, Private Key, Sandbox) for Nagad.
- [x] Added a "Sync Existing Images" button to the Media Gallery to scan the `assets/images/` directory and register unlisted photos into the database.
- [x] Fixed Media Gallery delete button routing issue by switching to unique, per-item hardcoded modals.
- [x] Added Bulk Delete feature (checkboxes and Select All) to Media Gallery.
- [x] Added Draft & Auto-Save feature to Product Editor. Uses browser `localStorage` for offline protection and adds a dedicated 'Save Draft' and 'Cancel' button.
- [x] Reduced the vertical spacing above the hero slider and between the "Our Current Highlight" and "Featured Products" sections specifically for mobile views (max-width: 767px).
- [x] Fixed highlight banner image upload memory exhaustion and client-side preview issues.
- [x] Redesigned and refactored the A4 Invoice PDF generation system using specialized Blade components (document, header, meta, parties, items, summary, footer) to accurately match the visual reference and ensure DOMPDF renders exactly at 210x297mm.
- [x] Fixed syntax error in highlight.blade.php.
- [x] Added System Restore functionality allowing administrators to upload `.sql` files and safely restore system backups from a new Backup & Restore view.
