# Ultimate Addons for Beaver Builder – Lite

**Version:** 1.6.7 · **Author:** [Brainstorm Force](https://www.brainstormforce.com) · **License:** GPL-2.0+

Ultimate Addons for Beaver Builder (UABB) Lite is a free WordPress plugin that extends [Beaver Builder](https://www.wpbeaverbuilder.com/) with 13 additional design modules and a template cloud of pre-built sections and page layouts. No coding required — everything works inside the familiar Beaver Builder editor.

---

## Quick Links

| I want to… | Go to |
|-----------|-------|
| Install the plugin | [Getting Started](Getting-Started) |
| Understand how the plugin works | [Architecture Overview](Architecture-Overview) |
| Browse available modules | [Module Reference](Module-Reference) |
| Configure admin settings | [Admin Settings](Admin-Settings) |
| Set up global styling | [Global Settings](Global-Settings) |
| Use template cloud | [Cloud Templates](Cloud-Templates) |
| Set up a dev environment | [Environment Configuration](Environment-Configuration) |
| Contribute code | [Contributing Guide](Contributing-Guide) |
| Deploy a release | [Deployment Guide](Deployment-Guide) |
| Fix a problem | [Troubleshooting & FAQ](Troubleshooting-FAQ) |
| See what changed | [Changelog](Changelog) |

---

## Free Modules (13 total)

| Module | Slug | Description |
|--------|------|-------------|
| Advanced Icons | `advanced-icon` | Repeatable icon/image group |
| Button | `uabb-button` | CTA button with hover effects |
| Flip Box | `flip-box` | 3D flip-on-hover content card |
| Heading | `uabb-heading` | Advanced heading with separator and sub-heading |
| Image Icon | `image-icon` | Icon or image with title and description |
| Image Separator | `image-separator` | Image used as a decorative section divider |
| Info List | `info-list` | List with icons, titles, and descriptions |
| Info Table | `info-table` | Structured information table |
| Ribbon | `ribbon` | Corner/edge badge overlay |
| Simple Separator | `uabb-separator` | Styled horizontal divider line |
| Slide Box | `slide-box` | Hover-reveal slide animation box |
| Spacer / Gap | `spacer-gap` | Responsive vertical whitespace |
| Star Rating | `uabb-star-rating` | 1–5 star rating display |

→ Full details: [Module Reference](Module-Reference)

---

## Architecture at a Glance

```
plugins_loaded
└── BB_Ultimate_Addon
    └── UABB_Init
        ├── includes all classes
        ├── init (priority 10) → fields, global settings, text domain
        └── init (priority 40) → WPML, icon fonts, load_modules()
            └── modules/{slug}/{slug}.php (extends FLBuilderModule)
```

→ Full details: [Architecture Overview](Architecture-Overview)

---

## Requirements

| Requirement | Minimum |
|------------|---------|
| PHP | 7.0 |
| WordPress | 4.6 |
| Beaver Builder | Any edition (free or paid) |
| PHP Memory | 15 MB available |

---

## Developer Resources

- [Environment Configuration](Environment-Configuration) — PHP/Node tooling, Composer scripts
- [Testing Guide](Testing-Guide) — PHPStan (level 9), PHPCS, security rules
- [Contributing Guide](Contributing-Guide) — branching, code standards, adding modules
- [Deployment Guide](Deployment-Guide) — GitHub Actions, WordPress.org SVN, release process
- [AJAX Endpoints](AJAX-Endpoints) — all AJAX hooks documented
- [Plugin Constants & Globals](Plugin-Constants-and-Globals) — all `define()` constants, DB option keys

---

## Links

- [WordPress.org Plugin Page](https://wordpress.org/plugins/ultimate-addons-for-beaver-builder-lite/)
- [Official Documentation](https://www.ultimatebeaver.com/docs)
- [Support Forum](https://wordpress.org/support/plugin/ultimate-addons-for-beaver-builder-lite/)
- [GitHub Repository](https://github.com/brainstormforce/ultimate-addons-for-beaver-builder-lite)
- [Upgrade to Pro](https://www.ultimatebeaver.com/pricing/)
- [Security / Bug Bounty](https://brainstormforce.com/bug-bounty-program/)
