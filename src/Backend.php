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
}
