# Ready Rentals Online

Ready Rentals Online is a Laravel web application built for [ReadyRentalsOnline.com](https://readyrentalsonline.com), a rental housing company serving tenants and property managers. The application brings public property discovery and rental inquiries together with the authenticated management portal, tenant messaging, applications, invoices, and online invoice payments.

## Project and contacts

| Role | Contact |
| --- | --- |
| Client | [Ready Rentals Online](https://readyrentalsonline.com) |
| Developer | [attayabpc2@gmail.com](mailto:attayabpc2@gmail.com) |
| Developer's company | [Automivex](https://automivex.com) |
| Developer phone | [+92 317 4026038](tel:+923174026038) |

## Features

- Public rental property listings, property details, inquiries, and sharing.
- Online rental application and supporting application document workflows.
- Authenticated property-management portal, user management, and tenant accounts.
- Tenant and staff messaging with email notifications.
- Invoice management and tenant invoice-payment pages.
- Stripe card and ACH payment workflows with webhook processing.
- Branded contact, invoice, payment, chat, verification, and password-reset emails.

## Technology

- PHP 8.2 or later and Laravel 11.
- MySQL/MariaDB or SQLite, configured through Laravel's database environment variables.
- Composer for PHP dependencies.
- Node.js and npm for Vite assets.
- Stripe PHP SDK for online payments.

See `composer.json` and `package.json` for the authoritative dependency requirements.

## Local development setup

1. Install PHP, Composer, Node.js, npm, and a database supported by Laravel.
2. Install dependencies:

   ```sh
   composer install
   npm ci
   ```

3. Create a local environment file and application key:

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

   On Windows PowerShell, use `Copy-Item .env.example .env` instead of `cp`.

4. Configure `.env` for the local database, application URL, mail transport, and any integrations you intend to test. Keep real credentials in `.env`; never commit them.
5. Run database migrations:

   ```sh
   php artisan migrate
   ```

6. Compile frontend assets:

   ```sh
   npm run build
   ```

7. Start the local application:

   ```sh
   php artisan serve
   ```

   For frontend development with hot reload, run `npm run dev` in a second terminal.

The example environment uses safe local defaults. The `log` mailer records mail locally instead of delivering it. Stripe credentials and webhook signing secrets are not included; use Stripe test-mode credentials for local payment testing.

## Tests

Run the test suite with:

```sh
php artisan test
```

The test configuration uses an in-memory SQLite database, the array mailer, and synchronous queues. Tests do not send email or process live payments.

## Production deployment

Deploy from a reviewed release and configure production secrets and services outside source control. At a minimum:

1. Set production environment values, including `APP_ENV=production`, `APP_DEBUG=false`, a secure `APP_KEY`, database credentials, mail transport, and Stripe live-mode credentials.
2. Install optimized production dependencies and build frontend assets:

   ```sh
   composer install --no-dev --prefer-dist --optimize-autoloader
   npm ci
   npm run build
   ```

3. Run migrations and refresh Laravel's production caches:

   ```sh
   php artisan migrate --force
   php artisan optimize
   ```

4. Point the web server document root to `public/`, serve the application over HTTPS, and configure the Stripe webhook endpoint at `/stripe/webhook` with the production webhook signing secret.
5. Ensure Laravel's `storage/` and `bootstrap/cache/` directories are writable by the application process. Configure queue workers and scheduled tasks if enabled for the deployment.
6. Verify a health check, mail delivery, payment flow, and webhook processing in the production environment before announcing the release.

Do not commit `.env`, Stripe secrets, SMTP passwords, customer data, tenant documents, uploaded applications, or generated runtime logs.

## Repository notes

- `app/`, `routes/`, and `resources/views/` contain the Laravel application, routing, and server-rendered interface.
- `database/migrations/` contains database schema changes.
- `public/` contains static and compiled web assets.
- `tests/` contains automated tests.
- `DEVELOPMENT.md` provides additional repository and workflow notes for developers.

## Ownership and attribution

This application was developed for [Ready Rentals Online](https://readyrentalsonline.com) by the developer reachable at [attayabpc2@gmail.com](mailto:attayabpc2@gmail.com), whose company is [Automivex](https://automivex.com). Third-party packages retain their respective licenses; consult their package metadata and license files.
