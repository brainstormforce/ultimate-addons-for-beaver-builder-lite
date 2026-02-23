# Environment Configuration

## Requirements

| Requirement | Minimum | Recommended | Notes |
|------------|---------|-------------|-------|
| PHP | 7.0 | 8.1+ | PHPStan baseline targets PHP 7.0+ |
| WordPress | 4.6 | 6.x | Tested up to 6.9 |
| Beaver Builder | Any paid or free edition | Latest | Plugin checks `class_exists('FLBuilder')` on load |
| PHP Memory | 15 MB available after WP core loads | 64 MB+ | Plugin shows an activation error and aborts if memory is critically low |

### PHP Memory Check

On activation, `BB_Ultimate_Addon::activation_reset()` calls `check_memory_limit()`. If fewer than 15 MB remain, the activation is blocked and the user is shown an error message with a link to the memory-limit documentation.

---

## No `.env` File

UABB Lite stores all configuration in WordPress options (the database), not in environment variables or dotfiles. There is no `.env` to configure.

---

## Optional: Google Maps API Key

Some modules support embedding maps. The API key is stored under the `_fl_builder_uabb` option array:

```php
$uabb['uabb-google-map-api'] = 'YOUR_KEY_HERE';
```

Set it via **Settings → Beaver Builder → UABB → General Settings** in the WordPress admin.

---

## Development Environment

### PHP Tooling

All dev tooling is installed via Composer:

```bash
composer install
```

Key dev dependencies:

| Package | Purpose |
|---------|---------|
| `wp-coding-standards/wpcs` | WordPress Coding Standards (PHPCS ruleset) |
| `phpcompat/phpcompatibility-wp` | PHP cross-version compatibility sniffs |
| `phpstan/phpstan` | Static analysis (level 9) |
| `squizlabs/php_codesniffer` | PHPCS runner |
| `pheromone/phpcs-security-audit` | Security-focused PHPCS sniffs |
| `szepeviktor/phpstan-wordpress` | WordPress stubs for PHPStan |
| `php-stubs/wordpress-stubs` | Core WordPress function stubs |

### Node / Grunt Tooling

Build tasks use Grunt:

```bash
npm install
```

Key dev dependencies:

| Package | Purpose |
|---------|---------|
| `grunt` | Task runner |
| `grunt-wp-i18n` | `.pot` file generation |
| `grunt-wp-readme-to-markdown` | Converts `readme.txt` → `README.md` |
| `grunt-contrib-compress` | Builds the distributable `.zip` |
| `grunt-contrib-copy` | Copies files to the build directory |
| `gpt-po` | AI-assisted PO file translation |

---

## Composer Scripts

Run from the plugin root:

| Script | Command | What It Does |
|--------|---------|-------------|
| `composer run lint` | `phpcs --standard=phpcs.xml.dist` | Lint all PHP files against WPCS + security rules |
| `composer run format` | `phpcbf --standard=phpcs.xml.dist` | Auto-fix fixable PHPCS violations |
| `composer run phpstan` | `vendor/bin/phpstan --memory-limit=2048M analyse` | Run PHPStan level-9 static analysis |
| `composer run gen-stubs` | `generate-stubs … --out=tests/php/stubs/lite-stubs.php` | Regenerate PHPStan stubs from the plugin's own classes |

---

## NPM Scripts (i18n)

| Script | What It Does |
|--------|-------------|
| `npm run i18n` | Runs Grunt `makepot` then WP-CLI `make-pot` to generate `languages/uabb.pot` |
| `npm run i18n:po` | Updates existing `.po` files from the `.pot` |
| `npm run i18n:mo` | Compiles `.po` → `.mo` binary files |
| `npm run i18n:json` | Generates JS `.json` translation files from `.po` |
| `npm run i18n:gptpo:nl` | AI-translates `uabb-nl_NL.po` via GPT |
| `npm run i18n:gptpo:fr` | AI-translates `uabb-fr_FR.po` |
| `npm run i18n:gptpo:es` | AI-translates `uabb-es_ES.po` |
| `npm run i18n:gptpo:de` | AI-translates `uabb-de_DE.po` |

---

## PHPCS Configuration (`phpcs.xml.dist`)

- Applies `WordPress-Core` and `WordPress-Docs` rulesets
- Enforces `PHPCompatibility` for PHP 5.3+ (legacy CI; static analysis targets 7.0+)
- Bans a large set of dangerous PHP functions: `eval`, `exec`, `shell_exec`, `system`, `fsockopen`, `extract`, `parse_str`, and many POSIX functions
- Excludes: `node_modules/`, `vendor/`, `tests/`, `admin/bsf-analytics/`, vendored libs

## PHPStan Configuration (`phpstan.neon`)

- **Level:** 9 (strictest)
- **Bootstrap files:** `vendor/php-stubs/wordpress-stubs/wordpress-stubs.php`, `tests/php/stubs/lite-stubs.php`
- **Paths analysed:** `admin`, `assets`, `classes`, `fields`, `includes`, `languages`, `modules`
- Baseline file (`phpstan-baseline.neon`) suppresses known false-positive patterns from BB's dynamic method calls

---

## See Also

- [Getting-Started](Getting-Started)
- [Testing-Guide](Testing-Guide)
- [Contributing-Guide](Contributing-Guide)
