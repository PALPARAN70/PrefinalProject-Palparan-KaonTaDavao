<?php

namespace App\Http\Controllers;

use App\Models\User;

class ReviewerController extends Controller
{
    public function show(User $user)
    {
        $user->load([
            'reviews' => function ($query) {
                $query->orderByDesc('created_at')->orderByDesc('id')->with('eatery');
            },
        ]);

        return view('reviewers.show', ['user' => $user]);
    }
}