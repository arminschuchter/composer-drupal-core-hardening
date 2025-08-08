<?php

namespace MarchMol\Composer\Plugin\DrupalCoreHardening;

use Composer\Package\RootPackageInterface;

/**
 * Determine configuration.
 *
 * Default hardcoded configuration.
 *
 * @internal
 */
class Config {

  /**
   * The default configuration.
   *
   * @var array
   */
  protected static $defaultConfig = [
    'drupal/core' => [
      'modules/action/tests',
      'modules/announcements_feed/tests',
      'modules/automated_cron/tests',
      'modules/ban/tests',
      'modules/basic_auth/tests',
      'modules/big_pipe/tests',
      'modules/block/tests',
      'modules/block_content/tests',
      'modules/book/tests',
      'modules/breakpoint/tests',
      'modules/ckeditor5/tests',
      'modules/comment/src/Tests',
      'modules/comment/tests',
      'modules/config/tests',
      'modules/config_translation/tests',
      'modules/contact/tests',
      'modules/content_moderation/tests',
      'modules/content_translation/tests',
      'modules/contextual/tests',
      'modules/datetime/tests',
      'modules/datetime_range/tests',
      'modules/dblog/tests',
      'modules/dynamic_page_cache/tests',
      'modules/editor/tests',
      'modules/field/tests',
      'modules/field_layout/tests',
      'modules/field_ui/tests',
      'modules/file/tests',
      'modules/filter/tests',
      'modules/forum/tests',
      'modules/help/tests',
      'modules/history/tests',
      'modules/image/tests',
      'modules/inline_form_errors/tests',
      'modules/jsonapi/tests',
      'modules/language/tests',
      'modules/layout_builder/modules/layout_builder_expose_all_field_blocks/tests',
      'modules/layout_builder/tests',
      'modules/layout_discovery/tests',
      'modules/link/tests',
      'modules/locale/tests',
      'modules/media/tests',
      'modules/media_library/tests',
      'modules/menu_link_content/tests',
      'modules/menu_ui/tests',
      'modules/migrate/tests',
      'modules/migrate_drupal/src/Tests',
      'modules/migrate_drupal/tests',
      'modules/migrate_drupal_ui/tests',
      'modules/mysql/tests',
      'modules/navigation/modules/navigation_top_bar/tests',
      'modules/navigation/tests',
      'modules/node/tests',
      'modules/options/tests',
      'modules/page_cache/tests',
      'modules/path/tests',
      'modules/path_alias/tests',
      'modules/pgsql/tests',
      'modules/phpass/tests',
      'modules/responsive_image/tests',
      'modules/rest/tests',
      'modules/sdc/tests',
      'modules/search/tests',
      'modules/serialization/tests',
      'modules/settings_tray/tests',
      'modules/shortcut/tests',
      'modules/sqlite/tests',
      'modules/statistics/tests',
      'modules/syslog/tests',
      'modules/system/src/Tests',
      'modules/system/tests',
      'modules/taxonomy/tests',
      'modules/telephone/tests',
      'modules/text/tests',
      'modules/toolbar/tests',
      'modules/tour/tests',
      'modules/tracker/tests',
      'modules/update/tests',
      'modules/user/tests',
      'modules/views/src/Tests',
      'modules/views/tests',
      'modules/views_ui/tests',
      'modules/workflows/tests',
      'modules/workspaces/tests',
      'profiles/demo_umami',
      'profiles/minimal/tests',
      'profiles/nightwatch_a11y_testing',
      'profiles/nightwatch_testing',
      'profiles/standard/tests',
      'profiles/test_language_negotiation',
      'profiles/testing',
      'profiles/testing_config_import',
      'profiles/testing_config_overrides',
      'profiles/testing_install_profile_all_dependencies',
      'profiles/testing_install_profile_dependencies',
      'profiles/testing_missing_dependencies',
      'profiles/testing_multilingual',
      'profiles/testing_multilingual_with_english',
      'profiles/testing_requirements',
      'profiles/testing_site_config',
      'profiles/testing_themes_blocks',
      'tests',
      'themes/claro/tests',
      'themes/olivero/tests',
    ],
  ];

  /**
   * The root package.
   *
   * @var \Composer\Package\RootPackageInterface
   */
  protected $rootPackage;

  /**
   * Configuration gleaned from the root package.
   *
   * @var array
   */
  protected $configData = [];

  /**
   * Construct a Config object.
   *
   * @param \Composer\Package\RootPackageInterface $root_package
   *   Composer package object for the root package.
   */
  public function __construct(RootPackageInterface $root_package) {
    $this->rootPackage = $root_package;
  }

  /**
   * Gets the configured list of directories to remove from the root package.
   *
   * @return array[]
   *   An array keyed by package name. Each array value is an array of paths,
   *   relative to the package.
   */
  public function getAllCleanupPaths() {
    if ($this->configData) {
      return $this->configData;
    }

    // Merge root config with defaults.
    foreach (array_change_key_case(static::$defaultConfig, CASE_LOWER) as $package => $paths) {
      $this->configData[$package] = array_merge(
        $this->configData[$package] ?? [],
        $paths);
    }
    return $this->configData;
  }

  /**
   * Get a list of paths to remove for the given package.
   *
   * @param string $package
   *   The package name.
   *
   * @return string[]
   *   Array of paths to remove, relative to the package.
   */
  public function getPathsForPackage($package) {
    $package = strtolower($package);
    $paths = $this->getAllCleanupPaths();
    return $paths[$package] ?? [];
  }

}
