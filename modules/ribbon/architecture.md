---
module: ribbon
owner: brainstormforce
---

# ribbon

## Responsibility

Renders a decorative corner/edge "ribbon" badge — a centered message in a heading tag, with folded end-caps, optional left/right icons, stitching lines, and a shadow. Message text, colors, width, and typography are settings-driven; all visual geometry is CSS built from `em` units.

## Why it is this way

- The fold/cap geometry is emergent across the PHP-generated responsive CSS branches and a static stylesheet rather than living in one place, and it relies on a negative-z-index stacking trick — so the "simple badge" appearance hides a set of layout dependencies (stacking context, parent overflow, cap-size math) that are easy to break.

## Related ADRs

None yet.
