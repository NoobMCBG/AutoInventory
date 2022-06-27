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
    
    public function autoInventory(Player $player, Item|Block $item){
        if($item instanceof Block){
            $item->asItem();
        }
        if($player->getInventory()->canAddItem($item)){
            $player->getInventory()->addItem($item);
        }else{
            if($this->getConfig()->get("full-inv-drop") == true){
                $player->getWorld()->dropItem($player->getPosition()->asVector3(), $item);
            }
        }
    }
}
