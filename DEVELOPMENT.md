# Developer Guide

This document supplements the project overview and deployment instructions in [README.md](./README.md). The application is maintained for [Ready Rentals Online](https://readyrentalsonline.com).

## Ownership and contacts

- Developer: [attayabpc2@gmail.com](mailto:attayabpc2@gmail.com)
- Developer's company: [Automivex](https://automivex.com)
- Developer phone: [+92 317 4026038](tel:+923174026038)
- Client: [Ready Rentals Online](https://readyrentalsonline.com)

## Environment and secrets

- Use `.env.example` as a starting point for a new local environment.
- Keep `.env`, credentials, webhook signing secrets, uploaded tenant documents, and runtime logs out of Git.
- The example configuration is for local development. Its `log` mailer does not deliver email, and its Stripe values are blank.
- Use a disposable local database and Stripe test mode when exercising application workflows.
- The project test configuration uses in-memory SQLite and array-based mail, so tests do not require production services.

## Common commands

```sh
composer install
npm ci
php artisan key:generate
php artisan migrate
npm run build
php artisan test
```

Run `php artisan serve` for the local application and `npm run dev` when working with Vite's development server. For detailed setup and deployment steps, see [README.md](./README.md).

## Change and release checks

Before submitting a change:

1. Run focused tests for the affected feature, then the relevant broader test suite.
2. Run `npm run build` when frontend assets or Vite inputs change.
3. Check `git diff --check` and review the full diff.
4. Confirm configuration changes do not introduce secrets or unsafe production defaults.
5. For deployment, follow the production checklist in [README.md](./README.md).
