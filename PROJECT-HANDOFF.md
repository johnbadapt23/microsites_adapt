# Adapt Microsite — Work Log & Handoff

Project: `microsites_adapt` (WordPress theme, "Adapt Microsite")
Repo: `https://github.com/johnbadapt23/microsites_adapt.git`
Branches: `dev` (active development) → `main` (stable). All work below is committed to both, fast-forward, on the local machine — **it has not been pushed to GitHub yet**. See "What's left to do" at the bottom.

This document exists so work can continue from a different account/session without re-deriving context. Everything below actually happened and was verified (real builds, real diffs, real fresh-install tests) — this isn't a plan, it's a record.

---

## 1. Build tooling modernization

The theme's build system was badly out of date (Gulp 3, Bower, unpinned CDN scripts). Brought current:

- **package.json**: rewritten. All vendor libraries (jQuery, select2, magnific-popup, slick-carousel, perfect-scrollbar, AOS, etc.) moved to npm `dependencies` — Bower is gone entirely. `devDependencies` updated to current Gulp 5 plugin versions. Two deliberate exceptions:
  - `gulp-iconfont` pinned to `^11.0.1`, not latest — v12 rewrote its API from a pipeable stream to a source-generating function; v11 is the last version compatible with this pipeline.
  - `fullpage.js` pinned to exactly `2.9.7` (no `^`) — versions 3+ require a commercial license.
- **ESM conversion**: all of `source/gulp/**` and `gulpfile.js` converted from CommonJS to ES modules (`"type": "module"` in package.json).
- **Gulp 3 → 5**: old array-of-task-names dependency syntax replaced with explicit `gulp.series()` / `gulp.parallel()` (removed in Gulp 4/5).
- **`source/gulp/error.js`**: this was silently swallowing real build errors (`this.emit('end')` on error, meaning a broken SCSS/JS file could produce missing/incomplete output while Gulp and CI both reported success). Fixed by switching every build task to use `pump()` instead of chained `.pipe()` (Node streams don't auto-propagate errors downstream through `.pipe()` chains), with a `done(err)` callback that actually fails the task. Verified by deliberately breaking a `.scss` file and confirming the build now exits non-zero.
- **perfect-scrollbar**: rewritten from the old jQuery-plugin v0.x API to the vanilla-JS v1.x class API in `source/js/main.js`.
- **Autoprefixer ordering bug** (pre-existing): was running *before* Sass compilation; reordered to run after `sass()`.
- **jQuery**: now self-hosted via npm (`node_modules/jquery/dist/jquery.min.js`) instead of an unpinned CDN link in `header.php`. Bundled first in `paths.js` so it's available as a global before every plugin that depends on `$`.
- **CI-only build variant**: `gulp-image` (image optimizer) wraps native binaries (gifsicle, pngquant, mozjpeg) that fail to compile on hosted CI runners and in sandboxed environments (missing system libs like `libimagequant.h`). Added `_build:ci` task in `gulpfile.js` that runs everything except `build:images`; CI uses `npm install --ignore-scripts` + `_build:ci`. `assets/images/` is already committed and pre-optimized, so this only matters when someone actually adds new images (run `gulp build:images` locally for that).
- **Non-deterministic icon font builds (found and fixed)**: `source/gulp/tasks/build/icons.js` was stamping every generated icon font (`icons.eot/ttf/woff/woff2`) with `Math.round(Date.now() / 1000)`, embedded into the font's metadata. This meant rebuilding from byte-identical source SVGs produced different binary output every single time — which would have made the new CI "does the build match what's committed" gate (see §3) permanently fail even with zero real changes. Fixed by pinning to a fixed epoch constant. Verified deterministic across fresh installs and multiple consecutive rebuilds before committing the fix.

## 2. Git workflow

- Initialized git, created `dev` and `main` branches, connected to `https://github.com/johnbadapt23/microsites_adapt.git`.
- Workflow convention: commit and merge to `dev` first, fast-forward-merge `dev` → `main` once verified. This session has no push credentials in its sandbox — **every push (`git push origin dev` / `git push origin main`) has to be run by a human**, which is why nothing has reached GitHub yet despite 25 commits existing locally.

## 3. CI/CD deploy pipeline

Went through several iterations, each fixing a real production failure:

1. **Original attempt** (`wlixcc/SFTP-Deploy-Action`) failed in production with `Shell access is disabled!` — that action shells out to `rsync` over SSH, which needs remote command execution. The staging host is SFTP-only (shell disabled, which is normal for shared hosting).
2. **Switched to `wangyucode/sftp-upload-action@v3`** — speaks the SFTP protocol directly (file operations only, no shell needed). Worked, but uploaded the entire theme tree on every single push.
3. **Excluded non-WordPress files from deploy**: `source/`, `node_modules`, `gulpfile.js`, `package*.json`, `.git*`, `README.md`, `faviconData.json` — WordPress only ever loads `assets/`, `templates/`, `includes/`, and the theme root PHP/CSS files.
4. **Final iteration — migrated to `milanmk/actions-file-deployer` in delta-sync mode** (per your instruction, matching what's used on "ADAPT - Mainsite"): instead of uploading the whole theme every push, it diffs the previous and current commit via `git diff` and uploads only what actually changed.
   - `sync-delta-excludes` / `ftp-mirror-options` replace the old file-exclusion approach, enforced via git pathspec / lftp exclude-glob instead of pre-deploy `rm -rf`.
   - **Fixed a real YAML/bash bug you reported**: `sync-delta-excludes` must be a *folded* scalar (`>-`), never a *literal* block (`|`). The action inlines that value as literal text into a single-line `git diff ...` command inside its own composite script, before bash ever parses it — a literal block's real newlines land mid-command and silently split it into broken commands. Folded scalars collapse line breaks into spaces first, keeping it one valid line. Verified this exact substitution behavior against a real git repo in a scratch directory before committing.
   - Added a `workflow_dispatch` input so a one-time **full** sync can be triggered manually from the Actions tab (recommended the first time this runs against a server) — every push after that stays on the fast delta path.
   - **New safety gate**: "Verify built assets match what's committed" — rebuilds in CI and fails the job loudly if `assets/` doesn't match a fresh build, instead of delta-sync silently skipping a file because git saw no diff for something that just wasn't rebuilt. This is what caught the icon-font non-determinism bug above, and also caught that `assets/` had drifted from `source/` (see §6).

`.github/workflows/deploy-staging.yml` is the file; full mechanics documented in `README.md`.

**Required GitHub configuration** (Settings → Environments → `staging`):
- Variables: `STAGING_HOST`, `STAGING_PORT`, `STAGING_REMOTE_PATH`
- Secrets: `STAGING_USERNAME`, `STAGING_PASS`

## 4. SEO & performance

All four items from an earlier "full SEO + performance fix" request:

- **Meta/head fundamentals**: restored `rel_canonical` (was actively disabled in `includes/_hooks.php`), added `includes/_seo.php` — meta description, Open Graph + Twitter Card tags, base Organization + WebSite JSON-LD, `add_theme_support('title-tag')` (replacing a manual `wp_title()` call that risked duplicate `<title>` tags).
- **Font-display + script loading perf**: all `@font-face` declarations in `source/scss/global/_fonts.scss` now use `font-display: swap`. Added `defer` to render-blocking scripts in `header.php`/`footer.php` (lottie-player, modernizr, main.min.js). Added `<link rel="preconnect">` for Google Fonts, unpkg, HubSpot, GTM.
- **Image alt text + lazy loading**: fixed real accessibility bugs — missing/duplicate `alt` attributes, a duplicate-class bug on the header logo `<img>`, malformed markup on the calendar icon, missing `aria-label` on icon-only LinkedIn links. Rolled out `loading="lazy"` to ~125 `<img>` tags across 50 template files.
  - **Notable incident, fully recovered**: a first attempt at the lazy-loading rollout used a naive regex (`<img\b[^>]*?>`) that corrupted 51 PHP template files, because the non-greedy match stopped at the first `>` it saw — which inside a PHP-templated attribute (`src="<?php echo $x['url']; ?>"`) is often the `?>` closing a PHP tag, not the tag's real end. Caught immediately, reverted via `git checkout -- templates/`, then redone correctly with a regex that treats `<?php ... ?>` blocks as atomic units. Verified line-by-line against the diff before committing.
- **Heading structure (H1) audit** across all 76 templates: found `template-landing.php` and `template-landing-new.php` — the two most-used page templates — had **no H1 anywhere on the page**. Promoted the hero heading in `_intro-video-block.php` / `_intro-form-block.php` from H2 to H1, and extended the shared SCSS typography rule to cover `h1` alongside `h2` so there's no visual regression (verified in a real compiled CSS build before committing).

## 5. WP Rocket compatibility

Since the site runs WP Rocket, documented (in `README.md`) and partially fixed in code the places the theme's own optimizations and Rocket's could conflict:

- Marked the 4 hero/background images (`class="desktop"`) with `skip-lazy` so Rocket's own LazyLoad module (if enabled) doesn't fight the theme's native `loading="lazy"` handling on LCP-candidate images.
- Documented (can't configure this remotely — no WP admin access): Rocket's **Delay JavaScript Execution** must exclude `main.min.js` and jQuery/jQuery Migrate (or use Rocket's Safe Mode) — otherwise sliders, AOS animations, and the mobile menu won't run until first user interaction. Also documented excluding already-minified theme assets from Rocket's own minify/combine, and a CSS safelist for AOS/Slick's JS-added classes so Rocket's "Remove Unused CSS" doesn't strip them.

## 6. Network microsites footer directory

You asked whether it's possible to list all "microsites" in the footer. Turned out (confirmed by the "My Sites / Network Admin" toolbar screenshot you shared) this is a **WordPress Multisite network** — every microsite (CIO Edge, Security Edge, People Edge, Data & AI Edge, Cloud & Infrastructure Edge, CFO Edge, Digital Edge, CIO Edge Melbourne, Security Edge Melbourne, Government Edge, Government Edge Conference, Adapt Events) is a separate site in the same network, not an independent install. WordPress already knows the full list via its own `get_sites()` API — nothing in the theme had ever used it.

Built `includes/_microsites.php`:
- `adapt_get_network_microsites()` — pulls every public/live site in the network, reads each one's actual Site Title (`switch_to_blog()` + `get_option('blogname')` — explicitly, not `get_blog_details()`'s cache, per your instruction that it must come from Site Title), sorts alphabetically.
- Rendered in `templates/partials/_footer.php` as a new "Our Microsites" row; styled in `source/scss/partials/_footer.scss` to match the existing footer link treatment. Current site shows as plain text instead of linking to itself.
- **Excludes the network's main site** (`is_main_site()`) — the Network Admin site shouldn't be reachable from a public footer link, per your request.

**Two real bugs found and fixed during this work, both worth knowing about if you extend this feature:**

1. **Cross-site cache propagation bug**: the site list was originally cached *per site* (`get_transient`). Renaming a site's title only fires WordPress's invalidation hooks in *that site's own* request context — every *other* site kept serving its own stale cached copy of the renamed site's old name indefinitely, since nothing ever told it to refresh. Fixed by switching to a single network-wide cache (`get_site_transient` / `set_site_transient` / `delete_site_transient`) that every site reads from — one flush, from wherever the change happened, fixes it everywhere. "Is this the current site" is deliberately *not* part of the cached data (it can't be, there's only one shared cache now) — it's computed fresh per request from `get_current_blog_id()`, which is free and always correct.
2. **Deploy-doesn't-invalidate-cache bug**: shipping a code change (like the main-site exclusion) doesn't retroactively clear a transient that's already sitting in the database — only the registered flush hooks do that, and none of them fire just because new code shipped. Fixed by versioning the cache key (`ADAPT_NETWORK_MICROSITES_CACHE_KEY`, currently `adapt_network_microsites_v2`) as one constant used by every get/set/delete call, so a future change to the cached shape/filtering logic just needs the version bumped and every site rebuilds fresh on the very next page load — no manual cache-clearing needed.

Cache auto-flushes on: site created, deleted, archived, unarchived, marked spam/ham, site details updated, or a site's `blogname` option changed.

---

## What's left to do

1. **Push everything.** Nothing has reached GitHub yet — this sandbox has no push credentials. Run:
   ```bash
   git checkout dev && git push origin dev
   git checkout main && git push origin main
   ```
2. **First deploy after pushing**: trigger the workflow manually from the Actions tab with `sync: full` (there's a `workflow_dispatch` input for this) to make sure the server is fully caught up before delta sync takes over on subsequent pushes.
3. **Configure WP Rocket settings** per §5 — this can't be done from code, needs WP admin access: exclude `main.min.js`/jQuery from Delay JS Execution (or enable Safe Mode), exclude theme's pre-minified CSS/JS from Rocket's own minify/combine, add AOS/Slick classes to the Remove Unused CSS safelist.
4. **Verify the microsites footer** renders correctly in production after deploy — specifically that the main site is excluded and titles match each site's actual Site Title, since this could only be built/reasoned about from code, not tested against the live multisite network.
5. Everything else (build tooling, SEO/meta tags, alt text/lazy loading, H1 fixes) is deployed-and-forget — no further action needed beyond the push.

## Full commit history (dev branch, chronological)

```
86debba Initial commit
3a12e4a Modernize build tooling: migrate off Bower/Gulp3, update all dependencies, fix jQuery CDN and script bugs
6f62f08 Merge dev: modernized build tooling and dependencies
12147d7 Fix deploy:git config: point at correct repo/branch, exclude node_modules from deploy glob
808b7c8 Merge branch 'dev'
c631c8c Add GitHub Actions workflow: auto-deploy dev to staging over SFTP
eb4e146 Fix CI: skip build:images and native postinstall scripts (gulp-image binaries can't build on hosted runners)
54e70a8 Fix SFTP deploy: switch to a real SFTP-protocol action, previous one needed rsync-over-SSH shell access
1484adb Add README: build system, dependencies, git workflow, CI/CD deploy
be77ab5 Merge dev: add README
4398276 Deploy only files WordPress actually needs: exclude build tooling (source/, gulpfile.js, package*.json, etc.) from SFTP deploy, zip, and git deploy
e69e8ea Rename theme to 'Adapt Microsite (Optimized)' to differentiate from the original in WP Admin
2ed7044 Merge re-uploaded source/ content update; restore modernized build tooling; wire up AOS; make build failures fail the job instead of silently succeeding
2e61555 SEO/perf: restore canonical URLs, add meta description + OG/Twitter tags + base JSON-LD, title-tag support, font-display swap, script defer/preconnect
f5c3021 Accessibility + perf: fix alt text/aria-labels on icon links, duplicate attribute bug in header logo, malformed calendar-icon markup; add loading=lazy to ~125 below-the-fold images
67d6aa4 SEO: promote landing page hero heading from H2 to H1 (template-landing.php and template-landing-new.php had no H1 anywhere); extend shared heading style rule to cover h1 to avoid visual regression
89176f0 WP Rocket compatibility: mark hero/background images skip-lazy, document required Rocket settings (Delay JS exclusions, minify/combine exclusions, RUCSS safelist)
98b9304 Rebuild assets/ from current source (picks up AOS/H1 CSS changes and the fonts brought in by the earlier source/ re-upload that were never rebuilt); switch staging deploy to milanmk/actions-file-deployer with delta sync
7612648 Fix non-deterministic icon font builds: pin gulp-iconfont's embedded timestamp instead of Date.now()
2945520 Document delta-sync deploy workflow and the reproducible-build requirement
23eacfd Add network microsites directory to the footer
b768dca Read each microsite's name from its own Site Title (blogname option) directly
343e6c9 Fix stale microsite names not propagating across the network after a rename
3b7c62e Exclude the network's main site from the microsites footer list
a8ecde9 Bump microsites cache key so the main-site exclusion takes effect immediately on deploy
```

All commit messages above have full explanatory detail in `git log` — this file summarizes them, but `git show <hash>` on any of these has the complete reasoning if something needs revisiting.
