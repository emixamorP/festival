<?php

namespace App\Controller;

use App\Entity\Attribution;
use App\Form\AttributionType;
use App\Repository\AttributionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/attribution')]
class AttributionController extends AbstractController
{
    #[Route('/', name: 'app_attribution_index', methods: ['GET'])]
    public function index(AttributionRepository $attributionRepository): Response
    {
        return $this->render('attribution/index.html.twig', [
            'attributions' => $attributionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_attribution_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Request $request, AttributionRepository $attributionRepository): Response
    {
        $attribution = new Attribution();
        $form = $this->createForm(AttributionType::class, $attribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributionRepository->save($attribution, true);

            return $this->redirectToRoute('app_attribution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attribution/new.html.twig', [
            'attribution' => $attribution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attribution_show', methods: ['GET'])]
    public function show(Attribution $attribution): Response
    {
        return $this->render('attribution/show.html.twig', [
            'attribution' => $attribution,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_attribution_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Attribution $attribution, AttributionRepository $attributionRepository): Response
    {
        $form = $this->createForm(AttributionType::class, $attribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributionRepository->save($attribution, true);

            return $this->redirectToRoute('app_attribution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attribution/edit.html.twig', [
            'attribution' => $attribution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attribution_delete', methods: ['POST'])]
    public function delete(Request $request, Attribution $attribution, AttributionRepository $attributionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attribution->getId(), $request->request->get('_token'))) {
            $attributionRepository->remove($attribution, true);
        }

        return $this->redirectToRoute('app_attribution_index', [], Response::HTTP_SEE_OTHER);
    }
}
