<?php

declare(strict_types=1);

namespace NoobMCBG\AutoInventory;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
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
	
	/**
	 * @param EntityExplodeEvent $event
	 */
	public function onEntityExplode(EntityExplodeEvent $event) : void {
		$death = $event->getEntity();
		foreach($death->getPosition()->getWorld()->getNearbyEntities($death->getBoundingBox()->grow(24, 24, 24)) as $entity){
			if($entity instanceof Player){
				foreach($event->getBlockList() as $key => $block){
					$this->plugin->autoInventory($entity, $block);
				}
			}
		}
	}
	
	/**
	 * @param EntityDeathEvent $event
	 */
	public function onPlayerDeath(PlayerDeathEvent $event) : void {
		$cause = $event->getEntity()->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent){
			$damager = $cause->getDamager();
			if($damager instanceof Player){
				foreach($event->getDrops() as $drop){
					$this->plugin->autoInventory($damager, $drop);
				}
				$event->setDrops([]);
			}
		}
	}
}
