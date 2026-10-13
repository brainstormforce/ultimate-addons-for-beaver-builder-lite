# Module: image-separator

A single (optionally linked, optionally animated) image, absolutely positioned as a decorative separator overlapping section edges. Handles attachment caching and on-the-fly circle/square cropping.

Read `architecture.md` in this folder before changing this module.

## Rules

- New fields go in BOTH `image-separator-bb-2-2-compatibility.php` and `-less-than-2-2-compatibility.php` (`image-separator.php:410`).
- Emit position/gutter CSS through `esc_attr()` on every `$id`/`gutter` interpolation (`frontend.css.php:36`).
- `get_alt()` may return `null`; callers must tolerate it.

## Gotchas

- The separator is decorative but the `<img>` gets a real `alt` from the attachment and has NO `aria-hidden`/`role="presentation"` (`includes/frontend.php:32`) — screen readers announce a decorative image. Note the markup also carries `itemscope`/schema, suggesting deliberate SEO intent; resolve the a11y-vs-SEO tension before "fixing" blindly.
- The link `aria-label` hardcodes English `"Learn more - "` (`includes/frontend.php:24`), not wrapped in `__( …, 'uabb' )`; it degrades to a dangling `"Learn more - "` when `get_alt()` is `null`.
- `echo esc_attr( $settings->img_size ) + $margin_left + $margin_right` (`frontend.css.php:43`, `:134`, `:181`) — `esc_attr()` returns a string, then `+` forces numeric coercion, so the escaped value is discarded. The escape is dead/misleading; output is safe only because it is an int.
- Circle and square crops both set ratio 1:1 server-side (`image-separator.php:127`); the shape difference comes only from the CSS class. The server-side branch is vestigial.
- `@ini_set( 'memory_limit', '300M' )` during crop (`:143`) no-ops on hosts with `disable_functions` — large crops can still OOM.
- No `partial_refresh` — the module uses full-page refresh (likely so the waypoint animation re-runs); do not "optimise" it to partial without re-checking the animation.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
