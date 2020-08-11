<?php

namespace App\Support\Response;

use Request;
use Symfony\Component\HttpFoundation\Response;
use URL;

trait GeneralResponseTrait
{
    /**
     * @param string      $message
     * @param string|null $route
     * @param array       $params
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function success(string $message = '', string $route = null, array $params = []) : Response
    {
        return $this->successfulResponse($message, $route, $params);
    }

    /**
     * @param string      $message
     * @param string|null $route
     * @param array       $params
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function warning(string $message = '', string $route = null, array $params = []) : Response
    {
        return $this->successfulResponse($message, $route, $params, 'warning');
    }

    /**
     * @param string      $message
     * @param string|null $route
     * @param array       $params
     * @param string      $dataKey
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function successfulResponse(
        string $message = '',
        string $route = null,
        array $params = [],
        string $dataKey = 'success'
    ) : Response {
        if (Request::ajax() || Request::wantsJson()) {
            return response()->json([
                'message' => $message,
                'data'    => $params
            ]);
        }
        $redirect = redirect()->to($route === null ? URL::previous() : $route);
        if ($message) {
            $redirect = $redirect->with($dataKey, $message);
        }
        foreach ($params as $key => $value) {
            $redirect = $redirect->with($key, $value);
        }

        return $redirect;
    }

    /**
     * @param array|string $messages
     * @param string|null  $route
     * @param array        $params
     * @param array|null   $exceptInput
     * @param int          $statusCode
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function error(
        $messages = [],
        string $route = null,
        array $params = [],
        array $exceptInput = null,
        int $statusCode = 400
    ) : Response {
        $messages = (array) $messages;
        if ($exceptInput === null) {
            $exceptInput = ['password', 'password_confirmation'];
        }
        if (Request::ajax() || Request::wantsJson()) {
            return response()->json([
                'message' => array_first($messages),
                'data'    => $params
            ], $statusCode);
        }
        $redirect = redirect()->to($route === null ? URL::previous() : $route)
                ->withErrors($messages)
                ->withInput(Request::except($exceptInput));
        foreach ($params as $key => $value) {
            $redirect = $redirect->with($key, $value);
        }

        return $redirect;
    }
}
