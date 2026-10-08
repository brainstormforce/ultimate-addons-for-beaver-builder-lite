# Module: core (`classes/`)

The plugin's engine room: bootstrap, static options cache, admin settings, analytics/cron, cloud templates, global styling, WPML, icon fonts, and BB compat shims.

Read `architecture.md` in this folder before changing this module.

## Rules

- Read module/branding/global options from the static cache `UABB_Init::$uabb_options` (`class-uabb-init.php:168`), not `get_option()` in hot paths.
- After writing a cached option, call `UABB_Init::set_uabb_options()` to refresh the static cache (`class-uabb-admin-settings.php:527`, `uabb-global-settings.php:132`). A new cached key must also be registered in that method's array (`class-uabb-init.php:169`) or reads throw undefined-index.
- Every WP-AJAX handler verifies a nonce AND `current_user_can( 'manage_options' )` (`class-uabb-iconfonts.php:41`, `class-uabb-cloud-templates.php:258`). There are no `wp_ajax_nopriv_*` endpoints.
- Do not redefine the branding constants `UABB_PREFIX` / `UABB_CAT` — set once in `set_constants()` (`class-uabb-helper.php:56`).

## Gotchas

- `image-icon`, `uabb-separator`, `uabb-button` are force-enabled regardless of the saved modules list (`class-uabb-helper.php:602`). They are hard dependencies — code trying to disable them via the option will find they still load.
- Two-phase init ordering: `init` priority 10 loads globals/fields/textdomain; priority 40 runs WPML, icon fonts, and `load_modules()` (`class-uabb-init.php:112-114`). Modules depend on globals already being loaded — reordering breaks registration.
- Multisite opt-in storage split: `uabb_usage_optin` is written via `FLBuilderModel::update_admin_settings_option()` (`class-uabb-admin-settings.php:513`) but read via plain `get_option()` (`:63`). On multisite these can target different stores — cron/opt-in can silently disagree.
- First-run icon copy is gated by the one-shot option `_uabb_enabled_icons` (`class-uabb-iconfonts.php:64`); "Reload Icons" just deletes it. If BB's cache dir is wiped but the option survives, icons vanish until reload.
- Beaver Builder guards are load-bearing: `UABB_Init` aborts all loading if `FLBuilder` is absent (`class-uabb-init.php:27`), and `FL_BUILDER_VERSION` is defensively defined to `''` if unset (`class-uabb-compatibility.php:11`). Do not remove these.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint` and `composer run phpstan`
