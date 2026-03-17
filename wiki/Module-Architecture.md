# Module Architecture

## Overview

Every UABB module is a PHP class that extends Beaver Builder's `FLBuilderModule`. Each module lives in its own subdirectory under `modules/` and follows a consistent structure. Modules are loaded conditionally — only those enabled by the site administrator are instantiated.

---

## Module Loading Flow

```
UABB_Init::init()  (hook: init, priority 40)
└── load_modules()
    └── BB_Ultimate_Addon_Helper::get_builder_uabb_modules()
        └── returns [ 'slug' => 'true'|'false' ]
    └── foreach enabled module:
        ├── child theme:  get_stylesheet_directory()/bb-ultimate-addon/modules/{slug}/{slug}.php
        ├── parent theme: get_template_directory()/bb-ultimate-addon/modules/{slug}/{slug}.php
        └── plugin:       BB_ULTIMATE_ADDON_DIR . 'modules/{slug}/{slug}.php'
```

**Theme overrides are supported:** A child or parent theme may override any module by placing a file at the theme path above. The plugin's own copy is a fallback.

---

## Module Directory Structure

Each module directory contains:

```
modules/{slug}/
├── {slug}.php          # Module class + FLBuilder::register_module() call
├── css/
│   ├── frontend.css    # Styles loaded on the frontend
│   └── *.css.php       # Dynamic CSS (PHP-generated, passed through BB's CSS cache)
├── js/
│   ├── frontend.js     # Scripts loaded on the frontend
│   └── frontend.min.js
└── includes/
    ├── frontend.php    # Module HTML template (rendered by BB)
    └── *.php           # Additional partials (settings forms, previews)
```

---

## Anatomy of a Module Class

```php
class UABBExampleModule extends FLBuilderModule {

    public function __construct() {
        parent::__construct([
            'name'            => __( 'Example', 'uabb' ),
            'description'     => __( 'Description shown in the module picker.', 'uabb' ),
            'category'        => BB_Ultimate_Addon_Helper::module_cat(
                                     BB_Ultimate_Addon_Helper::$basic_modules
                                 ),
            'group'           => defined('UABB_CAT') ? UABB_CAT : '',
            'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/example/',
            'url'             => BB_ULTIMATE_ADDON_URL . 'modules/example/',
            'editor_export'   => true,   // Include in BB's export
            'partial_refresh' => true,   // Re-render only the module on settings change
            'icon'            => 'star-filled.svg',
        ]);
    }
}

FLBuilder::register_module( 'UABBExampleModule', [
    'tab-id' => [
        'title'    => __( 'Tab Title', 'uabb' ),
        'sections' => [
            'section-id' => [
                'title'  => __( 'Section Title', 'uabb' ),
                'fields' => [
                    'field_name' => [
                        'type'    => 'text',
                        'label'   => __( 'Field Label', 'uabb' ),
                        'default' => '',
                        'preview' => [ 'type' => 'text', 'selector' => '.uabb-element' ],
                    ],
                ],
            ],
        ],
    ],
]);
```

### Constructor Parameters

| Key | Type | Default | Purpose |
|-----|------|---------|---------|
| `name` | string | required | Display name in the Beaver Builder content panel |
| `description` | string | `''` | Tooltip description |
| `category` | string | required | Sub-category within the UABB group |
| `group` | string | `''` | Top-level group label (e.g. `'UABB Modules'`) |
| `dir` | string | required | Absolute filesystem path to the module directory |
| `url` | string | required | Absolute URL to the module directory |
| `editor_export` | bool | `true` | Whether to include in BB's template export |
| `partial_refresh` | bool | `false` | If `true`, only the module's HTML is re-rendered on settings save (faster) |
| `icon` | string | `''` | SVG icon filename shown in the content panel |

---

## Module Categories and Grouping

`BB_Ultimate_Addon_Helper::module_cat( $cat )` returns:

- `$cat` if `FLBuilderUIContentPanel` class exists (BB 2.x content panel — uses the `category` value)
- `UABB_CAT` constant otherwise (legacy BB 1.x — uses the `group` value)

This dual-mode approach ensures compatibility across all supported BB versions.

---

## `partial_refresh`

When set to `true`, Beaver Builder re-renders only the module's `frontend.php` output after settings are saved in the editor, without a full page reload. This speeds up the editing experience for complex modules.

Modules that interact with JS after render (e.g. sliders, toggle switches) may need this enabled so their init scripts re-run on re-render.

---

## Settings Form Field Types

UABB modules use standard Beaver Builder field types plus custom fields defined in `fields/_config.php`:

| Field Type | Notes |
|-----------|-------|
| `text` | Single-line text input |
| `textarea` | Multi-line text |
| `select` | Dropdown |
| `color` | Colour picker (supports colour connections) |
| `photo` | Media library image picker |
| `icon` | Icon picker (Font Awesome + registered sets) |
| `unit` | Number + unit selector (px, em, %) |
| `dimension` | Four-side spacing input |
| `typography` | BB 2.2+ typography field (font family, size, weight, etc.) |
| `border` | BB 2.2+ border field (width, style, colour, radius) |
| `link` | BB 2.2+ link field (URL, target, nofollow) |
| `form` | Nested repeater form (used for multi-item modules like Advanced Icons) |

Custom UABB gradient field is in `fields/uabb-gradient/`.

---

## Enabling / Disabling Modules

Module state is stored in `_fl_builder_uabb_modules` (a network-aware option). `BB_Ultimate_Addon_Helper::get_builder_uabb_modules()` returns the merged array of module slugs and their enabled/disabled state. In Lite, all bundled modules are enabled and the admin UI is read-only (the per-module toggle is a Pro feature).

---

## See Also

- [Module-Reference](Module-Reference)
- [Architecture-Overview](Architecture-Overview)
- [Admin-Settings](Admin-Settings)
