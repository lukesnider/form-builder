<?php
namespace FormBuilder;

use FormBuilder\Traits\Singleton;
use Jenssegers\Blade\Blade;

class Backend extends \FormBuilder\Controller {

  use Singleton;

  public function init(){
    $this->blade = new Blade($this->views, $this->cache);
  }

  public function plugin_page(){
    echo $this->blade->make('admin.plugin-page', [
    ]);

  }
  public function widgets($widgets){

    $widgets = [
      [
        'id' =>  1,
        'name' => 'Text',
        'icon' => 'fas fa-font',
        'tag' => 'input',
        'placeholder' => ' Default Text Input',
        'type' => 'text',
        'uid' => false,
        'content' => '<input type="text"  class="swd-input" placeholder="Text Input..." />',
        'styles' =>[
          'width' => 100,
          'width_type' => '%',
          'padding' => ['top'=>8,'right'=>8,'bottom'=>8,'left'=>8,],
          'margin' => ['top'=>0,'right'=>0,'bottom'=>0,'left'=>0,],
          'justify' => 'center',
          'color' =>[
            'rgba' =>[
              'r' => 0,
              'g' => 0,
              'b' => 0,
              'a' => 1
            ]
          ],
        ],
        'controls' => [
          'WidthControl',
          'PaddingControl',
          'MarginControl',
          'JustifyControl',
          'PlaceholderControl',
          'ColorControl',
        ]
      ],
      //[
      //  'id' => 2,
      //  'name' => 'Email',
      //  'icon' => 'far fa-envelope',
      //  'tag' => 'input',
      //  'placeholder' => 'Email Text Input',
      //  'type' => 'email',
      //  'uid' => false,
      //  'content' => '<input type="email" class="swd-input" placeholder="Enter email">',
      //  'styles' =>[
      //    'width' => 100,
      //    'width_type' => '%',
      //    'padding' => ['top'=>8,'right'=>8,'bottom'=>8,'left'=>8,],
      //    'margin' => ['top'=>0,'right'=>0,'bottom'=>0,'left'=>0,],
      //    'justify' => 'center',
      //  ],
      //],
      //[
      //  'id' => 3,
      //  'name' => 'Multiline Text',
      //  'icon' => 'far fa-comment-alt',
      //  'tag' => 'textarea',
      //  'placeholder' => 'Multiline Text Input',
      //  'type' => '',
      //  'uid' => false,
      //  'content' => '<textarea class="swd-input" rows="3">Text Area Input...</textarea>',
      //  'styles' =>[
      //    'width' => 100,
      //    'width_type' => '%',
      //    'padding' => ['top'=>8,'right'=>8,'bottom'=>8,'left'=>8,],
      //    'margin' => ['top'=>0,'right'=>0,'bottom'=>0,'left'=>0,],
      //    'justify' => 'center',
      //  ],
      //],
    ];

    $widgets = \apply_filters('formbuilder\widgets\init', $widgets);

    return $widgets;
  }
}
