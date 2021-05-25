<?php

namespace App\Controller;

use App\Entity\Boat;
use App\Repository\BoatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MapManager;

/**
 * @Route("/boat")
 */
class BoatController extends AbstractController
{
    /**
     * Move the boat to coord x,y
     * @Route("/move/{x}/{y}", name="moveBoat", requirements={"x"="\d+", "y"="\d+"}))
     */
    public function moveBoat(int $x, int $y, BoatRepository $boatRepository, EntityManagerInterface $em): Response
    {
        $boat = $boatRepository->findOneBy([]);
        $boat->setCoordX($x);
        $boat->setCoordY($y);
        $em->flush();
        return $this->redirectToRoute('map');
    }
    /**
     * Move the boat to direction
     * @Route("/{direction}", name="direction", requirements={"direction"="[NSEW]"}))
     */
    public function moveDirection(string $direction, BoatRepository $boatRepository, EntityManagerInterface $em): Response
    {
        $boat = $boatRepository->findOneBy([]);
        switch ($direction) {
            case 'E':
              $x = $boat->getCoordX()+1;
              $y = $boat->getCoordY();
                break;
                case 'W':
                    $x = $boat->getCoordX()-1;
                    $y = $boat->getCoordY();
                      break;
                      case 'N':
                        $x = $boat->getCoordX();
                        $y = $boat->getCoordY()-1;
                          break;
                          case 'S':
                            $x = $boat->getCoordX();
                            $y = $boat->getCoordY()+1;
                              break;
            // default:
            //     # code...
            //     break;
        }
        $boat->setCoordX($x);
        $boat->setCoordY($y);
        $em->flush();
        return $this->redirectToRoute('map');
    }
}
