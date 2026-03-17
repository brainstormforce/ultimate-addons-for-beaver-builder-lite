# Testing Guide

## Overview

UABB Lite uses two categories of automated quality checks:

| Tool | Type | Config File | Command |
|------|------|------------|---------|
| PHPStan | Static analysis | `phpstan.neon` + `phpstan-baseline.neon` | `composer run phpstan` |
| PHPCS | Code style + security linting | `phpcs.xml.dist` | `composer run lint` |

There are no PHPUnit or integration tests in the Lite repository. The `tests/php/stubs/` directory contains PHPStan stubs generated from the plugin's own classes.

---

## PHPStan

### Configuration

File: `phpstan.neon`

```yaml
includes:
    - phpstan-baseline.neon
    - vendor/szepeviktor/phpstan-wordpress/extension.neon

parameters:
    level: 9
    bootstrapFiles:
        - vendor/php-stubs/wordpress-stubs/wordpress-stubs.php
        - tests/php/stubs/lite-stubs.php
    paths:
        - admin
        - assets
        - classes
        - fields
        - includes
        - languages
        - modules
```

**Level 9** is PHPStan's strictest analysis level — it catches undefined variables, incorrect return types, impossible conditions, and more.

### Running PHPStan

```bash
composer run phpstan
# Equivalent: vendor/bin/phpstan --memory-limit=2048M analyse
```

The `--memory-limit=2048M` flag is necessary because the WordPress stubs are large.

### PHPStan Baseline

`phpstan-baseline.neon` suppresses known false positives arising from Beaver Builder's dynamic method calls and WordPress's magic patterns. Errors in the baseline are **not** counted as failures.

When you fix a baseline error in real code, remove it from the baseline by running:

```bash
vendor/bin/phpstan --generate-baseline
```

This regenerates `phpstan-baseline.neon` from scratch.

### Generating Stubs

If you add new public methods to UABB classes that PHPStan needs to resolve cross-file, regenerate the stubs:

```bash
composer run gen-stubs
# Equivalent: generate-stubs artifact/phpstan/ --out=tests/php/stubs/lite-stubs.php
```

The stub generator reads from `artifact/phpstan/` (a temporary build output) then cleans up the artifact directory.

---

## PHPCS (PHP CodeSniffer)

### Configuration

File: `phpcs.xml.dist`

**Rulesets applied:**
- `WordPress-Core` — WordPress coding standards
- `WordPress-Docs` — DocBlock requirements
- `PHPCompatibility` — cross-version PHP compatibility (target: PHP 5.3+)

**Excluded paths:**
- `node_modules/`
- `vendor/`
- `tests/`
- `admin/bsf-analytics/`
- Vendored libs (`lib/nps-survey/`, `lib/astra-notices/`)

### Running the Linter

```bash
composer run lint
# Equivalent: phpcs --standard=phpcs.xml.dist --report-summary --report-source
```

### Auto-fixing

```bash
composer run format
# Equivalent: phpcbf --standard=phpcs.xml.dist --report-summary --report-source
```

`phpcbf` auto-fixes whitespace, alignment, and many style violations. It cannot fix semantic issues.

### Security Rules

The `phpcs.xml.dist` bans a comprehensive set of dangerous PHP functions via the `Generic.PHP.ForbiddenFunctions` sniff. Banned functions include:

- **RCE risk:** `eval`, `assert`, `create_function`, `exec`, `shell_exec`, `system`, `passthru`
- **Command injection:** `popen`, `proc_open`, `pcntl_exec`, `escapeshellcmd`
- **SSRF:** `fsockopen`, `pfsockopen`
- **Information disclosure:** `phpinfo`, `highlight_file`, `show_source`, `posix_*`
- **Variable injection:** `extract`, `parse_str`
- **Socket abuse:** `socket_accept`, `socket_bind`, `socket_connect`, `stream_socket_server`
- **Misc:** `tmpfile`, `symlink`, `dl`, `ini_set`, `putenv`

Any use of these functions will fail CI and the lint check.

---

## CI Pipeline

### Travis CI (legacy)

File: `.travis.yml`

Runs a PHP syntax check across all non-vendor PHP files:

```bash
find . -name "*.php" ! -path "./vendor/*" ! -path "./admin/bsf-core/*" -exec php -l {} \;
```

Tests against PHP 5.3, 5.6, 7.0, and 7.1.

> **Note:** This `.travis.yml` is a legacy configuration. Active CI now runs on GitHub Actions.

### GitHub Actions

| Workflow | File | Trigger |
|---------|------|---------|
| AI Code Reviewer | `.github/workflows/ai-code-reviewer.yml` | Pull requests |
| Deploy to WordPress.org | `.github/workflows/push-to-deploy.yml` | Git tags |
| Asset/readme update | `.github/workflows/push-asset-readme-update.yml` | Push to `master` |

The AI Code Reviewer workflow runs automated code review on pull requests. See [Deployment-Guide](Deployment-Guide) for the deploy workflow details.

---

## Pre-Commit Checklist

Before opening a PR, ensure:

- [ ] `composer run phpstan` passes with 0 errors
- [ ] `composer run lint` passes with 0 errors (or suppressions are justified)
- [ ] All PHP files pass `php -l` syntax check
- [ ] No banned functions introduced (check PHPCS output)
- [ ] Nonces added to any new AJAX handlers
- [ ] `current_user_can()` checks on any capability-gated endpoints
- [ ] Translatable strings use `__()` / `esc_html__()` with domain `'uabb'`

---

## See Also

- [Environment-Configuration](Environment-Configuration)
- [Contributing-Guide](Contributing-Guide)
- [Deployment-Guide](Deployment-Guide)
