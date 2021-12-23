<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /** @var integer */
    const POST_LIMIT = 5;
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
     * @Route("/blog", name="blog")
     * @Route("/blog/entries", name="entries")
     */
    public function entriesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        $linka = 9;

        $page = 1;
        if ($request->get('page')) {
            $page = $request->get('page');
        }

        setlocale(LC_ALL, 'es_ES');

        return $this->render('blog/entries.html.twig', [
            'blogPosts' => $this->blogPostRepository->getAllPosts($page, self::POST_LIMIT),
            'totalBlogPosts' => $this->blogPostRepository->getPostCount(),
            'page' => $page,
            'entryLimit' => self::POST_LIMIT,
            'ppp1' => $ppp1, 'linka' => $linka
        ]);
    }

    /**
     * @Route("/blog/{slug}", name="entry")
     */
    public function entryAction($slug)
    {
        $blogPost = $this->blogPostRepository->findOneBySlug($slug);

        $em = $this->getDoctrine()->getManager();

        $ppp1 = $em->getRepository('App:Menu')->findMenus();
        $linka = 8;

        if (!$blogPost) {
            $this->addFlash('error', 'Unable to find entry!');
            return $this->redirectToRoute('entries', array(
                'ppp1' => $ppp1, 'linka' => $linka
            ));
        }
        return $this->render('blog/entry.html.twig', array(
            'blogPost' => $blogPost, 'ppp1' => $ppp1, 'linka' => $linka
        ));
    }
}
