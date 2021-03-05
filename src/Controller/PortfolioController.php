<?php
/*
 *
 * Date : 05/03/2021, 16:56
 * Author : rami
 * Class PortfolioController.php
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PortfolioController
 * @package App\Controller
 * @Route("/portfolio", name="portfolio")
 */
class PortfolioController extends AbstractController
{
    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->render("portfolio/index.html.twig");
    }
}
