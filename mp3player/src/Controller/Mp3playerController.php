<?php


namespace Drupal\mp3player\Controller;

use Drupal\Core\Controller\ControllerBase;

class Mp3playerController extends ControllerBase {

  public function mp3player_player_list() {

//    $element = array(
//      '#markup' => 'Hello, world',
//    );
//    return $element;
//    $build = array(
//      '#type' => 'markup',
//      '#markup' => t('Hello World!'),
//    );
//    return $build;


    $header = array(t('Player Name'), t('Actions'));
    $rows = array();
    $players = $this->mp3player_players();
    foreach ($players as $pid => $player) {
      $row = array();
      $row[] = $player['name'];
      $links = array();
      $links[] = l(t('Edit'), 'admin/config/media/mp3player/player/'. $player['pid']);
      if($pid > 1) {
        $links[] = l(t('Delete'), 'admin/config/media/mp3player/player/'. $player['pid'] .'/delete');
      }
      $row[] = implode('&nbsp;&nbsp;&nbsp;&nbsp;', $links);
      $rows[] = $row;
    }
    $output = array('type' => 'markup', 'header' => $header, 'rows' => $rows);
    return $output;

  }


  /**
   * Return list of all available players along with settings.
   */
  function mp3player_players($pid = NULL) {
    $players = array();
//    $result = db_select('mp3player_players', 'm')
//      ->fields('m')
//      ->execute();
//    while($player = $result->fetchAssoc()) {
//      $players[$player['pid']] = $player;
//    }
//    if($pid && array_key_exists($pid, $players)) {
//      return $players[$pid];
//    }
    return $players;
  }

}
