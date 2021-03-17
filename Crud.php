<?php
    use Doctrine\ORM\Tools\Pagination\Paginator;
    require_once('src/Number.php');

    class Crud {
        private $entityManager;

        const PER_PAGE = 5;
        const ENTITY_NAME = "Number";
        const ENTITY_PATH = __DIR__."/src/".self::ENTITY_NAME;
        const ENTITY_ALIAS = "src\Number";

        public function __construct($entityManager) {
            $this->entityManager = $entityManager;
        }

        public function createNumber($slug, $title, $number, $text, $transcription) {
            $numberEntity = new Number();
            $numberEntity->setSlug($slug);
            $numberEntity->setTitle($title);
            $numberEntity->setNumber($number);
            $numberEntity->setText($text);
            $numberEntity->setTranscription($transcription);
            $numberEntity->setDate(new DateTime());
            $this->entityManager->persist($numberEntity);
            $this->entityManager->flush();
        }

        public function readNumber($id) {
            $number = $this->entityManager->find('Number', $id);

            return $number;

        }

        public function findNumbers($slug = null, $title = null, $text = null, $transcription = null, $date = null) {

        }

        public function readAllNumbers() {
            $numberRepository = $this->entityManager->getRepository('Number');
            $numbers = $numberRepository->findAll();

            return $numbers;
        }

        public function readNumbersPaginate($page = 1) {               
            $dql = 'SELECT n FROM '.self::ENTITY_NAME; 

            $query = $this->entityManager->createQuery($dql)
                ->setFirstResult(0)
                ->setMaxResults(self::PER_PAGE);    

            $data = $query->getResult();
            
            var_dump($data);
            die;

            $paginator = new Paginator($query);


            //var_dump($paginator);
            //die;

            foreach ($paginator as $data) {
                var_dump($data);
            }

            vard_dump($paginator);
            die;
        }

        public function updateNumber($slug, $title, $text, $transcription) {

        }

        public function deleteNumber($id) {
            $number = $this->readNumber($id);
            $this->entityManager->remove($number);
            $this->entityManager->flush();
        }
    }