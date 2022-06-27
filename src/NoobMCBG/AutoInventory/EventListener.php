<?php

declare(strict_types=1);

namespace NoobMCBG\AutoInventory;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;

class EventListener implements Listener {
    
    private AutoInventory $plugin;
  
    public function __construct(AutoInventory $plugin){
        $this->plugin = $plugin;
    }
}
