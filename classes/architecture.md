---
module: core
owner: brainstormforce
---

# core

## Responsibility

Owns the plugin's engine room in `classes/`: bootstrap orchestration (loading every class file, registering the module list, wiring init hooks), the static options cache, admin settings + analytics/cron, cloud templates, global styling, WPML registration, icon-font provisioning, and BB-version backward/compat shims. It *loads* but does not implement the modules (`modules/{slug}/`), field types (`fields/`), or vendored libraries (`lib/`, `admin/bsf-analytics/`).

## Why it is this way

- All DB options are loaded once into `UABB_Init::$uabb_options` at bootstrap so hot paths never hit `get_option()`. This is why writes must explicitly refresh the static cache — the cache, not the DB, is the read source for the rest of the request.
- The plugin aborts gracefully when Beaver Builder is absent, so nearly every BB integration point is wrapped in a `class_exists`/`is_callable` guard rather than assumed present.

## Related ADRs

None yet.
