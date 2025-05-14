<?php

namespace Drupal\recently_viewed_courses\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class CourseTracker
{

  protected $requestStack;

  /* RequestStack service is injected via dependency injection to get the current request and its session */
  public function __construct(RequestStack $requestStack)
  {
    $this->requestStack = $requestStack;
  }

  public function add($course)
  {
    //Gets the session using RequestStack
    $session = $this->requestStack->getCurrentRequest()->getSession();

    //Retrieves the array of previously viewed courses from the session
    $viewed = $session->get('recently_viewed_courses', []);

    //Adds the new course to the beginning of the list
    array_unshift($viewed, $course);

    //Removes duplicates 
    $viewed = array_unique($viewed);

    //Limits the list to 5 items
    $session->set('recently_viewed_courses', array_slice($viewed, 0, 5));
  }

  /* Simple method to return the list of stored course names from session */
  public function get()
  {
    return $this->requestStack->getCurrentRequest()->getSession()->get('recently_viewed_courses', []);
  }
}
