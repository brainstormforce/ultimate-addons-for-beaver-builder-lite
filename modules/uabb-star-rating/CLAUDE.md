# Module: uabb-star-rating

A display-only star rating: a title plus a row of filled/partial/empty stars derived from a numeric rating on a 5- or 10-star scale. No interactivity.

Read `architecture.md` in this folder before changing this module.

## Rules

- Partial fill maps in tenths only: the class is `'uabb-star-' . ( $rating - $floored_rating ) * 10` (`includes/frontend.php:40`) and `css/frontend.css:26` only defines integer classes `uabb-star-0`…`uabb-star-10`. Keep partial values at tenth precision.
- Clamp `$rating` to `rating_scale` before rendering (`includes/frontend.php:32`) so a value above the scale can't overflow the loop.
- Partial fill is a clipped `i:before` overlay, not a half glyph — changing fill mechanics means editing the class arithmetic and the width rules together.

## Gotchas

- Off-grid fractional ratings render as a FULL star: a value like 4.25 → class `uabb-star-2.5`, which matches no CSS rule, so `i:before` keeps its default (uncapped) width (`includes/frontend.php:40`). The `.5` slider step protects normal editing, but typed or `connections`-fed values can silently full-fill.
- Weak a11y: `aria-label` is a bare number (e.g. "4"), not "4 out of 5 stars", with no `role="img"` (`includes/frontend.php:17`); the star `<i>` glyphs have no `aria-hidden` (`:38`); and `tabindex="0"` sits on a non-interactive `div`.
- Glyph source split: `css/frontend.css:15` uses FA `\f005` while `frontend.css.php:65` overrides to Unicode `\002605` for non-empty stars — two glyph systems in play; empty vs filled can resolve differently by specificity/load order.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
