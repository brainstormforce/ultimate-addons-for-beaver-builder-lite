# Architecture Overview

**Plugin:** Ultimate Addons for Beaver Builder – Lite
**Version:** 1.6.7
**Author:** Brainstorm Force
**Text Domain:** `uabb`

---

## High-Level Architecture

UABB Lite is a WordPress plugin that extends [Beaver Builder](https://www.wpbeaverbuilder.com/) by registering additional `FLBuilderModule` subclasses. It requires Beaver Builder (free or paid) to be installed and active. If Beaver Builder is absent, the plugin shows an admin notice and does nothing else.

```
WordPress Core
└── plugins_loaded action
    └── init_uabb()
        └── BB_Ultimate_Addon (bb-ultimate-addon.php)
            └── UABB_Init (classes/class-uabb-init.php)
                ├── checks FLBuilder class exists
                ├── includes all class files (self::includes())
                └── registers action hooks
                    ├── init (priority 10) — loads fields, settings, text domain
                    ├── init (priority 40) — loads modules via load_modules()
                    └── wp_enqueue_scripts — enqueues builder assets
```

---

## Bootstrap Sequence

| Step | Hook | Class / File | What Happens |
|------|------|-------------|-------------|
| 1 | `plugins_loaded` | `bb-ultimate-addon.php` | `init_uabb()` instantiates `BB_Ultimate_Addon` |
| 2 | constructor | `BB_Ultimate_Addon` | Registers activation hook, requires `class-uabb-init.php` |
| 3 | constructor | `UABB_Init` | Guards on `class_exists('FLBuilder')`, calls `self::includes()` |
| 4 | `includes()` | `UABB_Init` | Requires all core class files, sets up BSF Analytics, registers action hooks |
| 5 | `init` (priority 10) | `UABB_Init` | Loads global settings, fields, helper, NPS survey, text domain |
| 6 | `init` (priority 40) | `UABB_Init::init()` | Loads WPML class, nested form, icon fonts, and calls `load_modules()` |
| 7 | `load_modules()` | `UABB_Init` | Iterates enabled modules, requires each `modules/{slug}/{slug}.php` |
| 8 | `wp_enqueue_scripts` | `UABB_Init` | Enqueues `uabb-builder.css` / `uabb-builder-js` when builder is active |

---

## Core Classes

| Class | File | Responsibility |
|-------|------|---------------|
| `BB_Ultimate_Addon` | `bb-ultimate-addon.php` | Entry point, defines constants, delegates to `UABB_Init` |
| `UABB_Init` | `classes/class-uabb-init.php` | Orchestrates all includes, hooks, module loading |
| `BB_Ultimate_Addon_Helper` | `classes/class-uabb-helper.php` | Static utility methods: module lists, branding, settings retrieval |
| `UABBBuilderAdminSettings` | `classes/class-uabb-admin-settings.php` | Admin settings page (tabs, save, nonce) |
| `UABBBuilderAdminSettingsMultisite` | `classes/class-uabb-admin-settings-multisite.php` | Multisite-aware admin settings |
| `UABB_Cloud_Templates` | `classes/class-uabb-cloud-templates.php` | Fetches section/page templates from the cloud API |
| `UABB_Global_Styling` | `classes/uabb-global-settings.php` | Global style settings (theme colour, button defaults) |
| `UABBGlobalSetting` | `classes/class-uabb-global-settings.php` | Injects UABB strings into Beaver Builder's JS |
| `UABB_lite_Plugin_Backward` | `classes/class-uabb-backward.php` | Backward compatibility: version stamping on post publish |
| `UABB_Lite_Compatibility` | `classes/class-uabb-compatibility.php` | BB version detection and migration flag |
| `UABB_IconFonts` | `classes/class-uabb-iconfonts.php` | Registers icon sets with Beaver Builder, AJAX icon reload |
| `UABBLite_WPML_Translatable` | `classes/class-uabb-wpml.php` | WPML module translation integration |
| `UI_Panel` | `classes/class-ui-panel.php` | Beaver Builder UI panel extensions (sections, presets) |

---

## Module Architecture

Each module lives in `modules/{slug}/` and extends `FLBuilderModule`. Modules are registered with `FLBuilder::register_module()`. See [Module-Architecture](Module-Architecture) and [Module-Reference](Module-Reference) for full details.

---

## Static Options Cache

To avoid repeated database reads, `UABB_Init::set_uabb_options()` loads all key options into a static array at bootstrap:

```php
self::$uabb_options = [
    'fl_builder_uabb'          => /* general settings */,
    'fl_builder_uabb_branding' => /* branding overrides */,
    'uabb_global_settings'     => /* global styling */,
    'fl_builder_uabb_modules'  => /* module enable/disable state */,
];
```

Consumers call `UABB_Init::$uabb_options['key']` rather than hitting `get_option()` on each request.

---

## Key Filters and Actions

| Hook | Type | Registered By | Purpose |
|------|------|--------------|---------|
| `fl_builder_settings_form_defaults` | filter | `UABB_Init` | Inject UABB global-settings defaults into the BB form |
| `fl_builder_ui_js_strings` | filter | `UABBGlobalSetting` | Inject localised strings into BB's JS |
| `plugin_action_links_{basename}` | filter | `UABB_Init` | Add "Upgrade" link on Plugins screen |
| `uabb_global_support` | filter | `UABB_Init` | Allow third parties to disable global-settings UI |
| `uabb_languages_directory` | filter | `UABB_Init` | Override the languages directory path |
| `wpml_beaver_builder_modules_to_translate` | filter | `UABBLite_WPML_Translatable` | Register UABB modules for WPML string translation |

---

## Directory Map

```
ultimate-addons-for-beaver-builder-lite/
├── bb-ultimate-addon.php          # Plugin entry point
├── classes/                       # All PHP class files
│   ├── class-uabb-init.php
│   ├── class-uabb-helper.php
│   ├── class-uabb-admin-settings.php
│   ├── class-uabb-cloud-templates.php
│   ├── uabb-global-settings.php   # UABB_Global_Styling
│   ├── class-uabb-global-settings.php  # UABBGlobalSetting
│   ├── class-uabb-wpml.php
│   ├── wpml/                      # WPML per-module configs
│   └── ...
├── modules/                       # One subdirectory per module
│   ├── advanced-icon/
│   ├── flip-box/
│   └── ... (13 modules total)
├── includes/                      # Admin settings view partials
├── fields/                        # Custom field types (_config.php)
├── assets/                        # CSS / JS / images
├── admin/                         # Admin page partials + bsf-analytics
├── lib/                           # Vendored libraries (astra-notices, nps-survey)
├── languages/                     # .pot / .po / .mo files
├── objects/                       # Nested form helpers
└── tests/php/stubs/               # PHPStan stubs
```

---

## See Also

- [Plugin-Constants-and-Globals](Plugin-Constants-and-Globals)
- [Module-Architecture](Module-Architecture)
- [Admin-Settings](Admin-Settings)
- [Global-Settings](Global-Settings)
