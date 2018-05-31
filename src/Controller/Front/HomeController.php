<?php

    namespace App\Controller\Front;

    use App\Controller\AbstractController;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * Class HomeController
     * @package App\Controller\Front
     */
    class HomeController extends AbstractController
    {
        /**
         * @Route("/", name="app_index")
         *
         * @param Request $request
         *
         * @return Response
         */
        public function index(Request $request): Response
        {
            die('Index App');
        }
    }
?>