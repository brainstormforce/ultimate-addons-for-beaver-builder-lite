# Module Reference

UABB Lite ships 13 modules, all in the **UABB Modules** group inside the Beaver Builder content panel. Each module lives in `modules/{slug}/` and extends `FLBuilderModule`.

---

## Module Index

| Module | Slug | Class | Partial Refresh |
|--------|------|-------|----------------|
| [Advanced Icons](#advanced-icons) | `advanced-icon` | `UABBAdvancedIconModule` | No |
| [Button](#button) | `uabb-button` | `UABBButton` | No |
| [Flip Box](#flip-box) | `flip-box` | `UABBFlipBoxModule` | No |
| [Heading](#heading) | `uabb-heading` | `UABBHeadingModule` | Yes |
| [Image Icon](#image-icon) | `image-icon` | `ImageIconModule` | No |
| [Image Separator](#image-separator) | `image-separator` | `UABBImageSeparatorModule` | No |
| [Info List](#info-list) | `info-list` | `UABBInfoListModule` | No |
| [Info Table](#info-table) | `info-table` | `UABBInfoTableModule` | Yes |
| [Ribbon](#ribbon) | `ribbon` | `UABBRibbonModule` | No |
| [Simple Separator](#simple-separator) | `uabb-separator` | `UABBSeparatorModule` | Yes |
| [Slide Box](#slide-box) | `slide-box` | `UABBSlideBoxModule` | No |
| [Spacer / Gap](#spacer--gap) | `spacer-gap` | `UABBSpacerGapModule` | No |
| [Star Rating](#star-rating) | `uabb-star-rating` | `UABBStarRating` | No |

---

## Advanced Icons

**Slug:** `advanced-icon` | **Class:** `UABBAdvancedIconModule`

Displays one or more icons or images in a configurable group layout. Supports a repeater field (`form` type) so editors can add multiple icon/image items in a single module instance.

**Key fields:**
- `icons` — Repeater of image/icon items (type: `form`, multiple: `true`)

**Use case:** Icon grids, feature lists with visual icons, image+icon mixed rows.

---

## Button

**Slug:** `uabb-button` | **Class:** `UABBButton`

A call-to-action button with advanced styling options including hover effects, gradients, and border radius. Described as "A simple call to action button."

**Use case:** Primary CTAs, inline action links, promotional buttons with hover animation.

---

## Flip Box

**Slug:** `flip-box` | **Class:** `UABBFlipBoxModule`

A box with a front face and a back face that flips on hover (CSS 3D transform). Supports separate content, background colours, and images for front and back.

**Use case:** Feature highlights, product teaser cards, interactive content reveals.

**Known fix (v1.5.14):** Box content bounce on page load was resolved.

---

## Heading

**Slug:** `uabb-heading` | **Class:** `UABBHeadingModule` | **Partial refresh:** Yes

An advanced heading module supporting main heading text, a sub-heading line, separator lines, and background colour/padding. Integrates `$wp_embed->autoembed` for description parsing.

**Key settings:** Heading tag (H1–H6), separator style, background colour, padding.

**WPML:** Heading and Ribbon module received WPML compatibility in v1.5.9.

---

## Image Icon

**Slug:** `image-icon` | **Class:** `ImageIconModule`

Displays an icon or image with optional title, description, and link. Includes BB version compatibility shims (`image-icon-bb-2-2-compatibility.php` for BB 2.2+, `image-icon-bb-less-than-2-2-compatibility.php` for earlier versions).

**Use case:** Icon boxes, feature list items, icon+text combinations.

---

## Image Separator

**Slug:** `image-separator` | **Class:** `UABBImageSeparatorModule`

Uses an image as a decorative separator between content sections. Fixes a scroll-bar issue on small devices (v1.0.1).

**Use case:** Visual dividers between page sections using custom artwork or shapes.

---

## Info List

**Slug:** `info-list` | **Class:** `UABBInfoListModule` | **Partial refresh:** No

A structured list module where each item has an icon, title, and description. Useful for ordered or unordered feature/benefit lists.

**Known fixes:**
- v1.5.13: Undefined array key warning when selecting image size
- v1.5.8: PHP 8 undefined variable
- v1.5.3: PHP Fatal error with WPML
- v1.5.4: PHP notice error

---

## Info Table

**Slug:** `info-table` | **Class:** `UABBInfoTableModule` | **Partial refresh:** Yes

A table-style information box, useful for comparing features or presenting structured data visually.

**Use case:** Feature comparison tables, spec sheets, service breakdowns.

---

## Ribbon

**Slug:** `ribbon` | **Class:** `UABBRibbonModule`

Adds a corner or edge ribbon/badge to a BB row or column. Often used to highlight "NEW", "SALE", or "POPULAR" items.

**WPML:** Received WPML compatibility in v1.5.9.

---

## Simple Separator

**Slug:** `uabb-separator` | **Class:** `UABBSeparatorModule` | **Partial refresh:** Yes

A horizontal divider line with style options (solid, dashed, dotted, double) and optional icon or text in the centre.

**Use case:** Content section dividers with visual flair.

---

## Slide Box

**Slug:** `slide-box` | **Class:** `UABBSlideBoxModule`

A box that reveals additional content via a CSS slide animation on hover. Front content is always visible; back content slides in on hover.

**Use case:** Hover-reveal info panels, team cards, product feature highlights.

---

## Spacer / Gap

**Slug:** `spacer-gap` | **Class:** `UABBSpacerGapModule` | **Partial refresh:** No

Adds configurable vertical whitespace between layout elements. Supports responsive height settings per breakpoint.

**Use case:** Precise spacing control between rows, columns, or modules.

---

## Star Rating

**Slug:** `uabb-star-rating` | **Class:** `UABBStarRating`

Displays a star rating (typically 1–5) with customisable icon, colour, size, and optional text label.

**Use case:** Product ratings, testimonial scores, review widgets.

---

## Theme Overrides

Any module can be overridden by placing a file at:

```
{child-theme}/bb-ultimate-addon/modules/{slug}/{slug}.php
{parent-theme}/bb-ultimate-addon/modules/{slug}/{slug}.php
```

The plugin's copy in `modules/` is used as a fallback. See [Module-Architecture](Module-Architecture) for the full loading order.

---

## See Also

- [Module-Architecture](Module-Architecture)
- [Admin-Settings](Admin-Settings)
- [WPML-and-i18n](WPML-and-i18n)
