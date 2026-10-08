---
module: uabb-button
owner: brainstormforce
---

# uabb-button

## Responsibility

Renders a styled call-to-action button as an `<a href>` link, with flat/transparent/3D style variants, an optional icon before or after the text, and theme-color-aware CSS. Ships two settings-form registrations selected by Beaver Builder version.

## Why it is this way

- Button color resolution was deliberately moved into the shared `classes/uabb-global-functions.php` theme wrappers (rather than the module) so the same logic serves BB theme integration and the BB 2.10 color fix in one place — which is why the module folder does not need a version bump for a color change and why color bugs are debugged there, not here.

## Related ADRs

None yet.
