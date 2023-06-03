<?php

/**
 * @file
 * Contains \Drupal\dogceo\Controller\FetchDogController
 */

namespace Drupal\dogceo\Controller;

class FetchDogController {

  /**
   * Fetches a random dog image URL based on the breed name.
   *
   * @param string $slug
   *   The breed name from the Dog Breed content type.
   *
   * @return string|false
   *   The URL of the random dog image or false if an error occurs.
   */
  function fetchDogImage($slug) {
    $api_url = 'https://dog.ceo/api/breed/' . rawurlencode($slug) . '/images/random';
    $response = \Drupal::httpClient()->get($api_url);

    if ($response->getStatusCode() === 200) {
      $data = json_decode($response->getBody(), TRUE);

      if (isset($data['message'])) {
        return $data['message'];
      }
    }

    return false;
  }

}
