<?php

$app->post('/api/GoogleTasks/getAllTasks', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','tasklist']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['accessToken'=>'access_token','tasklist'=>'tasklist'];
    $optionalParams = ['updatedMin'=>'updatedMin','showHidden'=>'showHidden','showDeleted'=>'showDeleted','showCompleted'=>'showCompleted','pageToken'=>'pageToken','maxResults'=>'maxResults','dueMin'=>'dueMin','dueMax'=>'dueMax','completedMax'=>'completedMax','completedMin'=>'completedMin','fields'=>'fields'];
    $bodyParams = [
       'query' => ['access_token','fields','completedMax','completedMin','dueMax','dueMin','maxResults','pageToken','showCompleted','showDeleted','showHidden','updatedMin']
    ];

    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);


    if(!empty($data['updatedMin']))
    {
        $data['updatedMin'] = \Models\Params::toFormat($data['updatedMin'], 'Y-m-d\TH:i:sP');

    }

    if(!empty($data['dueMin']))
    {
        $data['dueMin'] = \Models\Params::toFormat($data['dueMin'], 'Y-m-d\TH:i:sP');

    }

    if(!empty($data['dueMax']))
    {
        $data['dueMax'] = \Models\Params::toFormat($data['dueMax'], 'Y-m-d\TH:i:sP');

    }

    if(!empty($data['completedMax']))
    {
        $data['completedMax'] = \Models\Params::toFormat($data['completedMax'], 'Y-m-d\TH:i:sP');

    }

    if(!empty($data['completedMin']))
    {
        $data['completedMin'] = \Models\Params::toFormat($data['completedMin'], 'Y-m-d\TH:i:sP');

    }

    if(!empty($data['fields']))
    {
        $data['fields'] = \Models\Params::toString($data['fields'], ',');

    }


    $client = $this->httpClient;
    $query_str = "https://www.googleapis.com/tasks/v1/lists/{$data['tasklists']}/tasks";

    

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $requestParams['headers'] = [];
     

    try {
        $resp = $client->get($query_str, $requestParams);
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