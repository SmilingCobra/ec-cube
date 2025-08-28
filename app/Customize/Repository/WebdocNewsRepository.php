<?php
namespace Customize\Repository;

use Customize\Entity\WebdocNews;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class WebdocNewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebdocNews::class);
    }

    /**
     * 一覧取得
     * @return WebdocNews[]
     */
    public function findAllNews(): array
    {
        return $this->createQueryBuilder('n')
            ->orderBy('n.create_date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * IDで取得
     * @param int $id
     * @return WebdocNews|null
     */
    public function findById(int $id): ?WebdocNews
    {
        return $this->find($id);
    }

    /**
     * 新規追加
     * @param WebdocNews $news
     */
    public function add(WebdocNews $news): void
    {
        $em = $this->getEntityManager();
        $news->setCreateDate(new \DateTime());
        $news->setUpdateDate(new \DateTime());
        $em->persist($news);
        $em->flush();
    }

    /**
     * 更新
     * @param WebdocNews $news
     */
    public function update(WebdocNews $news): void
    {
        $em = $this->getEntityManager();
        $news->setUpdateDate(new \DateTime());
        $em->persist($news);
        $em->flush();
    }

    /**
     * 削除
     * @param WebdocNews $news
     */
    public function delete(WebdocNews $news): void
    {
        $em = $this->getEntityManager();
        $em->remove($news);
        $em->flush();
    }
}
