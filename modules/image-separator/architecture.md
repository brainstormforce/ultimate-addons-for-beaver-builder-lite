---
module: image-separator
owner: brainstormforce
---

# image-separator

## Responsibility

Renders a single decorative image, optionally linked and optionally animated, absolutely positioned so it overlaps section edges as a separator. Owns attachment-data caching, on-the-fly cropping (circle/square) into BB's cache directory, and the settings→CSS position/size mapping.

## Why it is this way

- The template deliberately emits `itemscope`/`schema.org/ImageObject` markup with a real `alt`, which is an SEO choice that sits in tension with the a11y guidance to make a decorative image `aria-hidden`. That tension is why the alt/aria handling should not be changed without a product decision.

## Related ADRs

None yet.
