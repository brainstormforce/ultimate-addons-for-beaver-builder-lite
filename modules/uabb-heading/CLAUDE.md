# Module: uabb-heading

An advanced heading: a configurable heading tag with optional link, a rich-text subheading, and a decorative separator (line / line+icon / line+image / line+text). Separator icon/image delegates to `image-icon`.

Read `architecture.md` in this folder before changing this module.

## Rules

- Whitelist the heading tag at render against `array( 'h1'..'h6' )` with an `h3` fallback (`includes/frontend.php:52-53`), then emit via `esc_attr()`.
- Read the separator text tag only through `UABBHeadingModule::get_separator_text_tag( $settings )` (`uabb-heading.php`), which checks it against `h1`–`h6`, `div`, `p`, `span` with an `h3` fallback. Both `includes/frontend.php` (element name, three separator branches) and `includes/frontend.css.php` (CSS selectors, including the `FLBuilderCSS::typography_field_rule` selector) use its result — never `$settings->separator_text_tag_selection` directly. The field's `FLBuilderUtils::esc_tags` sanitizer runs only on BB's `save_settings` path, so it is not enough on its own.
- Escape by context: heading link `esc_url()`; heading text `wp_kses_post()` (`includes/frontend.php:59`); description via `wpautop( $wp_embed->autoembed( … ) )` then `wp_kses_post` (`:93`). Because `heading`/`description` allow `html` connections, keep `wp_kses_post` — do not switch to `esc_html`.

## Gotchas

- The two tag whitelists differ: the heading `tag` allows `h1`–`h6`, while the separator text tag also allows `div`/`p`/`span`. Adding an option to the `separator_text_tag_selection` field in the two config files also means adding it to the whitelist in `get_separator_text_tag()`, or it silently falls back to `h3`.
- The `stdClass` guard (`includes/frontend.php:11`) is cosmetic — `$settings->alignment`, `->tag`, `->heading`, etc. are accessed unguarded right after; it prevents a fatal-on-null, not undefined-property warnings. `$settings->link_nofollow` is read unguarded when `link` is set (`:57`).
- Two near-duplicate BB-version config files (`uabb-heading-bb-2-2-compatibility.php` / `-less-than-2-2`) hold duplicated `tag`/`separator_text_tag_selection` defaults — a field/default/sanitize change in one is easy to forget in the other.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
