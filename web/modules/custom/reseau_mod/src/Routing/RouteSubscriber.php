<?php

namespace Drupal\reseau_mod\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Change path '/user/login' to '/my-website/my-bo/login'.
    if ($route = $collection->get('user.login')) {
      $route->setPath('/identification');
    }
  }

}