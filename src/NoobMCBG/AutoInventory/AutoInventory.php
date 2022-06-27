<?php

declare(strict_types=1);

namespace NoobMCBG\AutoInventory;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use NoobMCBG\AutoInventory\task\CheckUpdateTask;

class AutoInventory extends PluginBase {
    
    public static $instance;
    
    public static function getInstance() : self {
        return self::$instance;
    }
    
    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->saveDefaultConfig();
        self::$instance = $this;
    }
}
