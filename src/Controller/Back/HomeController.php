<?php

    namespace App\Controller\Back;

    use App\Controller\AbstractController;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * Class HomeController
     * @package App\Controller\Back
     *
     * @Route("/backoffice")
     */
    class HomeController extends AbstractController
    {
        /**
         * @Route("/", name="bo_index")
         *
         * @param Request $request
         *
         * @return Response
         */
        public function index(Request $request): Response
        {
            die('Index BO');
        }
    }
?>