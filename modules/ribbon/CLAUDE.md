# Module: ribbon

A decorative corner/edge "ribbon" badge: a centered heading-tag pill with folded end-caps, optional icons, and stitching, built from `em` units.

Read `architecture.md` in this folder before changing this module.

## Rules

- Whitelist the ribbon tag against `$allowed_tags` with an `h3` fallback (`includes/frontend.php:20`); never echo the tag raw.
- Escape by sink: tag/icons/aria-label via `esc_attr`; the visible message via `wp_kses_post( $settings->title )` (`includes/frontend.php:32`) — the "Ribbon Message" field intentionally allows post-level HTML.
- Run every color through `FLBuilderColor::hex_or_rgb()` before emitting (`frontend.css.php:31`).

## Gotchas

- End-caps use `z-index:-1` and depend on `.uabb-ribbon` establishing a stacking context with `z-index:0` (`frontend.css.php:131`, `css/frontend.css:13`). A theme/parent that creates an intervening stacking context or drops that `z-index:0` makes the caps vanish or overlap the text.
- Fold geometry (`content:""; position:absolute` for the caps/pseudo-elements) is emitted ONLY inside the responsive branches of `frontend.css.php` (`:193`, `:295`, `:415`), not in the static `css/frontend.css` — the static stylesheet alone renders no folds.
- Width math is `calc(… - 7em)` = 2 × 3.5em end-cap offset (`frontend.css.php:107`); caps overhang by `left/right:-3.5em`. Changing cap size breaks the width; a parent with `overflow:hidden` clips the folds.
- `role="banner"` + `tabindex="0"` on every instance (`includes/frontend.php:24`) — `banner` is a top-level landmark, so multiple ribbons create duplicate landmarks plus a dead tab stop. (Icons are correctly `aria-hidden`.)
- Hardcoded `font-family: FontAwesome` (`css/frontend.css:29`) assumes the legacy FA face; FA 5/6 use different family names.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
