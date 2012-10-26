<?php

namespace Shiroyuki\Bundle\RouteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Route Controller
 *
 * Use to generate the lookup function for the client side.
 *
 * @author Juti Noppornpitak <jnopporn@shiroyuki.com>
 */
class RouteController extends Controller
{
    /**
     * Generate the JavaScript code for the offline router.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function offlineRouterAction()
    {
        if ($this->container->has('profiler')) {
            $this->container->get('profiler')->disable();
        }

        $rawRoutes = $this
            ->get('router')
            ->getRouteCollection()
            ->all();

        $routes = array();

        foreach ($rawRoutes as $id => $route) {
            $pattern = $route->getPattern();
            $matches = array();

            preg_match_all('/{(\w+)}/', $pattern, $matches);

            $parameters = $matches[1];

            $routes[$id] = array(
                'pattern'    => $pattern,
                'parameters' => $parameters
            );
        }

        $routesInJson = json_encode($routes);

        $response = $this->render(
            'ShiroyukiRouteBundle:Route:offlineRouter.js.twig',
            array('route_table' => $routesInJson)
        );

        $response
            ->headers
            ->set('content_type', 'text/javascript');

        return $response;
    }
}
