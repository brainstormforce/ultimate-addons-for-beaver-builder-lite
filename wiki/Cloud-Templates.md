# Cloud Templates

## Overview

UABB Lite fetches pre-built section and page layouts from the UABB template cloud. The `UABB_Cloud_Templates` class (singleton) handles fetching, caching, and serving templates to the Beaver Builder editor.

**File:** `classes/class-uabb-cloud-templates.php`

---

## Cloud API Endpoints

Defined as a static property in `UABB_Cloud_Templates::__construct()`:

| Template Type | URL |
|--------------|-----|
| Page templates (layouts) | `https://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/layouts/` |
| Sections | `http://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/sections/` |
| Presets | `http://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/presets/` |

> **Note:** The `sections` and `presets` URLs use `http`. Servers with strict HTTPS-only outbound policies may need to proxy or override these endpoints.

---

## Singleton Pattern

```php
$instance = UABB_Cloud_Templates::get_instance();
```

Only one instance is created per request.

---

## AJAX Endpoint

| WordPress Hook | Handler | Auth Required |
|---------------|---------|--------------|
| `wp_ajax_uabb_cloud_dat_file_fetch` | `UABB_Cloud_Templates::fetch_cloud_templates` | Yes (`is_admin()`) |

This endpoint is triggered by the Template Cloud tab in the UABB admin settings page and by the template browser inside the Beaver Builder editor.

### What `fetch_cloud_templates()` Does

1. Iterates over all template types (`page-templates`, `sections`, `presets`)
2. Checks the site option `_uabb_cloud_templats` for a cached index
3. If not cached, performs a remote `wp_remote_get()` call to each cloud URL
4. Stores the fetched index back into `_uabb_cloud_templats`
5. Returns the merged template data as a JSON response

---

## Caching

Templates are cached in:

```
Option: _uabb_cloud_templats (wp_sitemeta on multisite / wp_options on single site)
```

`reset_cloud_transient()` rebuilds this cache by:

1. Reading `_uabb_cloud_templats` for previously downloaded templates
2. Fetching fresh data from each cloud URL
3. Merging downloaded templates with the new index
4. Saving back to `_uabb_cloud_templats`

To force a full refresh, delete the `_uabb_cloud_templats` option from the database (e.g. via WP-CLI: `wp option delete _uabb_cloud_templats`).

---

## File System Integration

`UABB_Cloud_Templates` uses a protected `$uabb_filesystem` property (initialised lazily). This wraps `WP_Filesystem` for any file operations required when downloading and storing template `.dat` files locally.

---

## Template Data Flow

```
BB Editor (Template browser)
    → AJAX: uabb_cloud_dat_file_fetch
        → UABB_Cloud_Templates::fetch_cloud_templates()
            ├── Check _uabb_cloud_templats cache
            ├── [cache miss] wp_remote_get( cloud_url )
            ├── Update _uabb_cloud_templats
            └── Return JSON to editor
```

---

## Nonce Security

The cloud template refresh action added in v1.5.6 includes a nonce check:

```php
// Nonce verified before refreshing template list
wp_verify_nonce( $_POST['nonce'], 'uabb-cloud-refresh' );
```

---

## See Also

- [Admin-Settings](Admin-Settings)
- [AJAX-Endpoints](AJAX-Endpoints)
- [Plugin-Constants-and-Globals](Plugin-Constants-and-Globals)
