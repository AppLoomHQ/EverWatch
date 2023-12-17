<?php

namespace App\Controller\Dashboard;

use App\Entity\Watcher;
use App\Form\WatcherType;
use App\Repository\WatcherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/watchers')]
class WatcherCRUDController extends AbstractController
{
    #[Route('/', name: 'app_dasboard_watchers_index', methods: ['GET'])]
    public function index(WatcherRepository $watcherRepository): Response
    {
        return $this->render('watcher_crud/index.html.twig', [
            'watchers' => $watcherRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_watcher_c_r_u_d_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $watcher = new Watcher();
        $form = $this->createForm(WatcherType::class, $watcher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($watcher);
            $entityManager->flush();

            return $this->redirectToRoute('app_watcher_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('watcher_crud/new.html.twig', [
            'watcher' => $watcher,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_watcher_c_r_u_d_show', methods: ['GET'])]
    public function show(Watcher $watcher): Response
    {
        return $this->render('watcher_crud/show.html.twig', [
            'watcher' => $watcher,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_watcher_c_r_u_d_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Watcher $watcher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WatcherType::class, $watcher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_watcher_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('watcher_crud/edit.html.twig', [
            'watcher' => $watcher,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_watcher_c_r_u_d_delete', methods: ['POST'])]
    public function delete(Request $request, Watcher $watcher, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$watcher->getId(), $request->request->get('_token'))) {
            $entityManager->remove($watcher);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_watcher_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
    }
}
