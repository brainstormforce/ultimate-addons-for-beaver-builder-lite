---
module: info-table
owner: brainstormforce
---

# info-table

## Responsibility

Renders a card ("info table") of icon/image + title + sub-heading + description + optional CTA button, with two box designs and three link modes (whole-card link, CTA button, or none). Icon/image rendering is delegated to the shared `image-icon` module.

## Why it is this way

- It carries a large `filter_settings()` typography migration because Beaver Builder's typography schema changed across versions; the module remaps legacy per-property font settings into the newer typography arrays, which is why so much of the class is version-forked back-compat code rather than rendering logic.

## Related ADRs

None yet.
