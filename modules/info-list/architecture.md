---
module: info-list
owner: brainstormforce
---

# info-list

## Responsibility

Renders a repeatable vertical/horizontal list of items, each pairing an icon or image (delegated to `image-icon`) with a title, description, and optional per-item link, plus an optional Waypoints-triggered "pulse" animation. Settings-form config is split across two BB-version files.

## Why it is this way

- Per-item link field names were renamed between BB versions, so the module keeps a `filter_settings` migration and two render branches; touching link handling in only one silently breaks the other BB era.

## Related ADRs

None yet.
