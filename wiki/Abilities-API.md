# Abilities API Integration

**Since:** 1.6.8 · **Requires:** WordPress 6.9+ with AI Experiments plugin (or any Abilities API provider)

UABB Lite registers 10 WordPress Abilities that make the plugin discoverable and controllable by AI assistants (Claude Desktop, Cursor, etc.) via the MCP protocol.

---

## Prerequisites

1. WordPress 6.9+ (ships with the Abilities API in core)
2. [AI Experiments plugin](https://github.com/WordPress/ai) activated (provides MCP Adapter)
3. User with `manage_options` capability

All abilities are guarded by `function_exists('wp_register_ability')` — they silently skip on older WordPress versions.

---

## Registered Abilities (10)

### Read-Only (6)

| Ability ID | Label | Description |
|---|---|---|
| `uabb/get-plugin-info` | Get UABB Plugin Info | Version, BB status, module counts, settings summary |
| `uabb/list-modules` | List UABB Modules | All 13 modules with enabled/disabled status |
| `uabb/get-module-details` | Get Module Details | Settings schema, description, category for a module |
| `uabb/get-global-settings` | Get Global Styling | Theme colors, button defaults, enabled state |
| `uabb/get-general-settings` | Get General Settings | UI panel, live preview, template cloud status |
| `uabb/list-cloud-templates` | List Cloud Templates | Page templates, sections, presets with counts |

### Write (4)

| Ability ID | Label | Description |
|---|---|---|
| `uabb/update-module-status` | Enable/Disable Modules | Toggle modules on/off (always-on modules are skipped) |
| `uabb/update-global-settings` | Update Global Styling | Change theme colors, button styles |
| `uabb/update-general-settings` | Update General Settings | Toggle UI panel, live preview |
| `uabb/refresh-cloud-templates` | Refresh Cloud Templates | Fetch latest from templates.ultimatebeaver.com |

---

## Input / Output Schemas

### `uabb/get-plugin-info`

**Input:** None

**Output:**
```json
{
  "version": "1.6.7",
  "is_lite": true,
  "beaver_builder": { "active": true, "version": "2.8.4" },
  "modules": { "total": 13, "enabled": 11, "disabled": 2 },
  "settings": {
    "global_styling_enabled": true,
    "ui_panel_enabled": true,
    "live_preview_enabled": true,
    "template_cloud_enabled": true
  }
}
```

### `uabb/list-modules`

**Input:**
```json
{ "status": "all" }
```
`status` is optional — one of `all`, `enabled`, `disabled`. Defaults to `all`.

**Output:**
```json
{
  "modules": [
    { "slug": "uabb-button", "label": "Button", "enabled": true, "always_on": true },
    { "slug": "flip-box", "label": "Flip Box", "enabled": false, "always_on": false }
  ],
  "total": 13
}
```

### `uabb/get-module-details`

**Input:**
```json
{ "slug": "uabb-button" }
```

**Output:**
```json
{
  "slug": "uabb-button",
  "label": "Button",
  "description": "A simple call-to-action button.",
  "category": "UABB Modules",
  "enabled": true,
  "always_on": true,
  "settings": [
    {
      "tab": "general",
      "title": "General",
      "sections": [
        { "section": "general", "title": "General", "fields": ["text", "link", "link_target"] }
      ]
    }
  ]
}
```

### `uabb/get-global-settings`

**Input:** None

**Output:**
```json
{
  "enabled": true,
  "theme_color": "f7b91a",
  "theme_text_color": "808285",
  "button": {
    "bg_color": "f7b91a",
    "bg_hover_color": "000000",
    "text_color": "ffffff",
    "text_hover_color": "ffffff",
    "border_radius": "5",
    "font_size": "",
    "line_height": "",
    "letter_spacing": "",
    "text_transform": "none",
    "vertical_padding": "",
    "horizontal_padding": ""
  }
}
```

### `uabb/update-global-settings`

**Input:** Any subset of global settings keys:
```json
{
  "theme_color": "3366ff",
  "btn_bg_color": "3366ff",
  "btn_text_color": "ffffff"
}
```
Colors are 3 or 6 character hex **without** the `#` prefix.

**Output:**
```json
{ "success": true, "updated": ["theme_color", "btn_bg_color", "btn_text_color"] }
```

### `uabb/get-general-settings`

**Input:** None

**Output:**
```json
{
  "ui_panel_enabled": true,
  "live_preview_enabled": true,
  "template_cloud_enabled": true,
  "colorpicker_enabled": true,
  "row_separator_enabled": true,
  "google_map_api_key": "****abcd"
}
```

### `uabb/update-general-settings`

**Input:**
```json
{ "ui_panel_enabled": false, "live_preview_enabled": true }
```

**Output:**
```json
{ "success": true, "updated": ["ui_panel_enabled", "live_preview_enabled"] }
```

### `uabb/update-module-status`

**Input:**
```json
{ "modules": { "flip-box": false, "ribbon": true } }
```

**Output:**
```json
{
  "updated": [
    { "slug": "flip-box", "enabled": false },
    { "slug": "ribbon", "enabled": true }
  ],
  "skipped": []
}
```

Always-on modules (`image-icon`, `uabb-separator`, `uabb-button`) cannot be disabled and will appear in `skipped`.

### `uabb/list-cloud-templates`

**Input:**
```json
{ "type": "all" }
```
`type` is optional — one of `all`, `page-templates`, `sections`, `presets`.

**Output:**
```json
{
  "counts": { "total": 50, "page_templates": 10, "sections": 30, "presets": 10 },
  "templates": {
    "page-templates": [{ "id": "1", "name": "Agency", "image": "https://..." }],
    "sections": [{ "id": "1", "name": "Headers", "count": 5 }],
    "presets": [{ "id": "1", "name": "Button Preset" }]
  }
}
```

### `uabb/refresh-cloud-templates`

**Input:** None

**Output:**
```json
{
  "success": true,
  "counts": { "total": 52, "page_templates": 12, "sections": 30, "presets": 10 }
}
```

---

## Permission Requirements

All 10 abilities require the `manage_options` capability (WordPress administrator role).

---

## MCP Usage

All abilities are registered with `mcp.public = true` and `mcp.type = tool`, making them available via the WP MCP Adapter.

### Testing via WP-CLI

List all available tools:
```bash
echo '{"jsonrpc":"2.0","id":1,"method":"tools/list","params":{}}' | \
  wp mcp-adapter serve --user=admin --server=mcp-adapter-default-server
```

Call a tool:
```bash
echo '{"jsonrpc":"2.0","id":1,"method":"tools/call","params":{"name":"uabb-list-modules","arguments":{"status":"all"}}}' | \
  wp mcp-adapter serve --user=admin --server=mcp-adapter-default-server
```

### Testing via Abilities Explorer

1. Go to **Tools > Abilities Explorer** in WP Admin
2. Find abilities under the "Ultimate Addons for Beaver Builder" category
3. Click "Test" on any ability to invoke it

---

## Error Codes

| Code | Meaning |
|---|---|
| `uabb_bb_not_active` | Beaver Builder is not active (abilities won't register) |
| `uabb_invalid_module` | Provided module slug doesn't exist |
| `uabb_invalid_color` | Hex color value is not valid (3 or 6 chars, no `#`) |
| `uabb_invalid_input` | Input parameter is malformed |
| `uabb_no_settings` | No valid settings keys were provided to update |

---

## File Structure

```
abilities/
  class-uabb-abilities.php          # Bootstrap: hooks, loads sub-files
  class-uabb-plugin-abilities.php   # uabb/get-plugin-info
  class-uabb-module-abilities.php   # uabb/list-modules, get-module-details, update-module-status
  class-uabb-settings-abilities.php # get/update-global-settings, get/update-general-settings
  class-uabb-template-abilities.php # list/refresh-cloud-templates
```

## Extending

To add a new ability:

1. Create a new class in `abilities/` or add a method to an existing class
2. Follow the `wp_register_ability()` pattern with `input_schema`, `output_schema`, `execute_callback`, and `permission_callback`
3. Use `UABB_Abilities::CATEGORY` as the category
4. Include `mcp` meta with `public: true` and `type: tool` for MCP exposure
5. Require the file and call `::register()` from `UABB_Abilities::register_abilities()`
