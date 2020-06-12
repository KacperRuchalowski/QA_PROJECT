<?php
/**
 * Answer controller.
 */

namespace App\Controller;

use App\Entity\Answer;
use App\Repository\AnswerRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AnswerController.
 *
 * @Route("/answer")
 */
class AnswerController extends AbstractController
{
    /**
     * Index action.
     * @param \Symfony\Component\HttpFoundation\Request $request        HTTP request
     * @param \App\Repository\AnswerRepository $answerRepository AnswerRepository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator      Paginator
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="answer_index",
     *
     * )
     */
    public function index(Request $request, AnswerRepository $answerRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $answerRepository->findAll(),
            $request->query->getInt('page', 1),
            AnswerRepository::PAGINATOR_ITEMS_PER_PAGE
        );



        return $this->render(
            'Answer/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * @param AnswerRepository $answerRepository
     * @param int $id
     * @return Response
     *
     * @Route(
     *
     *     "/{id}",
     *     methods={"GET"},
     *     name="answer_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     **/


    public function show(Answer $answer): Response
    {
        return $this->render(
            'Answer/show.html.twig',
            ['answer' => $answer]
        );
    }
}

