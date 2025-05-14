<?php

namespace Drupal\recently_viewed_courses\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Block\BlockManagerInterface;
use Drupal\Core\Plugin\Context\ContextRepositoryInterface;
use Drupal\Core\Security\TrustedCallbackInterface;

class RecentlyViewedLazyBuilder implements TrustedCallbackInterface
{

  protected $blockManager;
  protected $contextRepository;

  /* injects the Block Manager (dynamically load a block plugin) and Context Repository (allows you to apply any necessary contexts)  into this class */
  public function __construct(BlockManagerInterface $block_manager, ContextRepositoryInterface $context_repository)
  {
    $this->blockManager = $block_manager;
    $this->contextRepository = $context_repository;
  }

  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('plugin.manager.block'),
      $container->get('context.repository')
    );
  }

  /* Creates the recently_viewed_block block plugin, Returns the block’s render array. */
  public function render()
  {
    $plugin_block = $this->blockManager->createInstance('recently_viewed_block', []);
    $plugin_block->setContextMapping([]);
    return $plugin_block->build();
  }

  public static function trustedCallbacks()
  {
    return ['render'];
  }
}
