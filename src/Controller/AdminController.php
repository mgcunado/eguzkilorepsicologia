<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\BlogPost;
use App\Form\EntryFormType;
use App\Form\UpdateFormType;

/**
 * @Route("/blogadmin")
 */
class AdminController extends Controller
{
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $blogPostRepository;
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
    }


    /**
     * @Route("/create-entry", name="admin_create_entry")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createEntryAction(Request $request)
    {
        $blogPost = new BlogPost();

        $form = $this->createForm(EntryFormType::class, $blogPost);
        $form->handleRequest($request);

        // Check is valid
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($blogPost);
            $this->entityManager->flush($blogPost);

            $this->addFlash('success', 'Felicidades! Tu artículo ha sido creado');

            return $this->redirectToRoute('admin_entries');
        }

        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        $linka = 8;

        return $this->render('admin/entry_form.html.twig', [
            'form' => $form->createView(), 'ppp1' => $ppp1, 'linka' => $linka
        ]);
    }

    /**
     * @Route("/", name="admin_index")
     * @Route("/entries", name="admin_entries")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function entriesAction()
    {
        $blogPosts = [];

        $blogPosts = $this->blogPostRepository->findArticulos();

        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        $linka = 8;

        return $this->render('admin/entries.html.twig', [
            'blogPosts' => $blogPosts, 'ppp1' => $ppp1, 'linka' => $linka
        ]);
    }

    /**
     * @Route("/update-entry/{entryId}", name="admin_update_entry")
     *
     * @param Request $request
     *
     * @param $entryId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateEntryAction(Request $request, $entryId)
    {
        $blogPost = $this->blogPostRepository->findOneById($entryId);

        if (!$blogPost) {
            $this->addFlash('error', 'No se puede borrar el artículo!');

            return $this->redirectToRoute('admin_entries');
        }


        $form = $this->createForm(UpdateFormType::class, $blogPost);
        $form->handleRequest($request);

        // Check is valid
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($blogPost);
            $this->entityManager->flush($blogPost);

            $this->addFlash('success', 'Felicidades! Tu artículo ha sido modificado');

            return $this->redirectToRoute('admin_entries');
        }

        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        $linka = 8;

        return $this->render('admin/entry_form.html.twig', [
            'form' => $form->createView(), 'ppp1' => $ppp1, 'linka' => $linka
        ]);
    }

    /**
     * @Route("/delete-entry/{entryId}", name="admin_delete_entry")
     *
     * @param $entryId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteEntryAction($entryId)
    {
        $blogPost = $this->blogPostRepository->findOneById($entryId);

        if (!$blogPost) {
            $this->addFlash('error', 'No se puede borrar el artículo!');

            return $this->redirectToRoute('admin_entries');
        }

        $this->entityManager->remove($blogPost);
        $this->entityManager->flush();

        $this->addFlash('success', 'El artículo ha sido borrado!');

        return $this->redirectToRoute('admin_entries');
    }
}
