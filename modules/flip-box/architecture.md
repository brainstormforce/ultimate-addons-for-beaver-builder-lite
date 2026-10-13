---
module: flip-box
owner: brainstormforce
---

# flip-box

## Responsibility

Renders a two-sided flip card — a front face and a back face inside a 3D-perspective wrapper — where CSS transforms rotate between them and JS toggles the flip state and syncs the two faces' heights. The icon and CTA are not rendered here: they are delegated to the shared `image-icon` and `uabb-button` modules.

## Why it is this way

- Reveal depends on a timed JS opacity flip rather than pure CSS, so the faces are hidden until JS runs. This is what makes a JS failure blank the whole module — there is no CSS-only fallback.
- The flip mechanism is deliberately split across three files (PHP markup, `css/frontend.css` transforms, `js/frontend.js` trigger), which is why the trigger being JS-class-based (not CSS `:hover`) is non-obvious from any single file.

## Related ADRs

None yet.
