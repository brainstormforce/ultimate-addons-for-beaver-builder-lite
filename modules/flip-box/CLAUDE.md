# Module: flip-box

A two-sided flip card: a `.uabb-front` / `.uabb-back` pair inside a `perspective` wrapper, rotated by CSS 3D transforms. Icon delegates to `image-icon`, CTA to `uabb-button`.

Read `architecture.md` in this folder before changing this module.

## Rules

- The flip is triggered by JS adding `.uabb-hover` to the outer wrapper (`js/frontend.js:55`), NOT by CSS `:hover` (pure `:hover` only bumps `z-index`). To make it flip, produce that class.
- Faces start at `opacity:0` and are revealed to `opacity:1` by a `setTimeout(…, 1000)` in JS (`js/frontend.js:78`). Any change must keep that JS running or the module renders blank.
- Flip direction is a `flip_type` class echoed onto `.uabb-flip-box` (`includes/frontend.php:21`); each value has its own transform block in `css/frontend.css`. Add a new type in both places.
- Whitelist heading tags at render with an `h2` fallback (`includes/frontend.php:25`, `:48`) — do not echo the tag raw.
- No `partial_refresh` is set (`flip-box.php:20`), so saves do a full reload — which is what re-runs the init JS. Do not assume the hover/height JS re-binds on a partial refresh.

## Gotchas

- Keyboard is broken: the wrapper has `tabindex="0"` (`includes/frontend.php:20`) but there is no key handler and no `:focus` flip rule — a keyboard user can focus the card but never flip it, so back content is unreachable.
- Touch is broken: the mobile click-to-flip handler is commented out (`js/frontend.js:44`) and the hover binding is gated to non-mobile UAs (`:55`) — on touch the box never flips.
- No ARIA state (no `aria-expanded`/`aria-hidden`), so screen readers announce both faces at once. No `prefers-reduced-motion` guard anywhere in `css/frontend.css`.
- Class-name mismatch: JS adds `uabb_disable_middle` but the CSS rule targets `.ifb_disable_middle` (`js/frontend.js:153` vs `css/frontend.css:833`) — the "disable vertical middle" fix never applies, so tall content can clip.
- Unscoped selectors: `_uabbFlipBoxResponsive()` and the reveal line use bare `$('.uabb-flip-box-outter')` / `$('.uabb-face')` (`js/frontend.js:79`, `:86`) — with multiple flip boxes on a page, one instance's handler mutates every box's height.
- Much of the door-flip / `style_9` CSS (`css/frontend.css:394-795`) has no matching markup in Lite — it is dead/Pro-only weight; do not assume editing it changes anything here.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
