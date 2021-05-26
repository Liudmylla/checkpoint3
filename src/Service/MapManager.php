<?php
namespace App\Service;

use App\Entity\Tile;
use App\Repository\TileRepository;

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
}