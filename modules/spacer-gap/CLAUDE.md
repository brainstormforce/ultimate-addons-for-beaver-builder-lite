# Module: spacer-gap

A responsive vertical spacer: an empty `<div>` whose per-breakpoint height is set by inline CSS. No JS, no output logic.

Read `architecture.md` in this folder before changing this module.

## Rules

- Register through the BB-version fork (`spacer-gap.php:42`): `unit`-type fields (`spacer-gap-bb-2-2-compatibility.php`) vs legacy `text`-type fields. New fields go in both.

## Gotchas

- Validation is asymmetric between breakpoints: desktop uses `'' !== $settings->desktop_space` (string compare) at `frontend.css.php:35`, but medium/small use `is_numeric()` (`:43`, `:57`). A non-numeric desktop value (possible under the legacy `text` field) is echoed straight into `height:…px` via `esc_attr`, which does not enforce numeric-ness. The hard-coded `10` fallback is triplicated (`:35`, `:49`, `:62`) but effectively dead for medium/small, because an empty (`''`) value fails `is_numeric()` and emits no media query at all — editing the fallback without following the guard chain silently changes nothing.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
