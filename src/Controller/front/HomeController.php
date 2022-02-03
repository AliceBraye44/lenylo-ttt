<?php

namespace App\Controller\front;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {

        return $this->render('front/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);

    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->renderForm('front/about.html.twig');
    }

    /**
     * @Route("/soin", name="soin")
     */
    public function soin()
    {
        return $this->renderForm('front/soin.html.twig');
    }

     /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->renderForm('front/contact.html.twig');
    }




}