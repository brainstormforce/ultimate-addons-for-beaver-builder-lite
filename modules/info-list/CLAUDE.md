# Module: info-list

A repeatable list where each item pairs an icon/image (delegated to `image-icon`) with a title + description and an optional link, plus a Waypoints "pulse" animation.

Read `architecture.md` in this folder before changing this module.

## Rules

- Iterate items through `render_list()` → `render_each_item()` (`info-list.php:220`), not inline.
- Keep the outer list `<ul>` and each item `<li>` (`includes/frontend.php:20`, `info-list.php:155`) — the module already uses correct list semantics; preserve them.
- Constrain the title tag to the whitelist with an `h3` fallback (`info-list.php:176`).
- Icon/image is rendered only via `FLBuilder::render_module_html( 'image-icon', … )` (`info-list.php:126`).

## Gotchas

- `esc_attr( UABB_Helper::get_link_rel( … ) )` (`info-list.php:160`, `:181`) likely over-escapes a full `rel="…"` attribute string, breaking the attribute; line 167 additionally double-escapes the args. Verify what `get_link_rel()` returns before editing.
- Remote `getimagesize( $item->photo_url )` runs during CSS generation (`frontend.css.php:392`) — a synchronous outbound HTTP fetch on a user-supplied URL (perf + SSRF vector).
- `round( 100 / count( $settings->add_list_item ) )` has no empty guard (`frontend.css.php:246`) → `DivisionByZeroError` on an empty list.
- Link target/nofollow field names differ by BB version (`list_item_link_target` vs `list_item_url_target`), gated on `check_bb_version()` (`info-list.php:139`) — the migration in `filter_settings` and the render path must stay in sync.
- Repeater items are read unguarded (`info-list.php:163`, `:193`, `:223`) while `frontend.css.php` guards the same fields — inconsistent hardening; `strpos( null, … )` deprecates on PHP 8.1+.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
