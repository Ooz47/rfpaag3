<?php
/**
 * @file
 * Contains \Drupal\reseau_mod\Plugin\Block\NewsletterInscriptionMailchimpFormBlock.
 */

namespace Drupal\reseau_mod\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "NewsletterInscriptionMailchimpFormBlock",
 *   admin_label = @Translation("Newsletter inscription Mailchimp"),
 *   category = @Translation("Formulaire d'inscription Mailchimp")
 * )
 */
class NewsletterInscriptionMailchimpFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $node = \Drupal::routeMatch()->getParameter('node');
    //si on accede à un node: paage,actus,evenement,contact,formaation
    if ($node instanceof \Drupal\node\NodeInterface) {
      // dsm($node);


      // $node = $context['data']['node'];
      if (!empty($node->get('field_structure_associee')->getValue())) {
       
        $terms = $node->get('field_structure_associee')->getValue();
        $structure = $terms[0]['target_id'];
        // dsm($terms);
        // if ($terms[0]['target_id'] != WEBMASTER_RESEAU) {
        //   $replacements[] = '[node:field_structure_associee:entity:name]';
        // }
  
        // implémenter pour conserver un seul bloc de code pour le form
  //       switch ($terms[0]['target_id']) {
  //         // Article URL logic.
  //       case WEBMASTER_GRETA_GUADELOUPE:
  // $structure="2";
  //         break;
  
  //         default:
  //           break;
  //     }
      }


      return [
        '#theme' =>"newsletter_mailchimp_block",
        '#data' => ['structure' => $structure],
        // '#data' => ['age' => '31', 'DOB' => '2 May 2000','structure' => $structure],
      ];

    }
   
   
  

    // return [
    //   '#markup' => $this->t('Hello, World!'),
    // ];
   }
}