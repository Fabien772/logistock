<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'page_name' => 'app_index',
        ]);
    }

    #[Route('/undo', name: 'app_undo')]
    public function page_undo(Request $request): Response
    {
        return $this->redirect($request->headers->get('referer'));
    
       
        
    }
}
