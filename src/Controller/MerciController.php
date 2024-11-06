<?php

namespace App\Controller;

use App\Entity\Merci;
use App\Form\MerciType;
use App\Repository\MerciRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class MerciController extends AbstractController
{

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    // 1. Afficher la liste des "mercis"
    #[Route('/merci', name: 'merci_index')]
    public function index(MerciRepository $merciRepository, Request $request): Response
    {
        $authorName = $request->query->get('author_name');

        if ($authorName) {
            $mercis = $merciRepository->findByAuthorName($authorName);
        } else {
            $mercis = $merciRepository->findAll();
        }

        return $this->render('merci/index.html.twig', [
            'mercis' => $mercis,
        ]);
    }

    // 2. Créer un nouveau "merci"
    #[Route('/merci/new', name: 'merci_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $merci = new Merci();
        $merci->setDate(new \DateTime()); 

        $form = $this->createForm(MerciType::class, $merci);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->security->getUser();
            if ($user && $user->getSalarie()) {
                $merci->setAuthor($user->getSalarie());
            }

            $entityManager->persist($merci);
            $entityManager->flush();

            return $this->redirectToRoute('merci_index');
        }

        return $this->render('merci/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // 3. Modifier un "merci" existant
    #[Route('/merci/{id}/edit', name: 'merci_edit')]
    public function edit(Merci $merci, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MerciType::class, $merci);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('merci_index');
        }

        return $this->render('merci/edit.html.twig', [
            'form' => $form->createView(),
            'merci' => $merci,
        ]);
    }

    // 4. Supprimer un "merci"
    #[Route('/merci/{id}/delete', name: 'merci_delete', methods: ['POST'])]
    public function delete(Merci $merci, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($merci);
        $entityManager->flush();

        return $this->redirectToRoute('merci_index');
    }

    // 5. Filtrer les "mercis" par Salarie
    #[Route('/merci/filter/{Salarie}', name: 'merci_filter')]
    public function filter(MerciRepository $merciRepository, $Salarie): Response
    {
        $mercis = $merciRepository->findBy(['author' => $Salarie]);

        return $this->render('merci/index.html.twig', [
            'mercis' => $mercis,
        ]);
    }
}
