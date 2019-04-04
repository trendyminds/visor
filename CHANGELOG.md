# Release Notes for Visor

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
