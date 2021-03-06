<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class LightWeightEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "LightWeight";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["duration" => 40, "baseAmplifier" => 1, "amplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player->hasEffect(Effect::SPEED) !== true) {
                $effect = new EffectInstance(Effect::getEffect(Effect::SPEED), $this->extraData["duration"], $level * $this->extraData["amplifierMultiplier"] + $this->extraData["baseAmplifier"], false);
                $player->addEffect($effect);
                $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Light Weight" . TextFormat::RESET . TextFormat::GRAY . "•");
            }
        }
    }
}