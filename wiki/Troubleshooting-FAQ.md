# Troubleshooting & FAQ

## General

### Modules don't appear in Beaver Builder

**Cause:** Beaver Builder is not active.

UABB checks `class_exists('FLBuilder')` on every page load. If Beaver Builder is deactivated, UABB loads nothing.

**Fix:** Activate Beaver Builder (free or paid) from **Plugins → Installed Plugins**, then refresh.

---

### Admin notice: "Plugin requires Beaver Builder"

**Cause:** Same as above — Beaver Builder is missing or inactive.

**Fix:** Install and activate Beaver Builder. The notice disappears automatically once BB is active.

---

### Plugin failed to activate — memory error

**Cause:** `BB_Ultimate_Addon::activation_reset()` detected fewer than 15 MB of PHP memory available.

**Fix:** Increase your PHP memory limit. See the [UABB memory limit documentation](https://www.ultimatebeaver.com/docs/increase-memory-limit-site/) or contact your hosting provider.

---

### Icons not showing in the Beaver Builder icon picker

**Cause:** The UABB icon sets were not copied to Beaver Builder's icon cache, or the cache entry (`_uabb_enabled_icons`) is stale.

**Fix:**
1. Go to **Settings → Beaver Builder → UABB → Icons**
2. Click **Reload Icons**
3. This deletes `_uabb_enabled_icons` and triggers re-registration on next load

---

### Template Cloud shows no templates / loading error

**Possible causes:**
- Outbound HTTP from your server is blocked by a firewall
- The cloud API endpoint is down or returning an error
- The `_uabb_cloud_templats` cache contains stale/corrupt data

**Fix:**
1. Confirm your server can reach `https://templates.ultimatebeaver.com` (outbound HTTPS)
2. Delete the cache: `wp option delete _uabb_cloud_templats` (or via phpMyAdmin)
3. Reload the Template Cloud tab

---

### Global Settings button doesn't appear in the BB toolbar

**Cause:** `UABB_Global_Styling` requires `class_exists('FLBuilderAJAX')`. If the FLBuilderAJAX class isn't available (very old BB versions), the actions aren't registered and the button won't appear.

**Fix:** Update Beaver Builder to a recent version.

**Alternative:** The `uabb_global_support` filter may be returning `false`:

```php
// Check if anything in your theme/plugins does this:
add_filter( 'uabb_global_support', '__return_false' );
```

---

### "load_textdomain was called incorrectly" notice (WP 6.8)

**Fixed in v1.6.3.** Update to UABB Lite 1.6.3 or later.

---

### Button colours broken after Beaver Builder 2.10

**Fixed in v1.6.7.** Update to UABB Lite 1.6.7.

---

## WPML / Multilingual

### Module content is not showing in the WPML translation editor

**Cause:** The module is not registered in `UABBLite_WPML_Translatable::wpml_uabb_modules_translate()`.

**Affected modules (registered):** Button, Flip Box, Slide Box, Info List, Info Table, Image Separator, Heading, Ribbon.

If your module is **not** in this list, it needs to be added in `classes/class-uabb-wpml.php`. See [WPML-and-i18n](WPML-and-i18n).

---

### Info List items not translating in WPML

**Cause:** Info List uses a repeater form. A dedicated integration class (`WPML_UABB_Infolist`) handles it. The class is only loaded when `WPML_Page_Builders_Defined` exists.

**Fix:** Ensure WPML and the WPML Page Builders add-on are both active.

---

## Performance

### UABB is making too many database calls

UABB loads all options into `UABB_Init::$uabb_options` once on bootstrap (via `set_uabb_options()`). Repeated `get_option()` calls should not occur. If you observe many DB queries attributed to UABB, check for:
- Object cache disabled — use Redis or Memcached via a caching plugin
- High-traffic pages calling `UABB_Init::set_uabb_options()` outside bootstrap (should not happen in normal usage)

---

## Debugging

### Enable WP_DEBUG

Add to `wp-config.php`:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

Errors will be written to `wp-content/debug.log`.

### Check PHP error log

Module loading errors (missing files, class conflicts) will appear in the PHP error log. Check your server's error log path or configure `WP_DEBUG_LOG` as above.

---

## Getting Help

- **Documentation:** [ultimatebeaver.com/docs](https://www.ultimatebeaver.com/docs)
- **Support forum:** [WordPress.org support forum](https://wordpress.org/support/plugin/ultimate-addons-for-beaver-builder-lite/)
- **Contact:** [ultimatebeaver.com/contact](https://www.ultimatebeaver.com/contact/)
- **Security:** [Brainstorm Force Bug Bounty Program](https://brainstormforce.com/bug-bounty-program/)

---

## See Also

- [Getting-Started](Getting-Started)
- [Admin-Settings](Admin-Settings)
- [Cloud-Templates](Cloud-Templates)
- [WPML-and-i18n](WPML-and-i18n)
