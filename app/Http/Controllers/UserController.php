<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function downloadId()
    {
        $user = Auth::user();
        $id = $user->custom_id;
        $fileName = 'user-id.txt';
        $fileContent = "User ID: $id";

        return response()->stream(
            function () use ($fileContent) {
                echo $fileContent;
            },
            200,
            [
                'Content-Type' => 'text/plain',
                'Content-Disposition' => "attachment; filename=\"$fileName\"",
            ]
        );
    }
}
