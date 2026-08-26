# Module: image-icon

The plugin's canonical image-vs-icon renderer: a Font Awesome `<i>` or a WordPress image, with per-type styling. Its markup is reused by many other UABB modules (see R2 in the root CLAUDE.md).

Read `architecture.md` in this folder before changing this module.

## Rules

- Branch on `$settings->image_type` — render nothing unless it is `'icon'` or `'photo'`; mirror the guard in both `includes/frontend.php:19` and `frontend.css.php:27`.
- Route image data through the getters, never raw settings: `get_src()` / `get_alt()` / `get_classes()` (`includes/frontend.php:32`).
- A field change must be made in BOTH `image-icon-bb-2-2-compatibility.php` and `image-icon-bb-less-than-2-2-compatibility.php` (required at `image-icon.php:432`/`:434`).
- The `stdClass` fallbacks and pre-initialised vars (`includes/frontend.php:9`, `frontend.css.php:9`) are guards against undefined-property warnings — do not strip them.

## Gotchas

- The decorative `<i>` icon has no `aria-hidden="true"` and no accessible label (`includes/frontend.php:25`) — screen readers announce nothing meaningful. This exact `<span class="uabb-icon-wrap">…<i>` pattern is COPIED, not shared, into 6+ modules (info-table, info-list, flip-box, ribbon, advanced-icon, …); fixing this file alone does NOT fix the copies.
- `get_alt()` already HTML-encodes via `htmlspecialchars(…, ENT_QUOTES)` (`image-icon.php:270`) and the template then re-runs `esc_attr()` — alt text containing `&`/quotes can double-encode.
- `$_SERVER['HTTP_HOST']` is read unsanitized in the demo-URL comparison (`image-icon.php:246`) — low exploitability but a WPCS lint flag.
- Meaningful images can ship with empty `alt` — there is no author-facing alt field, so `get_alt()` returns `null` (→ `alt=""`) whenever the attachment has no alt/description/caption/title.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
