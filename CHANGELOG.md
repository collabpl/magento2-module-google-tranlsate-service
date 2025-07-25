# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
### Changed

## 2.0.0 - 2025-07-26
### Added
- Google Translate API v3 compatibility
- Service account authentication support
- Project ID and location configuration
- Language detection functionality
- Get supported languages functionality
- Proper error logging and handling

### Changed
- **BREAKING**: Migrated from API key authentication to service account authentication
- **BREAKING**: Updated from Google Translate API v2 to v3
- **BREAKING**: Removed deprecated `getGoogleTranslateApiKey()` and `getReferer()` methods
- Updated `translate()` method to accept optional source language parameter
- Improved error handling with detailed logging

### Removed
- **BREAKING**: Removed API key configuration (replaced with service account)
- **BREAKING**: Removed referer configuration (no longer needed in v3)

## 1.0.0 - 2024-07-13
### Added
- 1.0.0 Initial release

[unreleased]: https://github.com/collabpl/magento2-module-google-one-tap/compare/2.0.0...HEAD
[2.0.0]: https://github.com/collabpl/magento2-module-google-tranlsate-service/compare/1.0.0...2.0.0
[1.0.0]: https://github.com/collabpl/magento2-module-google-tranlsate-service/releases/tag/1.0.0
