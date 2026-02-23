# Deployment Guide

## Overview

UABB Lite is distributed through the [WordPress.org Plugin Directory](https://wordpress.org/plugins/ultimate-addons-for-beaver-builder-lite/). Deployment is fully automated via GitHub Actions using SVN to push to the WordPress.org repository.

---

## GitHub Actions Workflows

### 1. Deploy to WordPress.org (on tag)

**File:** `.github/workflows/push-to-deploy.yml`
**Trigger:** Any Git tag pushed to the repository

```yaml
on:
  push:
    tags:
      - "*"
```

**Action used:** `10up/action-wordpress-plugin-deploy@master`

**What it does:**
1. Checks out the tagged commit
2. Uses `SVN_USERNAME` and `SVN_PASSWORD` secrets to authenticate with `plugins.svn.wordpress.org`
3. Copies the plugin files to the SVN trunk and the tag directory
4. Commits to SVN — WordPress.org picks up the new version automatically

**Required repository secrets:**
- `SVN_USERNAME` — WordPress.org SVN username
- `SVN_PASSWORD` — WordPress.org SVN password (or application password)

### 2. Plugin Asset / Readme Update (on push to master)

**File:** `.github/workflows/push-asset-readme-update.yml`
**Trigger:** Push to the `master` branch

```yaml
on:
  push:
    branches:
      - master
```

**Action used:** `10up/action-wordpress-plugin-asset-update@stable`

**What it does:**
- Syncs the plugin's WordPress.org assets (banner, icon, screenshots) from `assets/screenshots/` and the `assets/` directory
- Syncs `readme.txt` to the WordPress.org SVN `assets/` and trunk

This means every push to `master` keeps the plugin page on WordPress.org up to date without a full release.

---

## Release Process

### Step 1: Prepare the release

1. Update `BB_ULTIMATE_ADDON_LITE_VERSION` constant in `bb-ultimate-addon.php`
2. Update `"version"` in `package.json`
3. Update `Stable tag` in `readme.txt`
4. Add a changelog entry in `readme.txt` under `== Changelog ==`
5. Run `grunt wp_readme_to_markdown` to sync `README.md` from `readme.txt`
6. Commit all changes to `next-release`

### Step 2: Merge to master

```bash
git checkout master
git merge next-release
git push origin master
```

The push to `master` triggers the **asset/readme update** workflow.

### Step 3: Tag the release

```bash
git tag 1.6.7
git push origin 1.6.7
```

The tag push triggers the **deploy to WordPress.org** workflow. WordPress.org processes the SVN commit and the new version becomes available to users within minutes.

---

## Build Artifact (Manual)

To build a distributable `.zip` locally (e.g. for testing on a staging site):

```bash
grunt copy     # Copies distributable files to ultimate-addons-for-beaver-builder-lite/
grunt compress # Creates ultimate-addons-for-beaver-builder-lite.zip
```

**Files excluded from the build (defined in `Gruntfile.js`):**
- `node_modules/`
- `build/`
- `.git/`
- `tests/`
- `vendor/`
- `composer.json`, `composer.lock`, `package.json`, `package-lock.json`
- `Gruntfile.js`, `phpcs.xml.dist`, `phpstan.neon`, `phpstan-baseline.neon`
- `stubs-generator.php`
- `sass/`, `*.map`, `*.sh`
- `README.md` (the `.org` readme.txt is kept)

---

## AI Code Reviewer (Pre-merge)

**File:** `.github/workflows/ai-code-reviewer.yml`
**Trigger:** Pull requests

An automated code review runs on every PR. Review comments are posted inline. Resolve or acknowledge all findings before merging.

---

## Dependabot

**File:** `.github/dependabot.yml`

Dependabot monitors PHP (Composer) dependencies and opens automated PRs when updates are available. Review and merge these PRs to keep security-sensitive dev tooling current.

---

## WordPress.org SVN Structure

```
plugins.svn.wordpress.org/ultimate-addons-for-beaver-builder-lite/
├── trunk/          # Latest stable code (mirrors tagged release)
├── tags/
│   ├── 1.6.7/      # One directory per release tag
│   ├── 1.6.6/
│   └── ...
└── assets/         # Banner (772×250), icon (256×256), screenshots
```

---

## See Also

- [Contributing-Guide](Contributing-Guide)
- [Testing-Guide](Testing-Guide)
- [Environment-Configuration](Environment-Configuration)
