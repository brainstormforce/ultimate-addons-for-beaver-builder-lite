---
module: uabb-star-rating
owner: brainstormforce
---

# uabb-star-rating

## Responsibility

Renders a static, display-only star rating: a title plus a row of filled/partial/empty star glyphs derived from a numeric rating on a 5- or 10-star scale, with color/size/spacing/layout styling. No interactivity — purely presentational output.

## Why it is this way

- Partial stars are drawn by clipping a colored `i:before` overlay to a tenth-based width class rather than by half-star glyphs, which is why the rating must land on a tenth grid — off-grid values have no matching width rule and fall back to a full star.

## Related ADRs

None yet.
