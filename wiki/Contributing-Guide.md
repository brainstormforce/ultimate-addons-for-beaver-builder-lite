# Contributing Guide

## Repository

GitHub: [brainstormforce/ultimate-addons-for-beaver-builder-lite](https://github.com/brainstormforce/ultimate-addons-for-beaver-builder-lite)

Issues: [GitHub Issues](https://github.com/brainstormforce/ultimate-addons-for-beaver-builder-lite/issues)

---

## Development Setup

### 1. Clone the repository

```bash
git clone git@github.com:brainstormforce/ultimate-addons-for-beaver-builder-lite.git
cd ultimate-addons-for-beaver-builder-lite
```

### 2. Install PHP dependencies

```bash
composer install
```

This installs PHPCS, PHPStan, WordPress stubs, and security audit sniffs.

### 3. Install Node dependencies

```bash
npm install
```

This installs Grunt and the i18n tools.

### 4. Place the plugin in a local WordPress installation

The plugin must be inside an active WordPress install with Beaver Builder activated to test module rendering. Point your local dev server's plugin directory here, or use symlinks.

---

## Branching Strategy

| Branch | Purpose |
|--------|---------|
| `master` | Production-ready code; tagged releases cut from here |
| `next-release` | Active development branch; feature branches merge here |
| `feature/*` | Individual feature development |
| `fix/*` | Bug fixes |
| `chore/*` | Non-functional changes (docs, tooling, CI) |

**Workflow:**
1. Branch off `next-release`
2. Open a PR targeting `next-release`
3. When the release is ready, `next-release` is merged to `master` and tagged

---

## Code Standards

### PHP

All PHP must pass:

```bash
composer run lint    # PHPCS + WPCS
composer run phpstan # Static analysis level 9
```

Key rules:
- Follow [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- Use `wp_kses_*`, `esc_html()`, `esc_attr()`, `esc_url()` on all output
- Use `sanitize_*` on all input
- Every AJAX handler must verify a nonce and check `current_user_can()`
- Never use banned functions (see [Testing-Guide](Testing-Guide) for the full list)
- Add DocBlocks to all classes, methods, and properties

### JavaScript

No JS build system beyond Grunt is in use. JavaScript files are authored directly in `modules/{slug}/js/` and `assets/js/`. Follow [WordPress JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).

### CSS

CSS is authored directly. No preprocessor (Sass/Less) is used in the Lite version. Follow [WordPress CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).

---

## Adding a New Module

1. Create `modules/{slug}/` directory
2. Create `modules/{slug}/{slug}.php` — extend `FLBuilderModule`, call `FLBuilder::register_module()`
3. Add `modules/{slug}/css/frontend.css` and optionally `frontend.css.php`
4. Add `modules/{slug}/js/frontend.js` if needed
5. Add `modules/{slug}/includes/frontend.php` for the HTML template
6. Register the module slug in `BB_Ultimate_Addon_Helper::get_all_modules()` (in `class-uabb-helper.php`)
7. Add WPML registration in `UABBLite_WPML_Translatable::wpml_uabb_modules_translate()` if the module has translatable text fields
8. Add translatable strings with the `uabb` text domain

See [Module-Architecture](Module-Architecture) for the full module class anatomy.

---

## i18n Workflow

When adding or changing user-facing strings:

1. Wrap strings: `__( 'String', 'uabb' )`, `esc_html__( 'String', 'uabb' )`, etc.
2. Regenerate the `.pot` file: `npm run i18n`
3. Update existing `.po` files: `npm run i18n:po`
4. Compile to `.mo`: `npm run i18n:mo`
5. Generate JS `.json` files: `npm run i18n:json`

---

## Grunt Tasks

| Task | Command | What It Does |
|------|---------|-------------|
| Readme → Markdown | `grunt wp_readme_to_markdown` | Converts `readme.txt` to `README.md` |
| Copy build files | `grunt copy` | Copies distributable files to `ultimate-addons-for-beaver-builder-lite/` (excludes dev files) |
| Compress zip | `grunt compress` | Creates `ultimate-addons-for-beaver-builder-lite.zip` |
| Clean build | `grunt clean:main` | Removes the copied build directory |
| Clean zip | `grunt clean:zip` | Removes the zip file |
| Generate POT | `grunt makepot` | Generates `languages/uabb.pot` |

---

## Security Reporting

Security vulnerabilities should **not** be reported in public GitHub Issues. Use the Brainstorm Force [Bug Bounty Program](https://brainstormforce.com/bug-bounty-program/) for responsible disclosure.

Previous security acknowledgements:
- Patchstack (v1.5.8, v1.5.10)

---

## AI Code Review

All PRs are automatically reviewed by the AI Code Reviewer GitHub Actions workflow (`.github/workflows/ai-code-reviewer.yml`). Address any findings before requesting a human review.

---

## Dependency Updates

PHP dependencies are managed via Composer. Dependabot is configured (`.github/dependabot.yml`) to open automated PRs for dependency updates.

---

## See Also

- [Testing-Guide](Testing-Guide)
- [Deployment-Guide](Deployment-Guide)
- [WPML-and-i18n](WPML-and-i18n)
- [Module-Architecture](Module-Architecture)
