# Module: uabb-separator

A presentational horizontal divider line: two nested `<div>`s styled with a configurable `border-top`, percentage width, and alignment. No JS, no runtime state.

Read `architecture.md` in this folder before changing this module.

## Rules

- Register form fields in the BB-version compat files, not `uabb-separator.php` (`:43`): `uabb-separator-bb-2-2-compatibility.php` vs `-less-than-2-2`. Edit both when changing fields.
- All visuals come from the generated `.fl-node-<id>` CSS in `includes/frontend.css.php:26` — the divider has no inline styles.

## Gotchas

<!-- Nothing load-bearing: no JS runtime, no state, no security surface. The only
     non-obvious facts are the compat-file split (above) and that the height/width
     fields carry no `default`, so `frontend.css.php:22` supplies 1 / 100. -->

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
