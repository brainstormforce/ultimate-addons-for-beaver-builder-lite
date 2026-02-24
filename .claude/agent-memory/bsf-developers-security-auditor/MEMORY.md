# Security Auditor Memory — UABB Lite

## Project Patterns

- Plugin root: `ultimate-addons-for-beaver-builder-lite/`
- Admin capability in use: `manage_options` (standardized in PR #210; old code used `delete_users` — flag any new use of `delete_users` as wrong cap)
- Filesystem writes go through `WP_Filesystem_Direct` via `self::load_filesystem()` + `self::$uabb_filesystem` (class-uabb-cloud-templates.php) — PR #212 pattern
- Nonce actions in use: `uabb_cloud_nonce` (AJAX cloud fetch), `uabb-reload-icons` (icon reload), `fl-uabb-nonce` / `fl-uabb-modules-nonce` / `fl-uabb-analytics-nonce` (admin form saves)

## Confirmed Vulnerabilities (unfixed as of PR review)

- `class-uabb-admin-settings.php:141,462` — still uses `delete_users` capability; PR #210 fix NOT applied to the live file
- `class-uabb-iconfonts.php:41` — still uses `wp_verify_nonce` directly (not `check_ajax_referer`); PR #210 fix NOT applied; also missing `return;` after `wp_send_json_error`
- `class-uabb-cloud-templates.php:259` — `check_ajax_referer` called with die-on-fail default (`true`), not `false`; PR #210 fix NOT applied; missing `return;` after error
- `class-uabb-cloud-templates.php:60-61` — `sections` and `presets` URLs still HTTP; PR #211 fix NOT applied
- `class-uabb-cloud-templates.php:85` — `sslverify => false` still present in `reset_cloud_transient()`; PR #211 fix NOT applied
- `class-uabb-cloud-templates.php:453-459` — `?debug` + `print_r()` block still present in `template_html()`; PR #211 fix NOT applied
- `bb-ultimate-addon.php:63` — `wp_die( esc_html($msg) )` strips HTML links from error message; PR #211 fix (`wp_kses`) NOT applied
- `includes/admin-settings-icons.php:23` — unescaped `echo sprintf(...)` with UABB_PREFIX; PR #211 fix NOT applied
- `includes/admin-settings-modules.php:16` — `echo sprintf(...)` partially fixed (line 27 looks escaped, line 16 is not); PR #211 fix NOT applied to header line
- `includes/admin-settings-template-cloud.php:13` — `_e('<a href="' . BB_ULTIMATE_ADDON_UPGRADE_URL . '"...')` unescaped URL concatenation; PR #211 fix NOT applied
- `includes/admin-settings-welcome.php:22,31,41` — multiple `printf()` calls with unescaped `BB_ULTIMATE_ADDON_UPGRADE_URL`/FB/Twitter URLs; PR #211 fix NOT applied
- `includes/ui-panel-sections.php:59` — `echo __($cat['name'])` unescaped; PR #211 fix NOT applied
- `includes/ui-panel-sections.php:94` — `echo admin_url()` unescaped in onclick, `echo sprintf(__(...))` unescaped; PR #211 fixes NOT applied

## Confirmed False Positives

- `class-uabb-cloud-templates.php` AJAX handler is only registered on `wp_ajax_` (admin-only), so unauthenticated access is not possible even without nonce — but nonce + cap check are still required best practice
- `UABB_PREFIX` constant is defined as an empty string in includes files — XSS risk is low in practice but still flagged per coding standards

## PR Review Notes

- All three PRs (#210, #211, #212) describe fixes that have NOT been merged into the live codebase as of this review
- PR #212 fixes (`esc_url_raw` on attachment, WP_Filesystem, tag whitelist for info-table) ARE present in the live files — these are the only fixes confirmed applied
- The `debug`/`print_r` block removed in PR #211 diff targets `fetch_cloud_templates()` but the actual debug block lives in `template_html()` at line 453 and is still present
