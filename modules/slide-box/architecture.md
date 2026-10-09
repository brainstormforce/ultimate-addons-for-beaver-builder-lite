---
module: slide-box
owner: brainstormforce
---

# slide-box

## Responsibility

Renders a two-face "slide box": a visible front face and a hidden back panel that reveals on interaction, in three styles (overlay/hover, angle-down dropdown, plus/minus dropdown). Front image/icon and back CTA are delegated to the shared `image-icon` and `uabb-button` modules; the reveal is toggled by a CSS class set by JS outside this folder.

## Why it is this way

- The interaction contract is intentionally spread beyond this folder: `register_module`, the form, `partial_refresh`, and the per-instance CSS live in the two BB-version compat files, and the public reveal trigger lives in a shared script. The local `js/frontend.js` looks like the interaction layer but only handles "close others" and height — a newcomer cannot infer real behavior from these files alone.

## Related ADRs

None yet.
