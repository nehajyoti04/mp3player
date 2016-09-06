<?php
/**
 * @file
 * Contains \Drupal\example\Form\ExampleForm.
 */

namespace Drupal\mp3player\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\mp3player\Controller\Mp3playerController;


use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityConfirmFormBase;

/**
 * Implements an example form.
 */
class Mp3playerDeleteForm extends ConfirmFormBase {

  /**
   * The ID of the item to delete.
   *
   * @var string
   */
  protected $name;
  protected $pid;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mp3player_player_delete';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete the player %name?', array('%name' => $this->name));
  }

  /**
   * {@inheritdoc}
   */
    public function getCancelUrl() {
      return new Url('mp3player.player_list');
  }

  /**
   * {@inheritdoc}
   */
    public function getConfirmText() {
    return t('Delete');
  }

  /**
   * {@inheritdoc}
   */
    public function getCancelText() {
    return t('Cancel');
  }

  public function buildForm(array $form, FormStateInterface $form_state, $pid = NULL) {
    $player = Mp3playerController::mp3player_players($pid);



    if($pid) {
      $player = $player[$pid];
      $this->pid = $pid;
      $this->name = $player['name'];
    }

    if (empty($player)) {
     drupal_set_message(t('The specified player was not found.'), 'error');
     drupal_goto('admin/settings/mp3player');
    }
    if($player['name'] == 'Default') {
      drupal_set_message(t('You cannot delete the Default player.'), 'error');
      drupal_goto('admin/settings/mp3player');
    }


    // dpm($player);



//
   // $form = array();
   // $form['pid'] = array('#type' => 'value', '#value' => $pid);
   // return confirm_form(
   //   $form,
   //   t('Are you sure you want to delete the player %name?',
   //     array('%name' => $player['name'])
   //   ),
   //   'admin/settings/mp3player',
   //   t('This action cannot be undone.'),
   //   t('Delete'),  t('Cancel')
   // );


   // $form['submit'] = array(
   //   '#type' => 'submit',
   //   '#value' => t('Save changes to player'),
   // );
   // return $form;
   return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    db_delete('mp3player_players')->condition('pid', $pid)->execute();
    // $this->entity->delete();
    // $this->delete();
    // mp3player_delete($this->pid);
  }

}
