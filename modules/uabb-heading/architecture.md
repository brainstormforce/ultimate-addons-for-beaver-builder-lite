---
module: uabb-heading
owner: brainstormforce
---

# uabb-heading

## Responsibility

Renders an advanced heading: a configurable HTML heading tag (optionally linked), a rich-text subheading/description, and a decorative separator (line, line+icon, line+image, or line+text) positioned above, centered, or below the heading. Separator icon/image is delegated to the shared `image-icon` module.

## Why it is this way

- Both tag settings get defense-in-depth (input sanitize + render whitelist), but with separate whitelists: the separator allows non-heading tags (`div`/`p`/`span`) that the heading whitelist would reject.
- The separator text tag is used in two templates — as an element name in `includes/frontend.php` and inside CSS selectors in `includes/frontend.css.php` — so its whitelist lives in one place, `UABBHeadingModule::get_separator_text_tag()`, and both templates call it. This keeps the CSS targeting the same tag the HTML renders, and stops a stored value from injecting CSS rules or selectors. The field's `esc_tags` sanitizer is not enough on its own because it runs only on Beaver Builder's `save_settings` path.

## Related ADRs

None yet.
