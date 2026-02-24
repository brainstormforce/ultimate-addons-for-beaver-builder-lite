# UABB Lite — WP Reviewer Memory

## Plugin Conventions
- **Prefix**: `uabb` / `UABB` / `BB_Ultimate_Addon` / `UABBBuilder*`
- **Text domain**: `uabb` (consistent throughout)
- **Option prefix**: `_uabb_`, `_fl_builder_uabb*`, `uabb_*`
- **Nonce actions in use**: `uabb`, `uabb-modules`, `uabb-analytics`, `uabb-reload-icons`, `uabb_cloud_nonce`
- **Capability standard**: `manage_options` (post-PR #210 fix)
- **Filesystem abstraction**: `WP_Filesystem_Direct` via `UABB_Cloud_Templates::load_filesystem()` / `self::$uabb_filesystem`

## Known Patterns
- `class-uabb-admin-settings.php` calls `self::save()` inside `init_hooks()` which runs on `after_setup_theme` — save runs before full admin context but is gated by nonce + capability check, considered acceptable by team.
- `reset_cloud_transient()` still has `sslverify => false` in the non-AJAX path (only the AJAX `fetch_cloud_templates` method was in scope for the PR). The `sslverify` issue in `reset_cloud_transient` is a known remaining issue.
- `class-uabb-cloud-templates.php` `template_html()` still contains a `print_r()` debug block gated by `$_GET['debug']` — PR #211 only removed the inner-else branch of that block; the outer block (inside the `count > 0` branch) was NOT removed and still exposes debug output.
- `UABB_Attachment` (`class-uabb-attachment.php`) uses `attachment_fields_to_save` filter — WordPress core provides nonce/auth for this context, so no additional nonce check is needed by the plugin.
- `admin-settings-modules.php` file on disk already has the PR #211 fix applied (escaped output).

## False Positives to Skip
- `__CLASS__ . '::method'` string callback syntax — valid PHP/WordPress pattern for static callbacks.
- `// @codingStandardsIgnoreLine` comments — team-accepted suppressions for legacy code.
- Double `wp_enqueue_script` calls for `uabb-cloud-templates` and `uabb-lazyload` in `styles_scripts()` — cosmetic duplication, not a security issue.

## Files Reviewed (Session 1 — PR #210, #211, #212)
- `bb-ultimate-addon.php`
- `classes/class-uabb-admin-settings.php`
- `classes/class-uabb-cloud-templates.php`
- `classes/class-uabb-iconfonts.php`
- `classes/class-uabb-attachment.php`
- `modules/info-table/includes/frontend.php`
- `includes/admin-settings-icons.php`
- `includes/admin-settings-modules.php`
- `includes/admin-settings-template-cloud.php`
- `includes/admin-settings-welcome.php`
- `includes/ui-panel-sections.php`
