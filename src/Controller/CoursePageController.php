<?php

namespace Drupal\recently_viewed_courses\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Cache\Cache;

class CoursePageController extends ControllerBase
{

  public function render()
  {
    return [
      '#theme' => 'course_page',
      '#popular_courses' => [
        '#markup' => '<ul><li>Business Management</li><li>Computer Science</li><li>Psychology</li></ul>',
        '#cache' => ['max-age' => Cache::PERMANENT],
      ],
      '#recently_viewed' => [
        '#lazy_builder' => ['recently_viewed_courses.recently_viewed_lazy_builder:render', []],
        '#create_placeholder' => TRUE,
      ],
      '#attached' => [
        'library' => [
          'recently_viewed_courses/style',
        ],
      ],
    ];
  }

  //Optionally inject CourseTracker via constructor for testing
  public function trackCourse($name)
  {
    $tracker = \Drupal::service('recently_viewed_courses.tracker');
    $tracker->add(ucwords($name));
    return $this->redirect('recently_viewed_courses.page');
  }
}
