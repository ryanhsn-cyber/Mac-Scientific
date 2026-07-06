# e-commerce_23 - Production Build

This is the production-ready build for e-commerce_23.

## Contents
1. source_code/: The fully modified, optimized, and patched Laravel codebase.
2. database.sql: The database dump containing all configurations and master admin accounts.

## Admin Credentials
- Email: siteadmin@shohojsolution.com
- Password: @Testadmin2026

## Deployment Instructions
1. Upload the source_code to your production server (e.g. cPanel, Forge, VPS).
2. Import database.sql into your new MySQL database.
3. Update the .env file in the root of the source code with your new database credentials and APP_URL.
4. Point your web server (Nginx/Apache) to the public/ directory (or the root if using cPanel).
