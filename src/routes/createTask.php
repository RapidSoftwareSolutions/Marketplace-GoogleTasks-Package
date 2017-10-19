<?php

$app->post('/api/GoogleTasks/createTask', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','tasklistId']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['accessToken'=>'access_token','tasklistId'=>'tasklistId'];
    $optionalParams = ['links'=>'links','hidden'=>'hidden','completed'=>'completed','completed'=>'completed','due'=>'due','status'=>'status','notes'=>'notes','position'=>'position','parent'=>'parent','selfLink'=>'selfLink','updated'=>'updated','title'=>'title','etag'=>'etag','id'=>'id','kind'=>'kind','parent'=>'parent','previous'=>'previous','fields'=>'fields'];
    $bodyParams = [
       'query' => ['access_token','fields','parent','previous'],
       'json' => ['id','kind','etag','title','updated','selfLink','parent','position','notes','status','due','completed','deleted','hidden','links']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);

    if(!empty($data['completed']))
    {
        $data['completed'] = \Models\Params::toFormat($data['completed'], 'Y-m-d\TH:i:sP');
    }


    if(!empty($data['due']))
    {
       $data['due'] = \Models\Params::toFormat($data['due'], 'Y-m-d\TH:i:sP');
    }

    if(!empty($data['updated']))
    {
        $data['updated'] = \Models\Params::toFormat($data['updated'], 'Y-m-d\TH:i:sP');
    }

    if(!empty($data['fields']))
    {
        $data['fields'] = \Models\Params::toString($data['fields'], ',');
    }



    $client = $this->httpClient;
    $query_str = "https://www.googleapis.com/tasks/v1/lists/{$data['tasklistId']}/tasks";

    

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = [];
     

    try {
        $resp = $client->post($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});