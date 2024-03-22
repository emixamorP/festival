<?php

namespace App\Controller;

use App\Entity\TypeDeChambre;
use App\Form\TypeDeChambreType;
use App\Repository\TypeDeChambreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type_de_chambre')]
class TypeDeChambreController extends AbstractController
{
    #[Route('/', name: 'app_type_de_chambre_index', methods: ['GET'])]
    public function index(TypeDeChambreRepository $typeDeChambreRepository): Response
    {
        return $this->render('type_de_chambre/index.html.twig', [
            'type_de_chambres' => $typeDeChambreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_de_chambre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeDeChambreRepository $typeDeChambreRepository): Response
    {
        $typeDeChambre = new TypeDeChambre();
        $form = $this->createForm(TypeDeChambreType::class, $typeDeChambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeDeChambreRepository->save($typeDeChambre, true);

            return $this->redirectToRoute('app_type_de_chambre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_de_chambre/new.html.twig', [
            'type_de_chambre' => $typeDeChambre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_de_chambre_show', methods: ['GET'])]
    public function show(TypeDeChambre $typeDeChambre): Response
    {
        return $this->render('type_de_chambre/show.html.twig', [
            'type_de_chambre' => $typeDeChambre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_de_chambre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeDeChambre $typeDeChambre, TypeDeChambreRepository $typeDeChambreRepository): Response
    {
        $form = $this->createForm(TypeDeChambreType::class, $typeDeChambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeDeChambreRepository->save($typeDeChambre, true);

            return $this->redirectToRoute('app_type_de_chambre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_de_chambre/edit.html.twig', [
            'type_de_chambre' => $typeDeChambre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_de_chambre_delete', methods: ['POST'])]
    public function delete(Request $request, TypeDeChambre $typeDeChambre, TypeDeChambreRepository $typeDeChambreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDeChambre->getId(), $request->request->get('_token'))) {
            $typeDeChambreRepository->remove($typeDeChambre, true);
        }

        return $this->redirectToRoute('app_type_de_chambre_index', [], Response::HTTP_SEE_OTHER);
    }
}
