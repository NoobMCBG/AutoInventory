## General

| **Plugins** | **AutoInventory** |
| --- | --- |
| **API** | **<a href="https://poggit.pmmp.io/p/AutoInventory"><img src="https://poggit.pmmp.io/shield.api/AutoInventory"></a>** |
| **Version** | **<a href="https://poggit.pmmp.io/p/AutoInventory"><img src="https://poggit.pmmp.io/shield.state/AutoInventory"></a>** |
| **Download** | **<a href="https://poggit.pmmp.io/p/AutoInventory"><img src="https://poggit.pmmp.io/shield.dl/AutoInventory"></a>** |
| **Total Download** | **<a href="https://poggit.pmmp.io/p/AutoInventory"><img src="https://poggit.pmmp.io/shield.dl.total/AutoInventory"></a>** |

<br>

>- Items automatically go to your inventory ✔️
<img src="https://github.com/NoobMCBG/AutoInventory/blob/main/icon.png"/>

<br>

## Features
>- Items automatically go to your inventory

<br>
  
## Permissions
| **Permission** | **Description** | **Default** |
| --- | --- | --- |
| **`autoinv.bypass`** | **Permission to have items automatically in the inventory** | **true** |

<br>

## Config
```yaml
---
#
# ░░░█████╗░██╗░░░██╗████████╗░█████╗░██╗███╗░░██╗██╗░░░██╗███████╗███╗░░██╗████████╗░█████╗░██████╗░██╗░░░██╗
# ░░██╔══██╗██║░░░██║╚══██╔══╝██╔══██╗██║████╗░██║██║░░░██║██╔════╝████╗░██║╚══██╔══╝██╔══██╗██╔══██╗╚██╗░██╔╝
# ░░███████║██║░░░██║░░░██║░░░██║░░██║██║██╔██╗██║╚██╗░██╔╝█████╗░░██╔██╗██║░░░██║░░░██║░░██║██████╔╝░╚████╔╝░
# ░░██╔══██║██║░░░██║░░░██║░░░██║░░██║██║██║╚████║░╚████╔╝░██╔══╝░░██║╚████║░░░██║░░░██║░░██║██╔══██╗░░╚██╔╝░░
# ░░██║░░██║╚██████╔╝░░░██║░░░╚█████╔╝██║██║░╚███║░░╚██╔╝░░███████╗██║░╚███║░░░██║░░░╚█████╔╝██║░░██║░░░██║░░░
# ░░╚═╝░░╚═╝░╚═════╝░░░░╚═╝░░░░╚════╝░╚═╝╚═╝░░╚══╝░░░╚═╝░░░╚══════╝╚═╝░░╚══╝░░░╚═╝░░░░╚════╝░╚═╝░░╚═╝░░░╚═╝░░░

full-inv:
  drop: true # When you set it to "true" and when the player's bag is full, the item will drop to the ground
  title:
    mode: true # When you set it to "true" and when the player's inventory is full, they will send 1 Title
    title: "Full Inventory" # Title send
    subtitle: "Drop items from inventory for quick pick up" # Subtitle send
    sounds: # When the player's inventory is full, they will send sounds
      - "random.click" 
      - "random.explode"
...
```
  
<br>

## For Developer
>- You can access to AutoInventory by using `AutoInventory::getInstance()`
>- Item to inventory usage:
```php
AutoInventory::getInstance()->autoInventory($player, $item);
```

<br>

## Install
>- Step 1: Click the `Direct Download` button to download the plugin
>- Step 2: move the file `AutoInventory.phar` into the file `plugins`
>- Step 3: Restart server for plugins to work
