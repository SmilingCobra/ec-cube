<?php
namespace Customize\Entity;
use Eccube\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="dtb_webdoc_news")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\DiscriminatorMap({"news" = "Customize\Entity\WebdocNews"}) 
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Customize\Repository\WebdocNewsRepository")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class WebdocNews extends AbstractEntity{


    /*
    *bin/console cache:clear --no-warmup
    *bin/console doctrine:schema:update --dump-sql  --complete
    *bin/console doctrine:schema:update --dump-sql --force --complete
    */
    
    
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name = "id", type="integer", options = {"unsigned":true})
     */
    private $id;

    /**
    * @var string
    *
    * @ORM\Column(name = "title", type="string", length = 255)
    *
    */
    private $title;




    
        /**
         * @var \DateTime
         *
         * @ORM\Column(name="create_date", type="datetimetz")
         */
        private $create_date;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="update_date", type="datetimetz")
         */
        private $update_date;


        // ================= Getter / Setter =================

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getCreateDate(): ?\DateTime
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTime $create_date): self
    {
        $this->create_date = $create_date;
        return $this;
    }

    public function getUpdateDate(): ?\DateTime
    {
        return $this->update_date;
    }

    public function setUpdateDate(\DateTime $update_date): self
    {
        $this->update_date = $update_date;
        return $this;
    }
}