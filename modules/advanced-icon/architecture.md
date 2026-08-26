---
module: advanced-icon
owner: brainstormforce
---

# advanced-icon

## Responsibility

Renders a repeatable group of linked icons/photos. Owns the wrapper `<div>`, the per-icon `<a>` links, and the layout/spacing/alignment CSS. The actual icon or photo visual for each item is delegated to the shared `image-icon` module.

## Why it is this way

- It is a thin wrapper over `image-icon` invoked once per repeater item, so its two render paths (HTML in `includes/frontend.php`, CSS in `frontend.css.php`) each build an `image-icon` settings array. Those two arrays intentionally pass different values for the two contexts — that asymmetry is invisible and undocumented in the code, which is why it is the module's main trap.

## Related ADRs

None yet.
