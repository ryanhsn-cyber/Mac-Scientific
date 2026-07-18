# e-commerce_23 Mission

## Core Goal

Maintain and develop the e-commerce_23 Laravel application (a bespoke Laravel ^7.0 platform).

## Current Status

Local Docker environment successfully running. Catalog data has been cleared from the database, and we just wiped the subcategories and child categories for a fresh start. Resolved file permission errors when saving products, fixed Summernote text editor styling, and implemented rich landing-page styling for product description details supporting floating images, callout notification boxes, feature categories, grid layouts, and clean typography. Specifically updated the product view tab navigation UI to match a sleek white box with blue top-border design ("Description" and "Product Details"). Replaced legacy key-value pairs with a single Summernote WYSIWYG editor for specifications on create/edit product pages across all product types (Standard, Digital, License, Affiliate). Configured ItemRepository to save raw HTML specifications, and updated frontend product detail and compare views to use the `getHtmlSpecifications()` helper, ensuring both raw HTML and legacy JSON specifications render correctly.

**Media Integration:** Removed legacy external "Browse Image" buttons in favor of native toolbar integration. Modified Summernote initialization in `custom.js` to override the default video button, allowing users to upload native video files directly from their machine into the editor. Videos are uploaded asynchronously via AJAX and injected using Summernote's internal `insertNode` API to properly update the editor state. The PHP environment's `upload_max_filesize` and `post_max_size` limits were increased to 100MB via a custom `uploads.ini` generated in the Dockerfile.

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
