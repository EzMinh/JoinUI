<?php


namespace EzMinh\JoinUI;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;
use pocketmine\event\player\PlayerJoinEvent;

//Import FormAPI
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener {
    public function onEnable() {
        $this->saveDefaultConfig();
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onJoin(PlayerJoinEvent $e) {
        $player = $e->getPlayer();
        $name = $player->getName();
        $form = new SimpleForm(function(Player $player, $data){
            $result = $data;
            switch($result) {
                case "0":
                break;
            }
        });
        $form->setTitle($this->cfg->get("form.title"));
        $content1 = str_replace("{NAME}", $name, $this->cfg->get("form.content"));
        $content2 = str_replace("{LINE}", "\n", $content1);
        $form->setContent($content2);
        $form->addButton($this->cfg->get("close.btn"));
        $form->sendToPlayer($player);
    }
}