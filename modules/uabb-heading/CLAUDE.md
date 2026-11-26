# Module: uabb-heading

An advanced heading: a configurable heading tag with optional link, a rich-text subheading, and a decorative separator (line / line+icon / line+image / line+text). Separator icon/image delegates to `image-icon`.

Read `architecture.md` in this folder before changing this module.

## Rules

- Whitelist the heading tag at render against `array( 'h1'..'h6' )` with an `h3` fallback (`includes/frontend.php:49`), then emit via `esc_attr()`.
- Whitelist the separator text tag at render too: `$separator_text_tag` is checked against `h1`–`h6`, `div`, `p`, `span` with an `h3` fallback at the top of `includes/frontend.php`, and all three separator branches print that variable. The field's `FLBuilderUtils::esc_tags` sanitizer runs only on BB's `save_settings` path, so it is not enough on its own.
- Escape by context: heading link `esc_url()`; heading text `wp_kses_post()` (`includes/frontend.php:56`); description via `wpautop( $wp_embed->autoembed( … ) )` then `wp_kses_post` (`:90`). Because `heading`/`description` allow `html` connections, keep `wp_kses_post` — do not switch to `esc_html`.

## Gotchas

- The two tag whitelists differ: the heading `tag` allows `h1`–`h6`, while the separator text tag also allows `div`/`p`/`span`. Adding an option to the `separator_text_tag_selection` field in the two config files also means adding it to the render whitelist, or it silently falls back to `h3`.
- The `stdClass` guard (`includes/frontend.php:11`) is cosmetic — `$settings->alignment`, `->tag`, `->heading`, etc. are accessed unguarded right after; it prevents a fatal-on-null, not undefined-property warnings. `$settings->link_nofollow` is read unguarded when `link` is set (`:54`).
- Two near-duplicate BB-version config files (`uabb-heading-bb-2-2-compatibility.php` / `-less-than-2-2`) hold duplicated `tag`/`separator_text_tag_selection` defaults — a field/default/sanitize change in one is easy to forget in the other.

## After changes

- Boundary, rule, or reasoning changed? Update `architecture.md` in the same change.
- Not for internal refactors that change nothing a caller can observe.
- New architectural decision? Add an ADR under `docs/decisions/`.
- Run: `composer run lint`
