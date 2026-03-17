# WPML and i18n

## Text Domain

All translatable strings use the text domain **`uabb`**.

The text domain is loaded by `UABB_Init::load_uabb_textdomain()` on the `init` hook (priority 10). It searches for `.mo` files in this order:

1. `WP_LANG_DIR/ultimate-addons-for-beaver-builder-lite/{locale}.mo` — global language directory
2. `BB_ULTIMATE_ADDON_DIR/languages/{locale}.mo` — plugin's own `languages/` directory
3. `load_plugin_textdomain( 'uabb', false, $lang_dir )` — WordPress default fallback

The locale used is `get_user_locale()` on WordPress 4.7+ and `get_locale()` on older versions. The path can be overridden via the `uabb_languages_directory` filter:

```php
add_filter( 'uabb_languages_directory', function( $path ) {
    return '/custom/path/to/languages/';
});
```

---

## Bundled Translations (v1.6.0+)

UABB Lite ships translations for four languages:

| Language | PO File | Notes |
|----------|---------|-------|
| Dutch | `languages/uabb-nl_NL.po` | AI-assisted via `gpt-po` |
| French | `languages/uabb-fr_FR.po` | AI-assisted via `gpt-po` |
| Spanish | `languages/uabb-es_ES.po` | AI-assisted via `gpt-po` |
| German | `languages/uabb-de_DE.po` | AI-assisted via `gpt-po` |

Compiled `.mo` and `.json` files are also included for each locale.

---

## Generating and Updating Translations

### 1. Generate the `.pot` template

```bash
npm run i18n
# Runs: grunt makepot + wp i18n make-pot . languages/uabb.pot
```

Options used in `make-pot`:
- Excludes: `node_modules`, `vendor`, `tests`, `artifact`
- Domain: `uabb`

### 2. Update existing `.po` files

```bash
npm run i18n:po
# Runs: wp i18n update-po languages/uabb.pot
```

### 3. Compile `.po` → `.mo` binary files

```bash
npm run i18n:mo
# Runs: wp i18n make-mo languages
```

### 4. Generate JS `.json` files (for block editor / Gutenberg)

```bash
npm run i18n:json
# Runs: wp i18n make-json languages --no-purge
```

### 5. AI-assisted translation via `gpt-po`

```bash
npm run i18n:gptpo:nl   # Dutch
npm run i18n:gptpo:fr   # French
npm run i18n:gptpo:es   # Spanish
npm run i18n:gptpo:de   # German
```

Requires a GPT API key configured for the `gpt-po` package.

---

## WPML Integration

**Class:** `UABBLite_WPML_Translatable`
**File:** `classes/class-uabb-wpml.php`
**Added in:** v1.2.2

### How It Works

`UABBLite_WPML_Translatable::init()` is called when `class-uabb-wpml.php` is included (inside `UABB_Init::init()`). It:

1. Adds a filter on `wpml_beaver_builder_modules_to_translate` to register UABB module fields
2. Conditionally loads `classes/wpml/class-wpml-uabb-infolist.php` if `WPML_Page_Builders_Defined` class exists

### Registered Translatable Modules

| Module Slug | Fields Registered for Translation |
|-------------|-----------------------------------|
| `uabb-button` | `text` (LINE), `link` (LINK) |
| `flip-box` | `title_front` (LINE), `desc_front` (VISUAL), `title_back` (LINE), `desc_back` (VISUAL) |
| `slide-box` | `title_front`, `desc_front`, `title_back`, `desc_back`, `link`, `cta_text` |
| `info-list` | Uses integration class `WPML_UABB_Infolist` (loaded from `classes/wpml/`) |
| `info-table` | `it_title`, `sub_heading`, `it_long_desc`, `button_text`, `it_link` |
| `image-separator` | `link` (LINK) |
| `uabb-heading` | `heading` (LINE), `link` (LINK), `description` (LINE) |
| `ribbon` | `title` (LINE) |

### WPML Editor Types

| Editor Type | Used For |
|-------------|---------|
| `LINE` | Single-line text (titles, labels) |
| `VISUAL` | Rich text / HTML content (descriptions) |
| `LINK` | URL fields |

### Info List WPML Integration Class

The Info List module uses a dedicated integration class (`WPML_UABB_Infolist`) because it uses a repeater form — the standard field registration approach does not handle nested repeating items. This class is only loaded when the `WPML_Page_Builders_Defined` class is present (i.e. WPML is active).

---

## GlotPress / WordPress.org Translation

UABB Lite supports community translation via GlotPress at `translate.wordpress.org`. Any translation approved there for the `ultimate-addons-for-beaver-builder-lite` project is automatically delivered to users via WordPress's language packs system.

---

## RTL Support

UABB Lite detects RTL mode with `is_rtl()` and enqueues a dedicated stylesheet:

```php
wp_enqueue_style( 'uabb-rtl-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-rtl.css' );
```

This is enqueued alongside the main builder styles when the builder is active.

---

## See Also

- [Environment-Configuration](Environment-Configuration)
- [Module-Reference](Module-Reference)
- [Contributing-Guide](Contributing-Guide)
