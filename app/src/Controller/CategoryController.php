<?php
/**
 * Question controller.
 */

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Question;
use App\Repository\CategoryRepository;
use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController.
 *
 * @Route("/category")
 */
class CategoryController extends AbstractController
{
    /**
     * Index action.
     * @param \Symfony\Component\HttpFoundation\Request $request        HTTP request
     * @param \App\Repository\QuestionRepository $categoryRepository CategoryRepository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator      Paginator
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="category_index",
     *
     * )
     */
    public function index(Request $request, CategoryRepository $categoryRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $categoryRepository->findAll(),
            $request->query->getInt('page', 1),
            CategoryRepository::PAGINATOR_ITEMS_PER_PAGE
        );



        return $this->render(
            'category/index.html.twig',
            ['pagination' => $pagination]
        );
    }



    /**
     * @param CategoryRepository $categoryRepository
     * @param int $id
     * @return Response
     *
     * @Route(
     *
     *     "/{id}",
     *     methods={"GET"},
     *     name="category_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     **/



    public function show(Category $category): Response
    {
        return $this->render(
            'Category/show.html.twig',
            ['category' => $category]
        );
    }
}