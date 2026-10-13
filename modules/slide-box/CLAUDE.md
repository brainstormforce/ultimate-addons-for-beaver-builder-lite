# Module: slide-box

A front face plus a reveal panel, in three interaction styles (overlay, angle-down dropdown, plus/minus dropdown). Front icon delegates to `image-icon`; back CTA to `uabb-button` or a plain link.

Read `architecture.md` in this folder before changing this module.

## Rules

- `register_module()`, the settings form, and `partial_refresh` are NOT in `slide-box.php` — they live in the two `slide-box-bb-*-compatibility.php` files, required by BB version (`slide-box.php:1178`).
- Front image/icon is delegated via `render_image()` → `FLBuilder::render_module_html( 'image-icon', … )` (`slide-box.php:1049`); back CTA via `render_button()` → `uabb-button` (`:1034`). Do not render `<img>`/`<i>` inline.
- Reveal is CSS-driven off the `.open-slidedown` class on `.uabb-styleN`; slide style drives the wrapper class + `data-style` (`includes/frontend.php:25`).
- Whitelist title tags at render with an `h3` fallback (`includes/frontend.php:56`, `:92`).

## Gotchas

- The public open/close trigger is NOT in this folder. `js/frontend.js` only closes *other* boxes on document-click and sets height for tab/accordion contexts — the actual reveal binding is a shared UABB script. "Why won't it open?" is not answerable from these files.
- `tabindex="0"` on the wrap (`includes/frontend.php:24`) with zero ARIA (no role/`aria-expanded`/`aria-controls`/`aria-hidden`). The back panel is hidden only by CSS `opacity:0; pointer-events:none`, so it stays in the a11y tree and its CTA stays tab-reachable while invisible. No `prefers-reduced-motion` guard.
- `render_dropdown_icon()` builds `$icon_settings` arrays that are never used (`slide-box.php:1136`) — the icon is hard-coded `<i class="fa fa-angle-down">`/`fa fa-plus`, so `dropdown_icon_*` settings do not reach the markup via this function.
- `js/frontend.js` binds `jQuery(document).on('click', …)` at file scope (`:1`); a partial refresh re-injecting the script duplicates that handler. `_setHeight` runs only for tab/accordion-nested boxes.
- The `stdClass` guard at `includes/frontend.php:13` gives false safety — `$settings->front_img_icon_position`, `slide_type`, etc. are dereferenced unguarded right after (`:22`).

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
