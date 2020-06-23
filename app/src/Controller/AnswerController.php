<?php
/**
 * Answer controller.
 */

namespace App\Controller;

use App\Entity\Answer;
use App\Form\AnswerBestType;
use App\Form\AnswerType;
use App\Repository\AnswerRepository;
use Symfony\Component\Form\Extension\Core\Type\FormType;
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
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\AnswerRepository $answerRepository AnswerRepository
     * @param \Knp\Component\Pager\PaginatorInterface $paginator Paginator
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


    /**
     * Create action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Repository\AnswerRepository $answerRepository Answer repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/create",
     *     methods={"GET", "POST"},
     *     name="answer_create",
     * )
     */
    public function create(Request $request, AnswerRepository $answerRepository): Response
    {
        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $answerRepository->save($answer);

            return $this->redirectToRoute('answer_index');
        }

        return $this->render(
            'answer/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Answer $answer Answer entity
     * @param \App\Repository\AnswerRepository $answerRepository Answer repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="answer_edit",
     * )
     */

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Answer $answer Answer entity
     * @param \App\Repository\AnswerRepository $answerRepository Answer repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="answer_edit",
     * )
     */
    public function edit(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        $form = $this->createForm(AnswerType::class, $answer, ['method' => 'PUT']);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $answerRepository->save($answer);

            $this->addFlash('success', 'message_updated_successfully');

            return $this->redirectToRoute('answer_index');
        }

        return $this->render(
            'answer/edit.html.twig',
            [
                'form' => $form->createView(),
                'answer' => $answer,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Answer $answer Answer entity
     * @param \App\Repository\AnswerRepository $answerRepository Answer repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/delete",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="answer_delete",
     * )
     */
    public function delete(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        $form = $this->createForm(FormType::class, $answer, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $answerRepository->delete($answer);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('question_index');
        }

        return $this->render(
            'answer/delete.html.twig',
            [
                'form' => $form->createView(),
                'answer' => $answer,
            ]
        );
    }

    /**
     * Best action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Answer $answer Answer entity
     * @param \App\Repository\AnswerRepository $answerRepository Answer repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/best",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="answer_best",
     * )
     */

    public function best (Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        $form = $this->createForm(AnswerBestType::class, $answer, ['method' => 'PUT']);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $answerRepository->save($answer);

            $this->addFlash('success', 'message_updated_successfully');

            return $this->redirectToRoute('question_index');
        }

        return $this->render(
            'answer/best.html.twig',
            [
                'form' => $form->createView(),
                'answer' => $answer,
            ]
        );
    }



}

