# Getting Started

## Prerequisites

Before installing UABB Lite, ensure:

1. **WordPress 4.6+** is installed and running
2. **Beaver Builder** (free or paid) is installed and **activated** — UABB Lite requires Beaver Builder to function. If BB is absent, UABB shows an admin notice and loads no modules.
3. **PHP 7.0+** with at least 15 MB of PHP memory available after WordPress core loads

---

## Installation

### Via WordPress Plugin Directory (Recommended)

1. In your WordPress admin, go to **Plugins → Add New**
2. Search for `Ultimate Addons for Beaver Builder`
3. Click **Install Now** next to "Ultimate Addons for Beaver Builder – Lite"
4. Click **Activate**

### Manual Upload

1. Download the `.zip` from [WordPress.org](https://wordpress.org/plugins/ultimate-addons-for-beaver-builder-lite/)
2. Go to **Plugins → Add New → Upload Plugin**
3. Select the `.zip` and click **Install Now**
4. Click **Activate Plugin**

### Via WP-CLI

```bash
wp plugin install ultimate-addons-for-beaver-builder-lite --activate
```

---

## Post-Activation Setup

After activation, UABB Lite runs `BB_Ultimate_Addon::activation_reset()` which:

- Checks available PHP memory (aborts if critically low)
- Copies icon font sets into Beaver Builder's icon cache directory

### Admin Settings Page

Navigate to **Settings → Beaver Builder → UABB** in your WordPress admin to configure:

| Tab | What to Configure |
|-----|------------------|
| **General** | Enable UI Design (section panels, search), Enable Live Preview |
| **Modules** | View list of active free modules (toggle is read-only in Lite) |
| **Template Cloud** | Browse and insert pre-built sections and page templates |
| **Icons** | View registered icon sets; use "Reload Icons" to refresh |
| **Welcome** | Upgrade info and community links |

---

## Using Modules in Beaver Builder

1. Edit any page or post and launch the Beaver Builder editor
2. Click the **+** (Add Content) button to open the module panel
3. Look for the **UABB Modules** group (or the white-label name if branding is customised)
4. Drag any module into a row or column

All 13 Lite modules are enabled by default. See [Module-Reference](Module-Reference) for a description of each module and its settings.

---

## Using Template Cloud

1. Inside the Beaver Builder editor, click **Templates**
2. Switch to the **Sections** or **Pages** tab
3. Browse UABB-provided layouts fetched from `templates.ultimatebeaver.com`
4. Click a template to insert it into the current page

Templates are cached as a site option (`_uabb_cloud_templats`). To force a refresh, clear the cached option or use the built-in reload action.

---

## Multisite

UABB Lite is compatible with WordPress Multisite. On multisite installs, settings are stored at the network level via `FLBuilderModel::get_admin_settings_option()`. The `UABBBuilderAdminSettingsMultisite` class handles network-admin-specific menu registration and settings saving.

---

## Upgrading to Pro

The **Upgrade** link in the Plugins list and the **Welcome** tab link to the Pro pricing page. Pro adds 60+ modules, 200+ row templates, 100+ page templates, WooCommerce modules, and white-label branding.

---

## Uninstalling

Deactivate and delete the plugin from **Plugins → Installed Plugins**. UABB stores data in standard WordPress options; no custom database tables are created by the Lite version.

---

## See Also

- [Architecture-Overview](Architecture-Overview)
- [Module-Reference](Module-Reference)
- [Admin-Settings](Admin-Settings)
- [Troubleshooting-FAQ](Troubleshooting-FAQ)
