# CLAUDE.md — Ultimate Addons for Beaver Builder Lite

## Project Overview

**Plugin:** Ultimate Addons for Beaver Builder – Lite (UABB Lite)
**Version:** 1.6.7
**Author:** Brainstorm Force
**Text Domain:** `uabb`
**Slug:** `ultimate-addons-for-beaver-builder-lite`

A free WordPress plugin that extends Beaver Builder with 13 additional design modules and a cloud template library. Requires Beaver Builder (any edition) to be installed and active.

---

## Tech Stack

- **Language:** PHP 7.0+ (PHPStan targets 7.0, tested through 8.x)
- **Platform:** WordPress 4.6+ (tested up to 6.9)
- **Dependency:** Beaver Builder (free or paid) — plugin aborts gracefully if absent
- **PHP dependencies:** Composer (`phpcs`, `phpstan`, `wpcs`, `bsf-analytics`, `astra-notices`)
- **Node dependencies:** npm + Grunt (i18n, readme-to-markdown, zip build)
- **CI/CD:** GitHub Actions (AI code review on PRs, SVN deploy on tags, asset sync on master)
- **Code quality:** PHPCS + WordPress Coding Standards, PHPStan level 9

---

## Repository Layout

```
bb-ultimate-addon.php       # Plugin entry point — defines constants, bootstraps UABB_Init
classes/                    # All PHP class files
  class-uabb-init.php       # Orchestrates all includes, hooks, module loading
  class-uabb-helper.php     # Static utility: module lists, branding, option helpers
  class-uabb-admin-settings.php
  class-uabb-cloud-templates.php
  uabb-global-settings.php  # UABB_Global_Styling — global style AJAX + storage
  class-uabb-wpml.php       # WPML module translation registration
modules/                    # One subdirectory per module (13 total)
  {slug}/{slug}.php          # Extends FLBuilderModule + registers via FLBuilder::register_module()
  {slug}/css/               # frontend.css, frontend.css.php
  {slug}/js/                # frontend.js
  {slug}/includes/          # frontend.php (HTML template)
includes/                   # Admin settings view partials (PHP/HTML)
fields/                     # Custom BB field types (_config.php + uabb-gradient/)
assets/                     # CSS / JS / images (enqueued globally)
admin/                      # Admin page partials + bsf-analytics vendor lib
lib/                        # Vendored libraries: astra-notices, nps-survey
languages/                  # .pot / .po / .mo / .json translation files
tests/php/stubs/            # PHPStan stubs for BB + UABB classes
```

---

## Key Commands

### PHP Quality

```bash
composer run lint       # PHPCS — lint against WPCS + security rules
composer run format     # PHPCBF — auto-fix style violations
composer run phpstan    # PHPStan level 9 static analysis (2 GB memory)
```

### i18n / Translations

```bash
npm run i18n            # Regenerate languages/uabb.pot
npm run i18n:po         # Update .po files from .pot
npm run i18n:mo         # Compile .po → .mo
npm run i18n:json       # Generate .json for JS translations
```

### Build

```bash
grunt copy              # Copy distributable files → ultimate-addons-for-beaver-builder-lite/
grunt compress          # Create ultimate-addons-for-beaver-builder-lite.zip
grunt clean:main        # Remove build directory
grunt wp_readme_to_markdown  # Sync readme.txt → README.md
```

### PHPStan Stubs

```bash
composer run gen-stubs  # Regenerate tests/php/stubs/lite-stubs.php
```

---

## Architecture — Key Patterns

### Bootstrap Flow

```
plugins_loaded → init_uabb() → BB_Ultimate_Addon → UABB_Init
  └── UABB_Init::includes()     # loads all class files
  └── init (priority 10)        # fields, global settings, text domain
  └── init (priority 40)        # WPML, icon fonts, load_modules()
      └── load_modules()         # requires modules/{slug}/{slug}.php for each enabled module
```

### Static Options Cache

All DB options are loaded once into `UABB_Init::$uabb_options` at bootstrap. Read from this static property — do not call `get_option()` inside hot paths.

### Module Pattern

Every module extends `FLBuilderModule` and calls `FLBuilder::register_module()`. The `partial_refresh` flag controls whether only the module HTML re-renders on settings save (faster) or the full page reloads.

### AJAX

- **WordPress AJAX:** `wp_ajax_uabb_reload_icons`, `wp_ajax_uabb_cloud_dat_file_fetch`
- **BB AJAX (via `FLBuilderAJAX::add_action`):** `render_uabb_global_settings`, `save_uabb_global_settings`
- All AJAX handlers are admin-only — no `wp_ajax_nopriv_*` endpoints

---

## Constants (Defined in `bb-ultimate-addon.php`)

| Constant | Purpose |
|----------|---------|
| `BB_ULTIMATE_ADDON_DIR` | Absolute path to plugin root (trailing slash) |
| `BB_ULTIMATE_ADDON_URL` | Absolute URL to plugin root (trailing slash) |
| `BB_ULTIMATE_ADDON_LITE_VERSION` | Current version string — update on every release |
| `BB_ULTIMATE_ADDON_LITE` | Always `true` — distinguishes Lite from Pro in shared code |
| `UABB_PREFIX` | Short brand name (`'UABB'` or white-label override) |
| `UABB_CAT` | BB module group label (`'UABB Modules'` or white-label override) |

---

## Coding Standards

- Follow [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- Escape all output: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses()`
- Sanitize all input: `sanitize_text_field()`, `absint()`, etc.
- Every AJAX handler **must** verify a nonce AND check `current_user_can()`
- All translatable strings use domain `'uabb'`
- Banned functions enforced by PHPCS: `eval`, `exec`, `shell_exec`, `system`, `extract`, `parse_str`, `fsockopen`, and many POSIX functions — see `phpcs.xml.dist` for the full list
- DocBlocks required on all classes, methods, and properties

---

## Branching & PR Workflow

| Branch | Purpose |
|--------|---------|
| `master` | Production — triggers asset sync to WordPress.org on push |
| `next-release` | Active development — PRs target this branch |
| `feature/*` | Feature branches |
| `fix/*` | Bug fix branches |
| `chore/*` | Non-functional changes |

- PRs include `[BSF-PR-SUMMARY]` in the body to trigger the AI code reviewer
- All PRs are reviewed by `brainstormforce/pull-request-reviewer` (GitHub Action) before human review
- Releases: tag on `master` → GitHub Action deploys to WordPress.org SVN automatically

---

## Release Checklist

- [ ] Bump `BB_ULTIMATE_ADDON_LITE_VERSION` in `bb-ultimate-addon.php`
- [ ] Bump `version` in `package.json`
- [ ] Update `Stable tag` in `readme.txt`
- [ ] Add changelog entry in `readme.txt`
- [ ] Run `grunt wp_readme_to_markdown` to sync `README.md`
- [ ] `composer run phpstan` — 0 errors
- [ ] `composer run lint` — 0 errors
- [ ] Merge `next-release` → `master`
- [ ] Push a Git tag → triggers WordPress.org deploy

---

## Gotchas

- **Beaver Builder required:** If `class_exists('FLBuilder')` is false, the plugin shows an admin notice and loads nothing. Test with BB active.
- **PHPStan memory:** PHPStan needs `--memory-limit=2048M` due to WP stubs size. Already set in the Composer script.
- **PHPStan baseline:** `phpstan-baseline.neon` suppresses BB's dynamic method call false positives. When fixing a real error, remove it from the baseline too (`vendor/bin/phpstan --generate-baseline`).
- **Icon cache:** First activation copies icon fonts from `includes/icons/` to BB's cache. If icons are missing, use the "Reload Icons" button in admin settings.
- **Cloud template URLs:** The `sections` and `presets` cloud URLs use `http` (not `https`). Servers with strict HTTPS-only outbound rules may need adjustment.
- **Static options cache:** `UABB_Init::set_uabb_options()` is called once on bootstrap. If you add a new option key, add it to the static array there.
- **Module theme overrides:** Themes can override any module by placing a file at `{theme}/bb-ultimate-addon/modules/{slug}/{slug}.php`. The plugin copy is the fallback.
- **Multisite:** Settings are stored via `FLBuilderModel::get_admin_settings_option()` (network-aware). Test on multisite if modifying admin settings storage.

---

## Current Focus

<!-- Update this section each sprint/milestone -->
- Branch: `next-release`
- Recent: v1.6.7 — Button colour fix for BB 2.10
- Wiki documentation added (PR #205)

---

## Useful Links

- [GitHub Wiki](https://github.com/brainstormforce/ultimate-addons-for-beaver-builder-lite/wiki)
- [WordPress.org Plugin Page](https://wordpress.org/plugins/ultimate-addons-for-beaver-builder-lite/)
- [Official Docs](https://www.ultimatebeaver.com/docs)
- [Bug Bounty / Security](https://brainstormforce.com/bug-bounty-program/)
