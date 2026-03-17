# Global Settings

## Overview

UABB Lite provides a **Global Settings** system that lets editors apply consistent typography and colour defaults across all UABB modules sitewide. The system integrates into Beaver Builder's own settings panel and stores values in `_uabb_global_settings`.

Two classes are involved:

| Class | File | Role |
|-------|------|------|
| `UABB_Global_Styling` | `classes/uabb-global-settings.php` | Stores, renders, and saves global style values; registers BB AJAX actions |
| `UABBGlobalSetting` | `classes/class-uabb-global-settings.php` | Injects UABB strings (labels, URLs) into Beaver Builder's JavaScript |

---

## Storage

Global settings are stored as a single serialised array in `wp_options`:

```
Option key: _uabb_global_settings
```

### Default Values

Set by `UABB_Global_Styling::add_options()` on first use:

| Key | Default | Description |
|-----|---------|-------------|
| `enable_global` | `'yes'` | Master switch; `'no'` disables the global style system |
| `theme_color` | `'f7b91a'` | Primary accent colour (hex without `#`) |
| `theme_text_color` | `'808285'` | Global text colour |
| `btn_bg_color` | `'f7b91a'` | Button background colour |
| `btn_bg_color_opc` | `''` | Button background colour opacity |
| `btn_bg_hover_color` | `'000000'` | Button background hover colour |
| `btn_bg_hover_color_opc` | `''` | Button hover colour opacity |
| `btn_text_color` | `'ffffff'` | Button text colour |
| `btn_text_hover_color` | `'ffffff'` | Button text hover colour |
| `btn_font_size` | `''` | Button font size |
| `btn_line_height` | `''` | Button line height |
| `btn_letter_spacing` | `''` | Button letter spacing |
| `btn_text_transform` | `'none'` | Button text transform (`none`, `uppercase`, `lowercase`, `capitalize`) |
| `btn_border_radius` | `'5'` | Button border radius (px) |
| `btn_vertical_padding` | `''` | Button top/bottom padding |
| `btn_horizontal_padding` | `''` | Button left/right padding |

---

## AJAX Actions

Registered by `UABB_Global_Styling::init_actions()` (called during the `init` hook at priority 40, guarded by `class_exists('FLBuilderAJAX')`):

| AJAX Action | Handler | BB AJAX call |
|------------|---------|-------------|
| `render_uabb_global_settings` | `UABB_Global_Styling::render_uabb_global_settings` | Returns the HTML form for the Global Settings panel in the BB editor |
| `save_uabb_global_settings` | `UABB_Global_Styling::save_uabb_global_settings` | Saves submitted settings array to `_uabb_global_settings` |

These are registered with `FLBuilderAJAX::add_action()`, meaning they use BB's internal AJAX infrastructure rather than WordPress's `wp_ajax_*` system directly.

See [AJAX-Endpoints](AJAX-Endpoints) for the full endpoint list.

---

## Enable / Disable

The global styling system respects `FLCustomizer` (Beaver Themer). When `FLCustomizer` is present:

- If `enable_global = 'no'`, `uabb-bbtheme-global-integration.php` is loaded instead of `uabb-global-integration.php`, falling back to BB Theme's native global styles.

The `uabb_global_support` filter allows third parties or child plugins to disable the UABB global system entirely:

```php
add_filter( 'uabb_global_support', '__return_false' );
```

---

## JavaScript Integration

`UABBGlobalSetting::init()` hooks into `fl_builder_ui_js_strings` (priority default) to inject strings into Beaver Builder's front-end JavaScript:

| JS Key | Default Value | Branding-Aware |
|--------|--------------|---------------|
| `uabbGlobalSettings` | `'UABB – Global Settings'` | Yes — uses `UABB_PREFIX` |
| `uabbKnowledgeBase` | `'UABB – Knowledge Base'` | Yes |
| `uabbContactSupport` | `'UABB – Contact Support'` | Yes |
| `uabbKnowledgeBaseUrl` | `'https://www.ultimatebeaver.com/docs/'` | Yes — overridable via branding option |
| `uabbContactSupportUrl` | `'https://www.ultimatebeaver.com/contact/'` | Yes — overridable via branding option |

When the `UABB_PREFIX` constant is not `'UABB'` (i.e. white-label mode), all labels are prefixed with the custom brand name using `sprintf`.

---

## Presets Button

When global settings are enabled (`enable_global = 'yes'`) and `uabb_global_support` filter returns true, the builder JavaScript is localised with:

```php
wp_localize_script( 'uabb-builder-js', 'uabb_global', [ 'show_global_button' => true ] );
```

When `enable_global = 'no'` (BB Theme integration mode):

```php
wp_localize_script( 'uabb-builder-js', 'uabb_presets', [ 'show_presets' => true ] );
```

These flags control whether the Global Settings and Presets buttons appear in the Beaver Builder UI toolbar.

---

## Getting the Current Settings

```php
$settings = UABB_Global_Styling::get_uabb_global_settings();
// Returns a stdClass object with all global setting keys as properties.
// Falls back to defaults if no settings saved.
```

---

## See Also

- [Plugin-Constants-and-Globals](Plugin-Constants-and-Globals)
- [AJAX-Endpoints](AJAX-Endpoints)
- [Admin-Settings](Admin-Settings)
