<?php

namespace Drupal\mp3player\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Link;

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

      // print '<pre>'; print_r("player"); print '</pre>';
      // print '<pre>'; print_r($player); print '</pre>';
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
//   public function mp3player_players($pid = NULL) {
//     $players = array();
//    // $result = db_select('mp3player_players', 'm')
//    //   ->fields('m')
//    //   ->execute();




// $query = \Drupal::database()->select('mp3player_players', 'nfd');
// // $query->fields('nfd', ['pid', 'name']);
// $query->fields('nfd');
// // $query->condition('nfd.type', 'vegetable');
// // $query->range(0, 1);
// $result = $query->execute()->fetchAll();
// // print '<pre>'; print_r($result); print '</pre>';

// foreach ($result as $key => $player) {
// // print '<pre>';  print_r($player);
//  // $x = (array)$player;
//  $x = get_object_vars($player);
// // print '<pre>'; print_r($x); print '</pre>';
// // $players[$player->pid] = $player;
// $y[$player->pid] = $x;
// }

// // print '<pre>'; print_r($y); print '</pre>';

// // while($player = $result->fetchAssoc()) {
//     // dpm("player");
//     // dpm($player);
// //      $players[$player['pid']] = $player;
//    // }



//      // print $result;
//    // while($player = $result->fetchAssoc()) {
//     // dpm("player");
//     // dpm($player);
//      // $players[$player['pid']] = $player;
//    // }
//    if($pid && array_key_exists($pid, $players)) {
//      return $players[$pid];
//    }
//    return $y;

//     return $players;
//   }

// }

/**
   * Return list of all available players along with settings.
   */
  public static function mp3player_players($pid = NULL) {
    $players = array();
    // $player = array();
   $result = db_select('mp3player_players', 'm')
     ->fields('m')
     ->execute();
     // dpm("results");
     // dpm($result);
   while($player = $result->fetchAssoc()) {
    // dpm("player");
    // dpm($player);

     $players[$player['pid']] = $player;
     // dpm("players");
     // dpm($players);
   }

   // $player = array('pid' => 1, 'name' => 'hello', 'type' => 'hello type');
   // $players[$player['pid']] = $player;
   // if($pid && array_key_exists($pid, $players)) {
   //   return $players[$pid];
   // }
    return $players;
  }

}
