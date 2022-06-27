<?php

declare(strict_types=1);

namespace NoobMCBG\AutoInventory;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\block\Block;
use NoobMCBG\AutoInventory\task\CheckUpdateTask;

class AutoInventory extends PluginBase {
    
        public static $instance;
    
        public static function getInstance() : self {
        	return self::$instance;
        }
    
        public function onEnable() : void {
        	$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        	$this->saveDefaultConfig();
        	$this->checkUpdate();
        	self::$instance = $this;
        }
	
        /** 
         * @param bool $isRetry = false
         */
        public function checkUpdate(bool $isRetry = false): void {   
	    	$this->getServer()->getAsyncPool()->submitTask(new CheckUpdateTask($this->getDescription()->getName(), $this->getDescription()->getVersion()));
        }
    
        public function autoInventory(Player $player, Item|Block $item){
        	if($item instanceof Block){
            		$item->asItem();
        	}
        	if($player->getInventory()->canAddItem($item)){
            		$player->getInventory()->addItem($item);
        	}else{
           		if($this->getConfig()->getAll()["full-inv"]["drop"] == true){
                		$player->getWorld()->dropItem($player->getPosition()->asVector3(), $item);
            		}else{
                		if($this->getConfig()->getAll()["full-inv"]["title"]["mode"] == true){
                    			$player->sendTitle($this->getConfig()->getAll()["full-inv"]["title"]["title"], $this->getConfig()->getAll()["full-inv"]["title"]["subtitle"]);
                    			if(is_array($this->getConfig()->getAll()["full-inv"]["title"]["sounds"])){  
                        			$this->playArraySound($player, $this->getConfig()->getAll()["full-inv"]["title"]["sounds"]);
                    			}else{
                        			$this->playSound($player, $this->getConfig()->getAll()["full-inv"]["title"]["sounds"]);
                    			}
                		}
            		}
        	}
        }
    
        /**
         * @param Player $player
         * @param string $soundName
         * @param float $volume = 0
         * @param float $pitch = 0
         */
        private function playSound(Player $player, string $soundName, float $volume = 0, float $pitch = 0) : void {
	    	$packet = new PlaySoundPacket();
	    	$packet->soundName = $soundName;
	    	$packet->x = $player->getPosition()->getX();
	    	$packet->y = $player->getPosition()->getY();
	    	$packet->z = $player->getPosition()->getZ();
	    	$packet->volume = $volume;
	    	$packet->pitch = $pitch;
	    	$player->getNetworkSession()->sendDataPacket($packet);
        }
    
        /**
         * @param Player $player
         * @param array $soundName
         * @param float $volume = 0
         * @param float $pitch = 0
         */
        private function playArraySound(Player $player, array $sound, float $volume = 0, float $pitch = 0) : void {
        	foreach($sound as $soundName){
            		$packet = new PlaySoundPacket();
            		$packet->soundName = $soundName;
            		$packet->x = $player->getPosition()->getX();
            		$packet->y = $player->getPosition()->getY();
            		$packet->z = $player->getPosition()->getZ();
            		$packet->volume = $volume;
            		$packet->pitch = $pitch;
            		$player->getNetworkSession()->sendDataPacket($packet);
        	}
        }
}
