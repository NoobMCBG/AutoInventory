<?php

declare(strict_types=1);

namespace NoobMCBG\AutoInventory;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\entity\EntityExplodeEvent;

class EventListener implements Listener {
    
    	private AutoInventory $plugin;
  
    	public function __construct(AutoInventory $plugin){
        	$this->plugin = $plugin;
    	}
    
    	/**
	 * @param BlockBreakEvent $event
	 */
	public function onBreak(BlockBreakEvent $event) : void {
		foreach($event->getDrops() as $drop){
			$this->plugin->autoInventory($event->getPlayer(), $drop);
		}
		$event->setDrops([]);
	}
    
	/**
	 * @param EntityDeathEvent $event
	 */
	public function onEntityDeath(EntityDeathEvent $event) : void {
		$cause = $event->getEntity()->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent){
			$damager = $cause->getDamager();
			if($damager instanceof Player){
				foreach($event->getDrops() as $drop) {
					$this->plugin->autoInventory($damager, $drop);
				}
				$event->setDrops([]);
			}
		}
	}
}
