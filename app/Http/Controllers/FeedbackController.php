<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Database\QueryException;

class FeedbackController extends Controller
{

    public function index()
    {
        $feedbacks = Feedback::all();
        return view('feedback.index', compact('feedbacks'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'feedback' => 'required|string',
                'rating' => 'required|integer|between:1,5',
            ]);


            Feedback::create($request->all());

            return redirect()->route('home')
                ->with('success', 'Feedback added successfully.');
        } catch (QueryException $exception) {
            // Log the error or handle it in a way that makes sense for your application
            return redirect()->route('home')
                ->with('error', 'An error occurred while adding the product.' . $exception->getMessage());
        }
    }


    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}
