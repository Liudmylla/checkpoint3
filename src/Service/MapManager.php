<?php
namespace App\Service;

use App\Entity\Tile;
use App\Repository\TileRepository;
use App\Entity\Boat;

class MapManager

{
    private $tileRepository;

    public function __construct (TileRepository $tileRepository)
    {
        $this->tileRepository = $tileRepository;
    }

    public function tileExists(int $x, int $y): bool
    {
        
    return $this->tileRepository->findOneByCoord($x,$y) !==null;
         
    }
    public function getRandomIsland(TileRepository $tileRepository): Tile
    {
        $tiles = $tileRepository->findBy(array('type'=>'island'));
        $index = array_rand($tiles);

        return $tiles[$index];
       
    }
    public function checkTreasure(Boat $boat, Tile $tile): bool
    {
       if ($boat->getCoordX() === $tile->getCoordX() && $boat->getCoordX() === $tile->getCoordY() && $tile->getHasTreasure() === true)
       {
           return true;
       }
    }
}