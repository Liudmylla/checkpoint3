<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tile;
use App\Repository\BoatRepository;
use App\Repository\TileRepository;
use App\Entity\Boat;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\MapManager;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function displayMap(BoatRepository $boatRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $tiles = $em->getRepository(Tile::class)->findAll();

        foreach ($tiles as $tile) {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $boatRepository->findOneBy([]);
        $currentTile = $map[$boat->getCoordX()][$boat->getCoordY()];

        return $this->render('map/index.html.twig', [
            'map'  => $map ?? [],
            'boat' => $boat,
            'tile' => $currentTile
        ]);
    }
    /**
     * @Route("/start",name="start")
     */
    public function start(BoatRepository $boatRepository,MapManager $mapManager,EntityManagerInterface $em, TileRepository $tileRepository): Response 
    {
        $boat = $boatRepository->findOneBy([]);
        $boat->setCoordX(0);
        $boat->setCoordY(0);
        $em->flush();
        $tile = $mapManager->getRandomIsland($tileRepository);
        $tile->setHasTreasure(true);
        $em->flush();
        return $this->redirectToRoute('map');
    }
}
