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
            // get the user repository
            $numbers =  $this->entityManager->getRepository(Number::class);

            // build the query for the doctrine paginator
            $query = $numbers->createQueryBuilder('n')
                ->getQuery();

            //set page size
            $pageSize = self::PER_PAGE;

            // load doctrine Paginator
            $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

            // you can get total items
            $totalItems = count($paginator);

            // get total pages
            $pagesCount = ceil($totalItems / $pageSize);

            // now get one page's items:
            $paginator
                ->getQuery()
                ->setFirstResult($pageSize * ($page-1)) // set the offset
                ->setMaxResults($pageSize); // set the limit

            $result = [
                'page' => $page,
                'data' => $paginator,
                'pages' => $pagesCount
            ];

            return $result;
        }

        public function readNumbersWithFilterAndSortings($page = 1, $filters = [], $sortings = []) { 
            $numbers =  $this->entityManager->getRepository(Number::class)->findBy($filters, $sortings);

            $result = [
                'page' => 1,
                'data' => $numbers,
                'pages' => 1
            ];

            return $result;
        }

        public function readNumbers($page = 1, $filters = [], $sortings = []) {               
            // get the user repository
            $numbers =  $this->entityManager->getRepository(Number::class)->findBy($filters, $sortings);

            /*// build the query for the doctrine paginator
            $query = $numbers->createQueryBuilder('n')
                ->getQuery();

            //set page size
            $pageSize = self::PER_PAGE;

            // load doctrine Paginator
            $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($query);

            // you can get total items
            $totalItems = count($paginator);

            // get total pages
            $pagesCount = ceil($totalItems / $pageSize);

            // now get one page's items:
            $paginator
                ->getQuery()
                ->setFirstResult($pageSize * ($page-1)) // set the offset
                ->setMaxResults($pageSize); // set the limit*/

            $result = [
                'page' => 1, //$page,
                //'data' => $paginator,
                'data' => $numbers,
                'pages' => 1//$pagesCount
            ];

            return $result;
        }

        public function updateNumber($slug, $title, $text, $transcription) {

        }

        public function deleteNumber($id) {
            $number = $this->readNumber($id);
            $this->entityManager->remove($number);
            $this->entityManager->flush();
        }
    }