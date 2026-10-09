# Module: advanced-icon

A repeatable group (BB `form` field) of linked icons/photos. Owns only the wrapper and per-icon `<a>` links; each icon's visual is delegated to the shared `image-icon` module.

Read `architecture.md` in this folder before changing this module.

## Rules

- Icon rendering is delegated: `includes/frontend.php` calls `FLBuilder::render_module_html( 'image-icon', … )` (`:84`) and `frontend.css.php` calls `render_module_css( 'image-icon', … )` (`:139`). Editing icon markup/escaping belongs in `image-icon`, not here.
- `partial_refresh => true` (`advanced-icon.php:31`) — saves re-render only this module's HTML; state that must survive a save lives in settings.
- The repeater's `form => 'uabb_advicon_group_form'` (`:58`) must match the ID passed to `FLBuilder::register_settings_form()` (`:308`).

## Gotchas

- Highest-risk: the `$imageicon_array` in `includes/frontend.php` and in `frontend.css.php` are deliberately asymmetric, not copies. Sizes are doubled in CSS (`frontend.css.php:101` vs `frontend.php:48`); `icon_color_preset` is hardcoded `'preset1'` in HTML (`frontend.php:67`) but `$settings->color_preset` in CSS (`frontend.css.php:120`); per-icon color fallbacks to module-level values exist ONLY in CSS (`:123-135`). "Fixing" one file to match the other silently breaks sizing/colors.
- Empty-link icons emit `<a href="" …>` (`frontend.php:28`) — a focusable, unlabeled, self-referential link (this branch also drops the `aria-label` the populated branch has at `:32`).
- Repeater items are read unguarded — `$icon->connections->link` / `$icon->link` (`frontend.php:24`, `:28`) have no `isset`; older saved layouts emit PHP warnings. The `stdClass` guard at `:9` prevents "undefined variable" but not "undefined property", and `foreach ( $settings->icons )` fatals if `icons` is unset.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
