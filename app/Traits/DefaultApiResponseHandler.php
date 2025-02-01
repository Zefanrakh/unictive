<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;

trait DefaultApiResponseHandler
{
    /**
     * Handle API response and redirect based on the response status.
     *
     * @param mixed $response
     * @param string $successRoute
     * @param string|null $defaultMessage
     * @return RedirectResponse
     */
    public function handleApiRedirect($response, $successRoute, $defaultMessage = 'An error occurred.'): RedirectResponse
    {
        if ($response->status() === 201 || $response->status() === 200) {
            return redirect()->route($successRoute)->with('message', [
                'type' => 'success',
                'content' => $response->getData()->message ?? 'Operation successful!',
            ]);
        }

        $errorMessage = $response->getData()->message ?? $defaultMessage;

        return back()->with('message', [
            'type' => 'error',
            'content' => $errorMessage,
        ]);
    }

    public function handleApiErrorRedirect(String $errorMessage = null)
    {
        return back()->with('message', [
            'type' => 'error',
            'content' => $errorMessage ?? 'An unexpected error occurred.',
        ]);
    }
}
