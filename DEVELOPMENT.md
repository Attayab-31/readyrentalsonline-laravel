# Local development snapshot

This repository contains the ReadyRentalsOnline Laravel application captured from production on 2026-09-29. The lock file records Laravel 11.29.0.

Production `.env`, installed dependencies, and runtime data are intentionally excluded. The directories `public/resources/files/dynamic` and `public/resources/files/e-signs` are local placeholders only; production application files and signatures are not included. Copy `.env.example` to `.env`, configure a local database and local-only services, then install dependencies from the checked-in lock files. Do not add production secrets or customer documents to Git.


Stripe settings use STRIPE_KEY, STRIPE_SECRET, STRIPE_WEBHOOK_SECRET, and STRIPE_MODE. The sample defaults to test mode and contains no account keys. Use test credentials locally; never commit production secrets.

