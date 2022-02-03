<?php

namespace App\Controller\front;

use App\Entity\Flash;
use App\Entity\Category;
use App\Form\BookingType;
use App\Entity\Reservation;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'categories', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('front/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'category', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('front/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{category_id}/flash/{flash_id}', name: 'booking', methods: ['GET', 'POST'])]
    #[ParamConverter('category', options: ['id' => 'category_id'])]
    #[ParamConverter('flash', options: ['id' => 'flash_id'])]

    public function booking( MailerInterface $mailer, Category $category,Flash $flash, Request $request, EntityManagerInterface $entityManager): Response
    {
        $booking = new Reservation();

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($booking);
            $booking->setFlash($flash);

            $entityManager->flush();

            // Envoyer un mail lors qu'une nouvelle réservation est demandée
            $email = (new Email())
            ->from($request->get("booking")["email"])
            ->to('your_email@example.com')
            ->subject('Une nouvelle demande de réservation')
            ->html($this->renderView('front/email.html.twig', ['booking' => $booking, 'flash'=> $flash]));
            $mailer->send($email);



            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('front/booking.html.twig', [
            'booking' => $booking,
            'form' => $form,
            'flash'=> $flash

        ]);
    }


}
