<?php

namespace src\controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;
use src\models\Model_Additional_services_for_orders;
use src\exceptions\ValidateException;

/**
 * Class OrderController
 * @package src\controllers
 */
class OrderController
{
    private $view;
    private $additionalServicesForOrders;

    /**
     * OrderController constructor.
     * @param \Slim\Container $c
     */
    public function __construct(\Slim\Container $c)
    {
        $this->view = $c['view'];
        $this->additionalServicesForOrders = $c['additional_services_for_orders'];
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     * @throws \ErrorException
     */
    public function create(Request $request, Response $response, $args)
    {
        $orders = [];
        $errors = [
            'status'   => null,
            'messages' => []
        ];

        $addServices = R::findAll('additional_services_dictionary'); //todo di

        if ($request->isPost()) {
            $post = $request->getParsedBody();

            try {
                $coords_from = \src\services\GeoService::getCoordsByAddress($post['orders']['from']);
                $coords_destination = \src\services\GeoService::getCoordsByAddress($post['orders']['destination']);

            } catch (ErrorException $e) {
                $coords_from = null;
                $coords_destination = null;
                //e.g. sending to log file
            }

            R::begin();
            try {
                $dataProvider = $post;
                $dataProvider['orders']['_type'] = 'orders';
                $dataProvider['geo_coordinates']['_type'] = 'geo_coordinates';

                $order = R::dispense($dataProvider['orders']);
                $geoCoordinates = R::xdispense('geo_coordinates');

                $geoCoordinates->coords_from = $coords_from;
                $geoCoordinates->coords_destination = $coords_destination;

                $orderID = R::store($order);
                $geoCoordinates->order_id = $orderID;

                $this->additionalServicesForOrders->saveServicesForOrders($dataProvider['add_services'], $orderID);

                $geoCoordinatesID = R::store($geoCoordinates);

                R::commit();
                $errors['status'] = 'success'; //todo fix magic value
                $errors['messages'] = 'Ваша заявка принята!';
                $post = [];

            } catch (ValidateException $e) {
                $errors['status'] = 'error';
                $errors['messages'] = unserialize($e->getMessage());
            } catch (\Exception $e) {
                R::rollback();
                $errors['status'] = 'error';
                $msg = (DEBUG) ? $e->getMessage() : 'На сервере что-то пошло не так, попробуйте еще раз';
                array_push($errors['messages'], $msg);
            } catch (\Error $e) {
                R::rollback();
                $errors['status'] = 'error';
                $msg = (DEBUG) ? $e->getMessage() : 'На сервере что-то пошло не так, попробуйте еще раз';
                array_push($errors['messages'], $msg);
            }
        }

        R::close();

        return $this->view->render($response, 'order/create.php', [
            'orders'          => $post['orders'],
            'addServicesData' => $addServices,
            'errors'          => $errors
        ]);

    }
}