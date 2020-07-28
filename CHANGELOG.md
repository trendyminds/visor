# Release Notes for Visor

## 3.0.1 - 2020-07-27

### Fixed
- Remove support for browsers that do not have `fetch` (IE 11)

## 3.0.0 - 2020-07-27

> {warning} Visor 3 is a full rewrite of the plugin to play nicely with full-page static caching solutions like [Blitz](https://plugins.craftcms.com/blitz). Please ensure you are familiar with the [caveats to providing full-page static caching support](https://github.com/trendyminds/visor#caveats)

### Added
- Support for full-page static caching
- Support for Category detection
- Support for Solspace Events detection

### Changed
- When Visor hook is used, a network request is made to fetch the controls. Please ensure you are familiar with the [caveats introduced in 3.0 to provide full-page static caching support](https://github.com/trendyminds/visor#caveats)

## 2.1.1 - 2020-01-02

### Changed
- Update Node packages to address vulnerabilities provided by GitHub

## 2.1.0 - 2019-04-04

### Changed
- Call template hook in `EVENT_REGISTER_SITE_URL_RULES` to prevent potential race condition where Visor did not render
- Use `getIsGuest()` to determine if the user is signed in or not
- Require Craft `3.1.20` or higher

## 2.0.5 - 2019-02-14

### Fixed
- Corrected issue where only admins saw the "Edit entry" option ([#7](https://github.com/trendyminds/visor/issues/7))

## 2.0.4 - 2019-02-01

### Fixed
- Remove source maps from build

## 2.0.3 - 2019-02-01

### Fixed
- Ensure Visor only fires if a user is logged in

## 2.0.2 - 2019-02-01

### Fixed
- Corrected issue where missing $entry would cause the plugin to break

## 2.0.1 - 2019-02-01

### Changed
- Altered styles to better match Craft 2.x variant

## 2.0.0 - 2019-02-01

### Added
- Craft 3 support

## 1.0.1 - 2016-09-16

### Added
- Replace close button with an SVG icon to make customization and positioning easier

### Changed
- Added !important to some typography so your site's CSS doesn't cascade down into Visor and cause visual issues. If you want to use your custom font in Visor you still may override styles using the 'craft-visor--override' class

## 1.0.0 - 2016-09-15

Initial release.
