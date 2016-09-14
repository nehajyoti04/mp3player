<?php

namespace Drupal\mp3player\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;

class Mp3playerController extends ControllerBase {

  public function mp3player_player_list() {

    $header = array(t('Player Name'), t('Actions'));
    $rows = array();
    $players = $this->mp3player_players();
    foreach ($players as $pid => $player) {
      $row = array();
      $row[] = $player['name'];
      $url = Url::fromRoute('mp3player.edit_player', array('pid' => $pid));
      $row[] = \Drupal::l(t('Edit'), $url);
      if($pid > 1) {
        $url = Url::fromRoute('mp3player.delete_player', array('pid' => $pid));
        $row[] = \Drupal::l(t('Delete'), $url);
      }
      $rows[] = $row;
    }
    $output = array('#type' => 'table', '#header' => $header, '#rows' => $rows);
    return $output;
  }

  /**
   * Return list of all available players along with settings.
   */
  public static function mp3player_players($pid = NULL) {
    $players = array();

    $result = db_select('mp3player_players', 'm')
      ->fields('m')
      ->execute();
    while($player = $result->fetchAssoc()) {
      $players[$player['pid']] = $player;
    }
    return $players;
  }
}
