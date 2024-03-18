<?php
/**
 * @file
 * Contains \Drupal\reseau_mod\Plugin\Block\SearchFaqFormBlock.
 */

namespace Drupal\reseau_mod\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "SearchFaqFormBlock",
 *   admin_label = @Translation("Recherche Faq"),
 *   category = @Translation("Bloc de recherche sur page faq accordeon")
 * )
 */
class SearchFaqFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $form = \Drupal::formBuilder()->getForm('Drupal\reseau_mod\Form\SearchFaqForm');

    return $form;

    // return [
    //   '#markup' => $this->t('Hello, World!'),
    // ];
   }
}