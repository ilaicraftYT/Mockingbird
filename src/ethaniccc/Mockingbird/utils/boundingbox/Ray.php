<?php

namespace ethaniccc\Mockingbird\utils\boundingbox;

// thanks shura62!
use ethaniccc\Mockingbird\user\User;
use pocketmine\entity\Entity;
use pocketmine\math\Vector3;

class Ray{

    /** @var Vector3 */
    public $origin, $direction;

    public static function from(Entity $player) : Ray{
        return new Ray($player->add(0, $player->getEyeHeight(), 0), $player->getDirectionVector());
    }

    public static function fromUser(User $user) : Ray{
        return new Ray($user->moveData->location->add(0, ($user->isSneaking ? 1.54 : 1.62), 0), $user->moveData->directionVector);
    }

    public function __construct(Vector3 $origin, Vector3 $direction){
        $this->origin = $origin;
        $this->direction = $direction;
    }

    public function getOrigin() : Vector3{
        return $this->origin;
    }

    public function getDirection() : Vector3{
        return $this->direction;
    }

    public function traverse(float $travel) : Vector3{
        return $this->origin->add($this->direction->multiply($travel));
    }

}