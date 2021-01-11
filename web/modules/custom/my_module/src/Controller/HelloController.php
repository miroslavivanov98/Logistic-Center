<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {

    public function showContent() {
        return [
            '#type' => 'markup',
            '#markup' => \Drupal::config('my_module.settings')->get('reviews')['value'],
            '#cache' => [
                'tags' => ['MY_CUSTOM_UNIQUE_TAG'],
              ],
        ];
    }
}