<?php
/**
 * Question controller.
 */

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QuestionController.
 *
 * @Route("/question")
 */
class QuestionController extends AbstractController
{
    /**
     * Index action.
     * @param \Symfony\Component\HttpFoundation\Request $request        HTTP request
     * @param \App\Repository\QuestionRepository $questionRepository QuestionRepository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator      Paginator
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="question_index",
     *
     * )
     */
    public function index(Request $request, QuestionRepository $questionRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $questionRepository->queryAll(),
            $request->query->getInt('page', 1),
            QuestionRepository::PAGINATOR_ITEMS_PER_PAGE
        );



        return $this->render(
            'question/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * @param QuestionRepository $questionRepository
     * @param int $id
     * @return Response
     *
     * @Route(
     *
     *     "/{id}",
     *     methods={"GET"},
     *     name="question_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     **/


    public function show(Question $question): Response
    {
        return $this->render(
            'Question/show.html.twig',
            ['question' => $question]
        );
    }
}