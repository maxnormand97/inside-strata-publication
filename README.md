# The Strata Review — WordPress Theme

A custom WordPress theme for The Strata Review publication site. Clean, responsive, editorial-style layout built with vanilla CSS — no frameworks.

## Features

- **Homepage hero grid** — 1 large featured article + 2 secondary articles
- **Latest news grid** — 3-column responsive article cards
- **Category spotlight** — Highlight posts from a specific category (e.g. "Industry News")
- **Single article template** — Hero image, author/date meta, related articles
- **Promo/ad slots** — Placeholder components for banner ads
- **Newsletter section** — Mailchimp-ready signup block (`[mc4wp_form]` shortcode)
- **Responsive layout** — CSS grid with mobile-first breakpoints
- **Sticky header** with mobile hamburger nav

## Requirements

- WordPress 6.0+
- PHP 7.4+

## Installation

1. Download or clone this repo into your WordPress themes directory:
   ```
   wp-content/themes/inside-strata-theme/
   ```
2. Activate the theme in **Appearance → Themes**
3. Create a menu in **Appearance → Menus** and assign it to the "Primary Menu" location

## Test Data

A seed script is included to populate the site with sample articles, categories, and a navigation menu.

1. Open `seed.php` and set `STRATA_SEED_ENABLED` to `true`
2. Log in to WordPress admin
3. Visit `http://your-site.local/wp-content/themes/inside-strata-theme/seed.php`
4. Set `STRATA_SEED_ENABLED` back to `false` when done

## Theme Structure

```
├── style.css           # All theme styles
├── functions.php       # Theme setup, enqueues, image sizes
├── header.php          # Site header and navigation
├── footer.php          # Site footer
├── front-page.php      # Homepage template
├── single.php          # Single article template
├── category.php        # Category archive template
├── index.php           # Fallback template
├── seed.php            # Test data seeder (disabled by default)
└── js/
    └── main.js         # Mobile menu toggle
```

## Category Spotlight

The homepage includes a category spotlight section that queries posts from a category with the slug `industry-news`. To add more spotlights, duplicate the spotlight block in `front-page.php` and change the category slug.

## License

Private — The Strata Review.
