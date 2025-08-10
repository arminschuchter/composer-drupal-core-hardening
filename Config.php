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
      'modules/announcements_feed/tests',
      'modules/automated_cron/tests',
      'modules/ban/tests',
      'modules/basic_auth/tests',
      'modules/big_pipe/tests',
      'modules/block/tests',
      'modules/block_content/tests',
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
      'modules/navigation/tests',
      'modules/node/tests',
      'modules/options/tests',
      'modules/package_manager/tests',
      'modules/page_cache/tests',
      'modules/path/tests',
      'modules/path_alias/tests',
      'modules/pgsql/tests',
      'modules/phpass/tests',
      'modules/responsive_image/tests',
      'modules/rest/tests',
      'modules/search/tests',
      'modules/serialization/tests',
      'modules/settings_tray/tests',
      'modules/shortcut/tests',
      'modules/sqlite/tests',
      'modules/syslog/tests',
      'modules/system/src/Tests',
      'modules/system/tests',
      'modules/taxonomy/tests',
      'modules/telephone/tests',
      'modules/text/tests',
      'modules/toolbar/tests',
      'modules/update/tests',
      'modules/user/tests',
      'modules/views/src/Tests',
      'modules/views/tests',
      'modules/views_ui/tests',
      'modules/workflows/tests',
      'modules/workspaces/tests',
      'modules/workspaces_ui/tests',
      'profiles/demo_umami',
      'profiles/minimal/tests',
      'profiles/standard/tests',
      'profiles/tests',
      'recipes/administrator_role/tests',
      'recipes/article_comment/tests',
      'recipes/article_content_type/tests',
      'recipes/article_tags/tests',
      'recipes/audio_media_type/tests',
      'recipes/basic_block_type/tests',
      'recipes/basic_html_format_editor/tests',
      'recipes/basic_shortcuts/tests',
      'recipes/comment_base/tests',
      'recipes/content_editor_role/tests',
      'recipes/content_search/tests',
      'recipes/core_recommended_admin_theme/tests',
      'recipes/core_recommended_front_end_theme/tests',
      'recipes/core_recommended_maintenance/tests',
      'recipes/core_recommended_performance/tests',
      'recipes/document_media_type/tests',
      'recipes/editorial_workflow/tests',
      'recipes/feedback_contact_form/tests',
      'recipes/full_html_format_editor/tests',
      'recipes/image_media_type/tests',
      'recipes/local_video_media_type/tests',
      'recipes/page_content_type/tests',
      'recipes/remote_video_media_type/tests',
      'recipes/restricted_html_format/tests',
      'recipes/standard/tests',
      'recipes/standard_responsive_images/tests',
      'recipes/tags_taxonomy/tests',
      'recipes/user_picture/tests',
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
