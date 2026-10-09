---
module: image-icon
owner: brainstormforce
---

# image-icon

## Responsibility

Renders either a Font Awesome `<i>` icon or a WordPress image (library attachment or external URL), with per-type styling (color/gradient/border/3D/crop). It is UABB's canonical image-vs-icon renderer and is invoked by several other modules via `FLBuilder::render_module_html( 'image-icon', … )`.

## Why it is this way

- Because it is the shared renderer, its `includes/frontend.php` markup was copied into other modules rather than always delegated — so its accessibility and escaping decisions do not automatically propagate. A change here reaches only callers that delegate at runtime, not the ones holding a copy.
- Settings-form fields are split across two BB-version compat files so the same module supports old and new Beaver Builder field APIs.

## Related ADRs

None yet.
