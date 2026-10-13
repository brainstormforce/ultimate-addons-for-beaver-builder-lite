---
module: uabb-heading
owner: brainstormforce
---

# uabb-heading

## Responsibility

Renders an advanced heading: a configurable HTML heading tag (optionally linked), a rich-text subheading/description, and a decorative separator (line, line+icon, line+image, or line+text) positioned above, centered, or below the heading. Separator icon/image is delegated to the shared `image-icon` module.

## Why it is this way

- The heading tag gets defense-in-depth (input sanitize + render whitelist) while the separator text tag gets only input sanitize, because the separator allows non-heading tags (`div`/`p`/`span`) that the heading whitelist would reject — so the two paths cannot share one whitelist.

## Related ADRs

None yet.
