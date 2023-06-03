<?php

namespace Drupal\dogceo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dogceo\Controller\FetchDogController;

/**
 * Provides a custom block to display the dog breed.
 *
 * @Block(
 *   id = "dog_breed_block",
 *   admin_label = @Translation("Dog Breed Block"),
 * )
 */
class DogBreedBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a new DogBreedBlock instance.
   *
   * @param array $configuration
   *   The block configuration.
   * @param string $plugin_id
   *   The block ID.
   * @param mixed $plugin_definition
   *   The block plugin definition.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->configFactory->get('dogceo.settings');
    $slug = (!empty($config->get('slug'))) ? $config->get('slug') : 'beagle';
    $fetch_dog = new FetchDogController;
    $image_url = $fetch_dog->fetchDogImage($slug);
    $build = '';

    if ($image_url) {
      // Build the image element with the generated URL.
      $build = [
        '#theme' => 'imagecache_external',
        '#uri' => $image_url,
        '#style_name' => 'large',
        '#alt' => 'Dog CEO block random image',
      ];
    }

    return $build;
  }

}
