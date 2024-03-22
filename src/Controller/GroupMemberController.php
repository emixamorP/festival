<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupMemberController extends AbstractController
{
    #[Route('/group/member', name: 'app_group_member')]
    public function index(): Response
    {
        return $this->render('group_member/index.html.twig', [
            'controller_name' => 'GroupMemberController',
        ]);
    }
}
