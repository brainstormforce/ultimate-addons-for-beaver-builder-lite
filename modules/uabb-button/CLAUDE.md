# Module: uabb-button

A styled call-to-action rendered as an `<a href>` link, with flat/transparent/3D variants and an optional Font Awesome icon.

Read `architecture.md` in this folder before changing this module.

## Rules

- Keep it an anchor (`includes/frontend.php:36`), never a `<button>`. Run the link through `esc_url()` and the target through `esc_attr()`.
- Emit `rel` only through `UABB_Helper::get_link_rel()` (`includes/frontend.php:36`; helper at `classes/class-uabb-helper.php:677`) — the single source for `noopener`/`nofollow`.
- Color output must pass the theme wrappers, then `FLBuilderColor::hex_or_rgb()` (`frontend.css.php:41`) — do not print `bg_color`/`text_color` directly.
- New fields go in BOTH `uabb-button-bb-2-2-compatibility.php` and `-less-than-2-2-compatibility.php`, plus a migration branch in `filter_settings()` (`uabb-button.php:121`).

## Gotchas

- The BB-2.10 button-color logic is NOT in this module — color is resolved by `uabb_theme_button_bg_color()` / `_text_color()` / `_text_hover_color()` in `classes/uabb-global-functions.php:400/493/541`. A color bug will not be found by reading this folder.
- Magic-string comparison `'' !== text_hover_color && 'FFFFFF' !== text_hover_color` (`frontend.css.php:611`) treats a deliberately-white hover text as "unset" and falls back to `text_color` — white is un-selectable as a real hover value.
- The icon `<i>` has no `aria-hidden="true"` (`includes/frontend.php:46`, `:58`); `role="button"` on a real link (`:36`) overrides the native "link" semantic while it still navigates via href.
- `three_d` is unset in `update()` (`uabb-button.php:45`) but still read in `frontend.css.php:67` to force `style='gradient'` for legacy nodes — the two must stay in sync.
- `target="_blank"` gets `noopener` but not `noreferrer` (`class-uabb-helper.php:680`).

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
