# Adapt Microsite

WordPress theme for the Adapt microsite. Built with a Node/Gulp pipeline: SCSS
compiles to `assets/css/main.min.css`, JS (plus a handful of bundled vendor
plugins) compiles to `assets/js/main.min.js`, and icon fonts/favicons are
generated from source SVGs.

## Quick start

Requires Node 22+ and npm.

```bash
npm install
npx gulp _build
```

That's it — `_build` runs every build step (fonts, icons, images, scripts,
styles, PHP reload trigger) and writes the results into `assets/`. Open the
theme in WordPress as normal; nothing else needs building to view the site.

For local development with live-reload:

```bash
npx gulp __start
```

This starts `browser-sync` proxying your local WordPress install (configure
the URL in `source/gulp/config.js`) and watches `source/**` for changes.

## Project structure

```
assets/              built output (css/js/fonts/images) - do not hand-edit
source/
  scss/              Sass source, compiled to assets/css/main.min.css
  js/                JS source, compiled to assets/js/main.min.js
  icons/             SVGs compiled into an icon font (assets/fonts/icons.*)
  fonts/              pre-compiled font files, copied as-is to assets/fonts/
  images/            raw images, optimized into assets/images/
  gulp/              all Gulp task definitions (see below)
templates/           WordPress template parts
includes/            theme PHP includes (hooks, setup, ACF, etc.)
header.php / footer.php / functions.php / style.css / index.php
```

## Build tasks

All tasks are defined under `source/gulp/tasks/` and registered from
`gulpfile.js`. Run any of them individually or use the composite tasks:

| Task | What it does |
|---|---|
| `npx gulp _build` | Runs every build step below, in parallel |
| `npx gulp build:styles` | Compiles Sass, autoprefixes, minifies → `main.min.css` |
| `npx gulp build:scripts` | Bundles jQuery + vendor plugins + `source/js/main.js` → `main.min.js` |
| `npx gulp build:icons` | Generates the icon font from `source/icons/*.svg` |
| `npx gulp build:fonts` | Copies pre-compiled fonts from `source/fonts/` |
| `npx gulp build:images` | Optimizes images (see **Known limitation** below) |
| `npx gulp build:favicons` | Regenerates favicons from `source/images/favicon.png` |
| `npx gulp watch` | Rebuilds on file change (used by `__start`) |
| `npx gulp deploy:zip` | Zips the theme (minus `node_modules`/`.git`) for manual upload |
| `npx gulp deploy:git` | Commits and pushes the current tree to the `dev` branch directly |
| `npx gulp deploy:ftp` | FTP deploy — **not configured**, needs `path.deploy.ftp` credentials added to `source/gulp/paths.js` first |

### Known limitation: `build:images`

`build:images` uses `gulp-image`, which wraps several native binary
optimizers (gifsicle, pngquant, mozjpeg, advpng, zopflipng). These try to
download a prebuilt binary and fall back to compiling from source if that
fails — which needs system libraries (e.g. `libimagequant-dev`) that most
CI runners and some sandboxes don't have. If it fails locally, either
install those system dependencies or just skip the step — `assets/images/`
is already committed and pre-optimized, so it's safe to leave as-is until
you actually add new images.

CI never runs this step at all (see below).

## Dependencies

All vendor libraries (jQuery, select2, magnific-popup, slick-carousel,
perfect-scrollbar, etc.) are regular npm `dependencies` in `package.json` —
this theme does **not** use Bower. `source/gulp/paths.js` lists exactly which
files from `node_modules` get bundled into `main.min.js` / `main.min.css`.

One deliberate pin: `fullpage.js` is locked to `2.9.7` (not `^`) — versions
3+ require a commercial license, so don't bump this without checking that
first.

## Git workflow

- **`dev`** — active development branch. Push here for day-to-day work.
- **`main`** — stable/production branch.

```bash
git checkout dev
git add .
git commit -m "..."
git push origin dev
```

Promote `dev` to `main` the normal way (PR/merge on GitHub, or locally via
`git checkout main && git merge dev`).

## CI/CD: auto-deploy to staging

`.github/workflows/deploy-staging.yml` runs on every push to `dev`:

1. Checks out the repo
2. `npm install --ignore-scripts` (skips native binary builds — see above)
3. `npx gulp _build:ci` (same as `_build`, minus `build:images`, for the same reason)
4. Strips `node_modules`, `.git`, `.github` from the tree
5. Uploads everything else to the staging server over real SFTP (not
   rsync-over-SSH — the staging account is SFTP-only with shell access
   disabled, so the deploy step must speak the SFTP protocol directly)

### Required GitHub configuration

Set these under **Settings → Environments → `staging`** in this repo (the
workflow's `environment: staging` key must match whatever this environment
is actually named):

**Variables:**
- `STAGING_HOST`
- `STAGING_PORT`
- `STAGING_REMOTE_PATH`

**Secrets:**
- `STAGING_USERNAME`
- `STAGING_PASS`

No other setup needed — push to `dev` and the workflow does the rest.
Check the **Actions** tab on GitHub to watch a deploy or debug a failure.

## Deploying manually

If you'd rather not wait for CI:

```bash
npx gulp _build          # full build, including images
npx gulp deploy:zip      # produces a zip you can upload by hand
```

or push straight to the repo used for git-based deploys:

```bash
npx gulp deploy:git
```
