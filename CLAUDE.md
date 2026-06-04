# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Rules
- Always read files before changing them!
- Before writing a commit message or committing, always run `git diff --stat` and `git status` to see exactly what changed.

## Commands

```bash
# First-time setup (install deps, generate .env, run migrations, build assets)
composer run setup

# Start all dev processes concurrently (PHP server, queue, logs, Vite)
composer run dev

# Run tests
composer run test

# Run a single test file
php artisan test tests/Feature/ExampleTest.php

# Database migrations
php artisan migrate

# Format/lint PHP code
./vendor/bin/pint

# Build frontend assets for production
npm run build
```

## Architecture

Laravel 13 app using Blade templating, Tailwind CSS 4, and Vite.

**Tech stack:**
- PHP 8.3+ / Laravel 13.8 with Eloquent ORM
- Blade templates with Tailwind CSS 4.0 (via `@tailwindcss/vite`)
- Vite for asset bundling (`vite.config.js`)
- Database-backed sessions, cache, and job queue

**Request flow:** `public/index.php` → Laravel kernel → routes (`routes/web.php`) → controllers (`app/Http/Controllers/`) → Blade views (`resources/views/`)

**Testing:** PHPUnit with two suites — `Unit` (`tests/Unit/`) and `Feature` (`tests/Feature/`). Feature suite boots the full framework. Config in `phpunit.xml`.
