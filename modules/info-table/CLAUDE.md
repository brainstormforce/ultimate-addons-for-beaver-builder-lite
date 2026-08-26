# Module: info-table

A pricing/feature "info table" card: icon/image (delegated to `image-icon`) + title + sub-heading + description + optional CTA button.

Read `architecture.md` in this folder before changing this module.

## Rules

- Constrain title/sub-heading tags to `$allowed_tags` with `in_array( …, true )` before emitting (`includes/frontend.php:26`); defaults are `h3` (title) and `h5` (sub-heading).
- Escape link URLs with `esc_url()` and targets with `esc_attr()` for all three anchor emissions (`includes/frontend.php:20`, `:40`, `:87`).
- `partial_refresh => true` (`info-table.php:30`) — the template must be self-contained.

## Gotchas

- Tag safety depends ENTIRELY on the `in_array` whitelist (`includes/frontend.php:27`), not on `esc_attr` — `esc_attr` does not neutralise a bad tag name. Adding a value to `$allowed_tags` carelessly bypasses the protection.
- The `cta` non-design02 button (`includes/frontend.php:85`) does NOT route through `UABB_Helper::get_link_rel()`, unlike the other two anchors — a `target="_blank"` here gets no `rel="noopener"` (tabnabbing) and no nofollow.
- Suspected migration bug: inside the button font-size branch, `btn_font_typo['font_size']` is set from `$settings->sub_heading_font_size['desktop']` (`info-table.php:545`) — migrated old pages may get the button font size from the sub-heading.
- The `filter_settings()` typography migration is ~620 lines gated on `check_bb_version()` / `check_old_page_migration()` (`info-table.php:43`) — high-risk; do not touch without understanding the BB-version forks.
- Default sub-heading `h5` under an `h3` title skips `h4` (outline jump); both tags also allow `div`/`p`/`span`.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
