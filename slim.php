<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim(['debug' => true]);

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
// echo $settingValue = $app->config('templates.path');
// GET route
$app->get(
    '/',
    function () {
        echo 'Hello Slim';
    }
);
$app->get('/hello/:name', function ($name=null) {
    echo "Hello, $name";
});
// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);
/*
$ curl http://www.vhallapp.com/slim.php/books
[{"id":"1","title":"Three Musketeers","author":"Alexander Dumas","summary":"Thre
e Musketeers"},{"id":"2","title":"Meditations","author":"Marcus","summary":"Medi
tations"}]
vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (appapi)
$ curl -X POST -d '{"title":"php","author":"phper","summary":"php7"}' http://ww
w.vhallapp.com/slim.php/book
{"id":null}
vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (appapi)
$ curl -X POST -d 'title=php&author=phper&summary=php7' http://www.vhallapp.com
/slim.php/book
{"id":"3"}
vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (appapi)
$ curl -X PUT -d 'title=php7' http://www.vhallapp.com/slim.php/book/3
{"status":true,"message":"Book updated successfully"}
vhalllsp@VHALLLSP-PC /d/soft/wamp/www/laravel_web (appapi)
$ curl -X DELETE http://www.vhallapp.com/slim.php/book/3
{"status":true,"message":"Book deleted successfully"}
 */
// https://github.com/phpmasterdotcom/WritingARESTfulWebServiceWithSlim/blob/master/public/index.php
include "notorm/NotORM.php";
$pdo = new PDO("mysql:dbname=software",'root','');
$db = new NotORM($pdo);
$app->get("/books", function () use ($app, $db) {
    $books = array();
    foreach ($db->books() as $book) {
        $books[]  = array(
            "id" => $book["id"],
            "title" => $book["title"],
            "author" => $book["author"],
            "summary" => $book["summary"]
        );
    }
    $app->response()->header("Content-Type", "application/json");
    echo json_encode($books);
});
$app->get("/book/:id", function ($id) use ($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $book = $db->books()->where("id", $id);
    if ($data = $book->fetch()) {
        echo json_encode(array(
            "id" => $data["id"],
            "title" => $data["title"],
            "author" => $data["author"],
            "summary" => $data["summary"]
            ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Book ID $id does not exist"
            ));
    }
});
$app->post("/book", function () use($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $book = $app->request()->post();
    $result = $db->books->insert($book);
    echo json_encode(array("id" => $result["id"]));
});
$app->put("/book/:id", function ($id) use ($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $book = $db->books()->where("id", $id);
    if ($book->fetch()) {
        $post = $app->request()->put();
        $result = $book->update($post);
        echo json_encode(array(
            "status" => (bool)$result,
            "message" => "Book updated successfully"
            ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Book id $id does not exist"
        ));
    }
});
$app->delete("/book/:id", function ($id) use($app, $db) {
    $app->response()->header("Content-Type", "application/json");
    $book = $db->books()->where("id", $id);
    if ($book->fetch()) {
        $result = $book->delete();
        echo json_encode(array(
            "status" => true,
            "message" => "Book deleted successfully"
        ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Book id $id does not exist"
        ));
    }
});
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */

$app->run();

    // 此时再打开浏览器输入localhost将只能看到以下内容，其实浏览器使用get方法，在slim的Get路由中输出了Hello Slim。
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);