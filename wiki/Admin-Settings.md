# Admin Settings

## Overview

UABB Lite adds a settings page under **Settings → Beaver Builder → UABB** (and under **Network Admin → Settings → Beaver Builder → UABB** on multisite). The page is managed by two classes:

| Class | File | Scope |
|-------|------|-------|
| `UABBBuilderAdminSettings` | `classes/class-uabb-admin-settings.php` | Single-site + network admin |
| `UABBBuilderAdminSettingsMultisite` | `classes/class-uabb-admin-settings-multisite.php` | Multisite network admin |

---

## Initialisation

`UABBBuilderAdminSettings::init()` is called from `UABB_Init::includes()`. It hooks into:

```
after_setup_theme → init_hooks()
├── admin_menu / network_admin_menu → menu()
├── admin_enqueue_scripts → styles_scripts()  (only on the UABB settings page)
├── admin_notices → register_notices()
├── wp_kses_allowed_html → add_data_attributes()
├── admin_enqueue_scripts → notice_styles_scripts()
└── admin_footer → show_nps_notice()
```

The page slug is `uabb-builder-settings`. Settings are saved via POST on `$_REQUEST['page'] === 'uabb-builder-settings'`.

---

## Security

All settings forms are protected with a WordPress nonce:

```php
wp_nonce_field( 'uabb', 'fl-uabb-nonce' );
```

On save, nonce verification runs before processing. The `manage_options` capability is required for the settings page.

---

## Settings Tabs

### General Settings

**View file:** `includes/admin-settings-general.php`
**Form action slug:** `uabb`

| Setting | Option Key | Type | Default | Description |
|---------|-----------|------|---------|-------------|
| Enable UI Design | `uabb-enabled-panels` | checkbox | enabled | Applies UABB UI effects (section panel, search box) to the frontend BB editor |
| Enable Live Preview | `uabb-live-preview` | checkbox | enabled | Shows a live preview of the page without leaving the editor |

Data is stored inside the `_fl_builder_uabb` option array (network-aware via `FLBuilderModel`).

### Modules

**View file:** `includes/admin-settings-modules.php`

Displays the list of all enabled Lite modules (read-only). Also shows premium modules as locked links with an "Unlock All Modules" upgrade button pointing to `BB_ULTIMATE_ADDON_UPGRADE_URL`.

Module list is fetched from:
- `BB_Ultimate_Addon_Helper::get_all_modules()` — active free modules
- `BB_Ultimate_Addon_Helper::get_premium_modules()` — premium modules with demo URLs

### Template Cloud

**View file:** `includes/admin-settings-template-cloud.php`

Provides access to the UABB Cloud Templates browser. Templates are fetched from the remote API via AJAX (`wp_ajax_uabb_cloud_dat_file_fetch`). See [Cloud-Templates](Cloud-Templates) for the full fetch and cache flow.

### Icons

**View file:** `includes/admin-settings-icons.php`

Shows the icon sets registered with Beaver Builder. The **Reload Icons** button triggers `wp_ajax_uabb_reload_icons` to:
1. Delete `_uabb_enabled_icons` option
2. Re-copy icons from `includes/icons/` to BB's icon cache
3. Re-register icon sets with Beaver Builder

### Welcome

**View file:** `includes/admin-settings-welcome.php`

Onboarding screen with upgrade CTA, Facebook group link (`BB_ULTIMATE_ADDON_FB_URL`), and Twitter link (`BB_ULTIMATE_ADDON_TWITTER_URL`).

---

## Admin Notices

`UABBBuilderAdminSettings::register_notices()` registers notices via the `Astra_Notices` library (loaded from `lib/astra-notices/`). Notices support:
- A `data-repeat-notice-after` attribute (supported by the `add_data_attributes` filter on `wp_kses_allowed_html`)
- Dismissible and repeatable notice patterns

### NPS Survey Notice

`show_nps_notice()` (hooked to `admin_footer`) renders the NPS (Net Promoter Score) survey via the `Uabb_Lite_Nps_Survey` class (loaded from `lib/class-uabb-lite-nps-survey.php`). Survey configuration:

```php
[
    'id'                => 'deactivation-survey-ultimate-addons-for-beaver-builder-lite',
    'popup_logo'        => BB_ULTIMATE_ADDON_URL . 'assets/images/uabb_notice.svg',
    'plugin_slug'       => 'ultimate-addons-for-beaver-builder-lite',
    'plugin_version'    => BB_ULTIMATE_ADDON_LITE_VERSION,
    'popup_title'       => 'Quick Feedback',
    'support_url'       => 'https://www.ultimatebeaver.com/contact/',
    'show_on_screens'   => ['plugins'],
]
```

---

## Deactivation Survey

The BSF Analytics library also registers a deactivation survey popup that appears when the plugin is deactivated from the Plugins screen. This collects opt-in user feedback and is governed by the same `BSF_Analytics_Loader` instance configured in `UABB_Init::includes()`.

---

## Enqueued Assets (Admin)

| Asset | Handle | Hook |
|-------|--------|------|
| `assets/css/uabb-admin-notice.css` | `uabb-notice-settings` | `admin_enqueue_scripts` (always) |
| Settings page CSS/JS | via `styles_scripts()` | `admin_enqueue_scripts` (on UABB page only) |

---

## Plugin Action Link

`UABB_Init::uabb_render_plugin_action_links()` (filtered via `plugin_action_links_{basename}`) appends an **Upgrade** link (styled green) to the plugin row on **Plugins → Installed Plugins**.

---

## See Also

- [Architecture-Overview](Architecture-Overview)
- [Cloud-Templates](Cloud-Templates)
- [Global-Settings](Global-Settings)
- [AJAX-Endpoints](AJAX-Endpoints)
