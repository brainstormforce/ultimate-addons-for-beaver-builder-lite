# Plugin Constants and Globals

All constants are defined in `bb-ultimate-addon.php` inside the `if ( ! class_exists( 'BB_Ultimate_Addon' ) )` guard. They are available globally once the plugin is loaded.

---

## Constants

| Constant | Value / Source | Purpose |
|----------|----------------|---------|
| `BB_ULTIMATE_ADDON_DIR` | `plugin_dir_path( __FILE__ )` | Absolute filesystem path to plugin root (trailing slash) |
| `BB_ULTIMATE_ADDON_URL` | `plugins_url( '/', __FILE__ )` | Absolute URL to plugin root (trailing slash) |
| `BB_ULTIMATE_ADDON_LITE_VERSION` | `'1.6.7'` | Current Lite plugin version string |
| `BB_ULTIMATE_ADDON_FILE` | `trailingslashit( dirname( __FILE__ ) ) . 'bb-ultimate-addon.php'` | Absolute path to the main plugin file |
| `BB_ULTIMATE_ADDON_LITE` | `true` | Flag: always `true` in the Lite build; used by shared code to distinguish Lite vs Pro |
| `BSF_REMOVE_UABB_FROM_REGISTRATION_LISTING` | `true` | Tells BSF registration library to omit UABB from the licence-registration list |
| `BB_ULTIMATE_ADDON_UPGRADE_URL` | `'https://www.ultimatebeaver.com/pricing/…'` | URL used for "Upgrade" action link and upsell buttons |
| `BB_ULTIMATE_ADDON_FB_URL` | `'https://www.brainstormforce.com/go/uabb-facebook-group/…'` | Facebook community group URL used in admin notices |
| `BB_ULTIMATE_ADDON_TWITTER_URL` | `'https://twitter.com/WeBrainstorm'` | Twitter/X profile URL |

### Constants Defined Later (During Init)

These constants are defined after `BB_Ultimate_Addon_Helper::set_constants()` runs (inside `UABB_Init::includes()`):

| Constant | Defined By | Purpose |
|----------|-----------|---------|
| `UABB_PREFIX` | `BB_Ultimate_Addon_Helper::set_constants()` | Short plugin name used in UI labels (e.g. `'UABB'`, or a white-label override) |
| `UABB_CAT` | `BB_Ultimate_Addon_Helper::set_constants()` | Beaver Builder module category label (e.g. `'UABB Modules'`) |
| `FL_BUILDER_VERSION` | `UABB_Lite_Compatibility` | Normalised string of the installed BB version; falls back to `''` if BB is absent |
| `BSF_UABB_NOTICES` | `UABB_Init` | Set to `false` when BB is not active, to suppress BSF notice system |

---

## Static Properties

### `UABB_Init::$uabb_options`

Populated once on bootstrap by `UABB_Init::set_uabb_options()`. Consumers read from this array instead of calling `get_option()` on every request.

```php
UABB_Init::$uabb_options = [
    'fl_builder_uabb'          => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb', true ),
    'fl_builder_uabb_branding' => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_branding', false ),
    'uabb_global_settings'     => get_option( '_uabb_global_settings' ),
    'fl_builder_uabb_modules'  => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_modules', false ),
];
```

### `BB_Ultimate_Addon_Helper::$basic_modules`

A static string holding the "Basic" category label. Set inside `set_constants()` and used as a fallback category when `FLBuilderUIContentPanel` is not available.

---

## WordPress Options (Database Keys)

| Option Key | Storage | Purpose |
|-----------|---------|---------|
| `_fl_builder_uabb` | `FLBuilderModel` (network-aware) | General UABB settings array (panels, live preview, Google Maps API key, etc.) |
| `_fl_builder_uabb_branding` | `FLBuilderModel` (network-aware) | White-label branding overrides (plugin name, short name, URLs) |
| `_uabb_global_settings` | `wp_options` | Global styling defaults (theme colour, button colours, typography) |
| `_fl_builder_uabb_modules` | `FLBuilderModel` (network-aware) | Per-module enable/disable state map |
| `_uabb_cloud_templats` | `wp_sitemeta` / `wp_options` | Cached cloud template index (transient-style) |
| `_uabb_enabled_icons` | `wp_options` | Whether icon sets have been copied into BB's cache; `0` triggers re-copy |
| `uabb_usage_optin` | `wp_options` | BSF Analytics opt-in flag (`'yes'` or unset) |
| `uabb_usage_installed_time` | `wp_options` | Timestamp used by BSF Analytics for display timing |
| `bsf_usage_optin` | `wp_options` | Legacy analytics opt-in key (migrated to `uabb_usage_optin` on `admin_init`) |

---

## Cloud API Endpoints (Hardcoded)

Defined inside `UABB_Cloud_Templates::__construct()`:

```php
self::$cloud_url = [
    'page-templates' => 'https://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/layouts/',
    'sections'       => 'http://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/sections/',
    'presets'        => 'http://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/presets/',
];
```

> **Note:** The `sections` and `presets` URLs currently use `http`. If your server enforces HTTPS, verify these endpoints are reachable.

---

## See Also

- [Architecture-Overview](Architecture-Overview)
- [Global-Settings](Global-Settings)
- [Cloud-Templates](Cloud-Templates)
