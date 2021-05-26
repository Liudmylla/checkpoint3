<?php
namespace App\Service;

use App\Entity\Tile;
use App\Repository\TileRepository;
use App\Entity\Boat;

class MapManager
{
    public function tileExists(int $x, int $y, TileRepository $tileRepository): bool
    {
         $tile = $tileRepository->findOneBy(array('coord_x' => $x,'coord_y'=>$y));
         if($tile){
             return true;
         }
         return false;
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