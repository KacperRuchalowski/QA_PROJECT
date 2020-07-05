<?php
/**
 * Answer service.
 */

namespace App\Service;

use App\Entity\Answer;
use App\Repository\AnswerRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class AnswerService.
 */
class AnswerService
{
    /**
     * Answer repository.
     */
    private AnswerRepository $answerRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * AnswerService constructor.
     *
     * @param AnswerRepository   $answerRepository Answer repository
     * @param PaginatorInterface $paginator        Paginator
     */
    public function __construct(AnswerRepository $answerRepository, PaginatorInterface $paginator)
    {
        $this->answerRepository = $answerRepository;
        $this->paginator = $paginator;
    }

    /**
     * Create paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface Paginated list
     */
    public function createPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->answerRepository->findAll(),
            $page,
            AnswerRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save answer.
     *
     * @param Answer $answer Answer entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Answer $answer): void
    {
        $this->answerRepository->save($answer);
    }

    /**
     * Delete answer.
     *
     * @param Answer $answer Answer entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Answer $answer): void
    {
        $this->answerRepository->delete($answer);
    }

}
