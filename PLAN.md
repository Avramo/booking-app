# MVP Plan — Vacation Booking App

## Starting point

Get one thing working end-to-end first:
**User sees a package → clicks book → booking is saved.**

That requires exactly 2 new tables. Everything else (providers, services, claims, payments) comes after.

---

## Step 1: `packages` table

This is the vacation plan an admin creates (e.g. "5 Days Tel Aviv + North").

**Why these columns only:**
- Keep it to what you need to render a page and take a booking.
- No pricing details, no service breakdown yet — add those when you build those features.

**Create the migration:**
```bash
php artisan make:migration create_packages_table
```

**Columns to add:**
```php
$table->id();
$table->string('name');               // "5 Days Tel Aviv + North"
$table->string('slug')->unique();     // URL: /packages/5-days-tel-aviv
$table->text('description');
$table->integer('duration_days');
$table->boolean('is_active')->default(false); // admin publishes when ready
$table->timestamps();
```

**Create the model:**
```bash
php artisan make:model Package
```

No relationships needed yet — add them as you build features.

---

## Step 2: `bookings` table

One row = one user booking one package.

**Create the migration:**
```bash
php artisan make:migration create_bookings_table
```

**Columns to add:**
```php
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->foreignId('package_id')->constrained()->cascadeOnDelete();
$table->date('start_date');
$table->date('end_date');
$table->string('status')->default('initiated');
// statuses: initiated → confirmed → cancelled
// keep it as a plain string for now, tighten to enum later
$table->text('notes')->nullable();   // user's special requests
$table->timestamps();
```

**Create the model:**
```bash
php artisan make:model Booking
```

**Add relationships:**
- `Booking` → `belongsTo(User)`, `belongsTo(Package)`
- `User` → `hasMany(Booking)`
- `Package` → `hasMany(Booking)`

---

## Step 3: Run migrations

```bash
php artisan migrate
```

Check it worked:
```bash
php artisan migrate:status
```

---

## What comes next (decide when you get there)

- **Booking fee / Stripe** — add `booking_fee_cents` + `stripe_payment_intent_id` to `bookings`
- **Providers** — new `providers` table once you're ready to build the notification flow
- **Services per booking** — `booking_services` table once providers exist
- **Claim system** — `provider_claims` table when building the first-grab flow
- **Apartments** — separate table once you need availability management
