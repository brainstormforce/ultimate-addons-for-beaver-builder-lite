# AJAX Endpoints

UABB Lite registers three types of AJAX actions:

1. **Standard WordPress AJAX** (`wp_ajax_*`) — authenticated admin requests
2. **Beaver Builder AJAX** (`FLBuilderAJAX::add_action`) — routed through BB's internal AJAX system

---

## Standard WordPress AJAX Endpoints

### `wp_ajax_uabb_reload_icons`

| Property | Value |
|----------|-------|
| Hook | `wp_ajax_uabb_reload_icons` |
| Class | `UABB_IconFonts` |
| Method | `reload_icons()` |
| Auth | Admin-only (`manage_options` + nonce) |
| HTTP method | POST |

**Security checks:**
```php
wp_verify_nonce( $_POST['nonce'], 'uabb-reload-icons' )
current_user_can( 'manage_options' )
```

**What it does:**
1. Verifies nonce and capability
2. Deletes the `_uabb_enabled_icons` option (forcing re-registration)
3. Returns `wp_send_json_success()`

**Error response (auth failure):**
```json
{ "success": false, "message": "You are not authorized to perform this action." }
```

**Used by:** The **Reload Icons** button on the **Settings → Beaver Builder → UABB → Icons** tab.

---

### `wp_ajax_uabb_cloud_dat_file_fetch`

| Property | Value |
|----------|-------|
| Hook | `wp_ajax_uabb_cloud_dat_file_fetch` |
| Class | `UABB_Cloud_Templates` |
| Method | `fetch_cloud_templates()` |
| Auth | Admin-only |
| HTTP method | POST |

**What it does:**
1. Reads the `_uabb_cloud_templats` site option for cached template index
2. For any uncached template type, calls `wp_remote_get()` to the cloud API:
   - `https://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/layouts/`
   - `http://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/sections/`
   - `http://templates.ultimatebeaver.com/wp-json/uabb-lite/v1/template/presets/`
3. Stores updated index in `_uabb_cloud_templats`
4. Returns the template data as JSON

**Nonce (added v1.5.6):** Nonce `uabb-cloud-refresh` is verified before refreshing.

**Used by:** Template Cloud tab in admin settings and the Beaver Builder editor template browser.

---

## Beaver Builder AJAX Actions

These are registered via `FLBuilderAJAX::add_action()` and routed through BB's own AJAX handler (typically at `admin-ajax.php?action=fl_builder_ajax`). They require the user to be logged in with BB edit capabilities.

### `render_uabb_global_settings`

| Property | Value |
|----------|-------|
| BB AJAX action | `render_uabb_global_settings` |
| Class | `UABB_Global_Styling` |
| Method | `render_uabb_global_settings()` |
| Parameters | None |

**What it does:** Returns the rendered HTML form for the UABB Global Settings panel inside the Beaver Builder UI toolbar.

**Registered in:** `UABB_Global_Styling::init_actions()` (called from `UABB_Init::init()`, guarded by `class_exists('FLBuilderAJAX')`)

---

### `save_uabb_global_settings`

| Property | Value |
|----------|-------|
| BB AJAX action | `save_uabb_global_settings` |
| Class | `UABB_Global_Styling` |
| Method | `save_uabb_global_settings( $settings )` |
| Parameters | `settings` (array — submitted settings values) |

**What it does:** Validates and saves the global settings array to `_uabb_global_settings` in `wp_options`. Updates `UABB_Init::$uabb_options['uabb_global_settings']` static cache.

---

## No Public (Non-Auth) AJAX Endpoints

UABB Lite does not register any `wp_ajax_nopriv_*` endpoints. All AJAX calls require an authenticated admin session.

---

## AJAX Action Registration Locations

| File | Hook | Actions Registered |
|------|------|-------------------|
| `classes/class-uabb-iconfonts.php` | `UABB_IconFonts::init()` called via constructor | `uabb_reload_icons` |
| `classes/class-uabb-cloud-templates.php` | Constructor | `uabb_cloud_dat_file_fetch` |
| `classes/uabb-global-settings.php` | `UABB_Global_Styling::init_actions()` → `init` (priority 40) | `render_uabb_global_settings`, `save_uabb_global_settings` |

---

## See Also

- [Admin-Settings](Admin-Settings)
- [Global-Settings](Global-Settings)
- [Cloud-Templates](Cloud-Templates)
