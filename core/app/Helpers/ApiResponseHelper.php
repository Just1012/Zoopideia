<?php

if (!function_exists('apiResponse')) {
    function apiResponse($result)
    {
        return response()->json(array_filter([
            'success' => $result['status'] < 400,
            'message' => $result['message'],
            'errors' => $result['errors'] ?? null,
            'error' => $result['error'] ?? null,
            'data' => $result['data'] ?? null,
        ]), $result['status']);
    }
}


if (!function_exists('viewResponse')) {
    function viewResponse($result, callable $callback = null)
    {
        // Check if the request is an AJAX request (for API responses)
        if (request()->ajax()) {
            return response()->json($result, $result['status']);
        }

        // Handle success cases where the status is below 400
        if ($result['status'] < 400) {
            // If a callback is provided, execute it
            if (is_callable($callback)) {
                return $callback();
            }
            // Redirect back with a success message if no callback is provided
            return redirect()->back()->with('doneMessage', __('backend.addDone'));
        }

        // Handle validation or other errors
        if (!empty($result['errors'])) {
            return redirect()->back()->withErrors($result['errors'])->withInput();
        }

        // Handle general errors
        return redirect()->back()->with('errorMessage', __('backend.error'))->withInput();
    }
}
