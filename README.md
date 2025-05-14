# Recently Viewed Courses

Sample Problem Solving Task: “Recently Viewed Courses Page”

## Scenario:

The University wants a page on the website that shows:

- A cacheable block of curated "Popular Courses".

- A non-cacheable block of "Recently Viewed Courses" (tracked per user session).

- Clean separation of frontend logic using Twig templates and CSS classes.

- Accessibility in markup and semantic HTML.

---

## Task Requirements:

1. Create a custom module called recently_viewed_courses.

2. On visiting /courses/recently-viewed, the page should:

  - Display Popular Courses (static content for now).

  - Display Recently Viewed Courses stored in user session.

3. Use render arrays and #lazy_builder for the non-cacheable part.

4. Write a service to handle session storage for recently viewed courses.

5. Ensure the page is accessible and responsive.


---

## Features

- Adds a custom page at `/courses/recently-viewed`.
- Displays:
  - **Popular Courses** (cacheable content).
  - **Recently Viewed Courses** (user session-based, non-cacheable).
- Uses:
  - Render arrays and lazy builders (can be switched to direct block rendering).
  - Twig template for clean and accessible frontend output.
  - A custom service for session-based storage of recently viewed items.
- Accessibility support with ARIA labels and semantic HTML.

---

## Installation

1. Clone the module or copy it into the `modules/custom/` directory of your Drupal project.

```bash
cd web/modules/custom
git clone https://github.com/your-repo/recently_viewed_courses.git


2. Enable the module using Drush or the admin UI.

```bash
drush en recently_viewed_courses

3. Visit /courses/recently-viewed to test the feature.

## How It Works

Page Rendering
CoursePageController.php builds a render array with:

#popular_courses: static HTML with permanent cache.

#recently_viewed: lazy-loaded block based on session (or direct rendering if preferred).

Block & Service
RecentlyViewedBlock.php: Renders the non-cacheable list using a service.

CourseTracker.php: Stores and retrieves course names from PHP session.

---

## Test

Now visit:
https://my-first-drupal10-app.ddev.site:8443/course/view/psychology
https://my-first-drupal10-app.ddev.site:8443/course/view/ai

Then go back to:
https://my-first-drupal10-app.ddev.site:8443/courses/recently-viewed
