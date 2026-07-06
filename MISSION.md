# e-commerce_23 Mission

## Core Goal

Maintain and develop the e-commerce_23 Laravel application (a bespoke Laravel ^7.0 platform).

## Current Status

Local Docker environment successfully running. Catalog data has been cleared from the database. Resolved file permission errors when saving products, fixed Summernote text editor styling, and implemented rich landing-page styling for product description details supporting floating images, callout notification boxes, feature categories, grid layouts, and clean typography. Specifically updated the product view tab navigation UI to match a sleek white box with blue top-border design ("Description" and "Product Details"). Replaced legacy key-value pairs with a single Summernote WYSIWYG editor for specifications on create/edit product pages. Configured ItemRepository to save raw HTML specifications, and modified compare and product detail views to render specifications raw HTML directly. Set up an AJAX image upload endpoint for Summernote editors, allowing uploaded images inside specifications to be stored under `assets/images/`.

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
- [ ] Determine user requirements for further development or production deployment.
