<?php
    use Doctrine\ORM\Tools\Pagination\Paginator;
    require_once('src/Number.php');

    /**
     * Class to handle main actions(CRUD) of web app
     */
    class Crud {
        //Object for manage doctrine entities
        private $entityManager;

        const PER_PAGE = 5; // Const for paginations(items per page)
        const ENTITY_NAME = "Number"; // NAme of entity this controller handle
        const ENTITY_PATH = __DIR__."/src/".self::ENTITY_NAME; // PAth to entity file
        const ENTITY_ALIAS = "src\Number"; // Alias for entity

        /**
         * Method for creating of class
         * 
         * Takes entyty manager instance to work with doctrine
         * entity manager instance is generated inside bootstrap file
         * 
         * @param entityManager
         */
        public function __construct($entityManager) {
            $this->entityManager = $entityManager;
        }

        /**
         * Adds new number
         * 
         * @param string slug
         * @param string title
         * @param int number
         * @param string text
         * @param string transcription
         * 
         * @return bool
         */
        public function createNumber(string $slug, string $title, int $number, string $text, string $transcription):bool {
            $numberEntity = new Number();
            $numberEntity->setSlug($slug);
            $numberEntity->setTitle($title);
            $numberEntity->setNumber($number);
            $numberEntity->setText($text);
            $numberEntity->setTranscription($transcription);
            $numberEntity->setDate(new DateTime());
            $this->entityManager->persist($numberEntity);
            $this->entityManager->flush();

            return true;
        }

        /**
         * Read number data
         * 
         * @param int id
         * 
         * @return object
         */
        public function readNumber(int $id):object {
            $number = $this->entityManager->find('Number', $id);

            return $number;
        }

        /**
         * Search numbers
         * 
         * @param slug
         * @param title
         * @param text
         * @param transcription
         * @param date
         */
        public function findNumbers($slug = null, $title = null, $text = null, $transcription = null, $date = null) {}

        /**
         * Read all numbers
         * 
         * @return object
         */
        public function readAllNumbers():object {
            $numberRepository = $this->entityManager->getRepository('Number');
            $numbers = $numberRepository->findAll();

            return $numbers;
        }

        /**
         * Reads numbers paginated
         * 
         * @param int page
         * 
         * @return array
         */
        public function readNumbersPaginate(int $page = 1):array {               
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

        /**
         * Reads number with seted filters and sortings parametters without pagination
         * 
         * @param int page
         * @param array filters
         * @param array sortings
         * 
         * @return array
         */
        public function readNumbersWithFilterAndSortings(int $page = 1, array $filters = [], array $sortings = []):array { 
            $numbers =  $this->entityManager->getRepository(Number::class)->findBy($filters, $sortings);

            $result = [
                'page' => 1,
                'data' => $numbers,
                'pages' => 1
            ];

            return $result;
        }

        /**
         * Read numbers with pagination, sorting and filtering
         * 
         * @param int page
         * @param array filters
         * @param array sortings
         * 
         * @return array
         */
        public function readNumbers($page = 1, $filters = [], $sortings = []) {               
            // get the user repository
            $numbers =  $this->entityManager->getRepository(Number::class);

            // build the query for the doctrine paginator
            $query = $numbers->createQueryBuilder('n');

            //Adding searching parametters
            if(!empty($filters['slug'])) {
                $query = $query->andWhere('n.slug like :slug');
            }
            if(!empty($filters['title'])) {
                $query = $query->andWhere('n.title like :title');
            }
            if(!empty($filters['number'])) {
                $query = $query->andWhere('n.number like :number');
            }
            if(!empty($filters['text'])) {
                $query = $query->andWhere('n.text like :text');
            }
            if(!empty($filters['transcription'])) {
                $query = $query->andWhere('n.transcription like :transcription');
            }

            //setting parametters for query
            if(!empty($filters['slug'])) {
                $query = $query->setParameter('slug', $filters['slug']);
            } if(!empty($filters['title'])) {
                $query = $query->setParameter('title', $filters['title']);
            } if(!empty($filters['number'])) {
                $query = $query->setParameter('number', $filters['number']);
            } if(!empty($filters['text'])) {
                $query = $query->setParameter('text', $filters['text']);
            } if(!empty($filters['transcription'])) {
                $query = $query->setParameter('transcription', $filters['transcription']);
            }


            $query = $query->getQuery();

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

        /**
         * Update number
         * 
         * @param int id
         * @param string slug 
         * @param string title
         * @param int number 
         * @param string text 
         * @param string transcription
         * 
         * @return bool 
         */
        public function updateNumber(int $id, string $slug, string $title, int $number, string $text, string $transcription):bool {
            $numberEntity = $this->entityManager->find('Number', $id);

            $numberEntity->setSlug($slug);
            $numberEntity->setTitle($title);
            $numberEntity->setNumber($number);
            $numberEntity->setText($text);
            $numberEntity->setTranscription($transcription);
            $this->entityManager->persist($numberEntity);
            $this->entityManager->flush();

            return true;
        }

        /**
         * Delete number
         * 
         * @param int id
         * 
         * @return bool
         */
        public function deleteNumber(int $id):bool {
            $number = $this->readNumber($id);
            $this->entityManager->remove($number);
            $this->entityManager->flush();

            return true;
        }
    }