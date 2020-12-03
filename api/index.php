<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../config/db.config.php';

// Custom Classes
require __DIR__.'/lib/Database.php';
require __DIR__.'/classes/ItemController.php';

$app = new \Slim\Slim();

// list the item records
$app->get('/item', function () use ($app) {
    $itemController = new ItemController();

    $input = $app->request->get();

    // sanitize input
    $start = isset($input['start']) ? intval($input['start']) : 0;
    $limit = isset($input['limit']) ? intval($input['limit']) : 10;

    $items = $itemController->list($start, $limit);
    echo json_encode($items);
});

// create a new item record
$app->post('/item', function () use ($app) {
    $itemController = new ItemController();

    // get params
    $input = json_decode($app->request->getBody(), true);

    // sanitize input
    $itemid      = isset($input['itemid'])      ? intval($input['itemid'])    : 0;
    $description = isset($input['description']) ? trim($input['description']) : '';
    $quantity    = isset($input['quantity'])    ? intval($input['quantity'])  : 0;

    // switch on the itemid to determine add or edit
    if ($itemid > 0) {
        $itemid = $itemController->edit($itemid, $description, $quantity);
    } else {
        $itemid = $itemController->add($description, $quantity);
    }

    echo json_encode([
        'itemid' => $itemid
    ]);
});

// delete an item record
$app->delete('/item/:itemid', function($itemid) {
    $itemController = new ItemController();

    return $itemController->delete($itemid);
});

$app->run();
