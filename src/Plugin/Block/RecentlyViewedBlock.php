<?php

namespace Drupal\recently_viewed_courses\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\recently_viewed_courses\Service\CourseTracker;

/**
 * @Block(
 * id = "recently_viewed_block",
 * admin_label = @Translation("Recently Viewed Courses")
 * )
 */
class RecentlyViewedBlock extends BlockBase implements ContainerFactoryPluginInterface
{

  protected $tracker;

  /* Injects the CourseTracker service */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CourseTracker $tracker)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->tracker = $tracker;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
  {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('recently_viewed_courses.tracker')
    );
  }

  public function build()
  {
    $courses = $this->tracker->get();

    $items = empty($courses) ? '<em>No courses viewed yet.</em>' :
      '<ul><li>' . implode('</li><li>', $courses) . '</li></ul>';


    return [
      '#markup' => '<h2>Recently Viewed</h2>' . $items,
      '#cache' => ['max-age' => 0],
    ];
  }

  public function render()
  {
    return $this->build();
  }
}
