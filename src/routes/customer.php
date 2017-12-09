<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/customers', function(Request $request, Response $response){
    try {
        $result = $this->db->select("SELECT * FROM customers");
        return $response->withJson(array(
            "success" => true,
            "data" => $result
        ));
    } catch(Exception $e){
        $error = [
            "success" => false,
            "data" => [
                "error_code" => 60009,
                "message" => $e->getMessage()
            ]
        ];

        return $response->withJson($error);
    }
});

$app->get('/api/customer/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    try {
        $result = $this->db->select("SELECT * FROM customers WHERE id = :id", array('id' => $id));
        return $response->withJson(array(
            "success" => true,
            "data" => $result[0]
        ));
    } catch(Exception $e){
        $error = [
            "success" => false,
            "data" => [
                "error_code" => 60009,
                "message" => $e->getMessage()
            ]
        ];

        return $response->withJson($error);
    }
});

$app->post('/api/customer/add', function(Request $request, Response $response){
    // Validation is sort of important.
    // See whether you will be able to get a validation lib
    // Ideally yoou will want to set the request ..
    // .. Content-Type header to application/json
    $params = $request->getParsedBody();

    try{
        $insertResult = $this->db->insert('customers', $params);
        $result = ($insertResult > 0) ?
            array(
                "success" => true,
                "data" => [
                    "last_id" => $insertResult,
                    "message" => "Successfully added"
                ]
            ) : array(
                "success" => false,
                "data" => [
                    "error_code" => 60008,
                    "message" => "Customer object wasn't added"
                ]
            );

        return $response->withJson($result);
    } catch(Exception $e){
        $error = [
            "success" => false,
            "data" => [
                "error_code" => 60009,
                "message" => $e->getMessage()
            ]
        ];

        return $response->withJson($error);
    }
});

$app->put('/api/customer/{id}/update', function(Request $request, Response $response){
    // Again validation is important ...
    // Setting the Content-Type header variable of the ..
    // .. request is also important ...
    $params = $request->getParsedBody();
    $id = $request->getAttribute('id');

    try{
        $updateResult = $this->db->update('customers', $params, "id = {$id}");
        $result = ($updateResult === true) ?
            array(
                "success" => $updateResult,
                "data" => [
                    "message" => "Updated successfully"
                ]
            ) : array(
                "success" => $updateResult,
                "data" => [
                    "error_code" => 60008,
                    "message" => "Object wasn't updated"
                ]
            );

        return $response->withJson($result);
    } catch(Exception $e){
        $error = [
            "success" => false,
            "data" => [
                "error_code" => 60009,
                "message" => $e->getMessage()
            ]
        ];

        return $response->withJson($error);
    }
});

$app->delete('/api/customer/{id}/delete', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    try{
        $deleteResult = $this->db->delete("customers", "id = {$id}");
        $result = ($deleteResult > 0) ?
            array(
                "success" => true,
                "data" => [
                    "count" => $deleteResult,
                    "message" => "Deleted successfully"
                ]
            ) : array(
                "success" => false,
                "data" => [
                    "error_code" => 60008,
                    "message" => "Object wasn't deleted"
                ]
            );

        return $response->withJson($result);
    } catch(Exception $e){
        $error = [
            "success" => false,
            "data" => [
                "error_code" => 60009,
                "message" => $e->getMessage()
            ]
        ];

        return $response->withJson($error);
    }
});