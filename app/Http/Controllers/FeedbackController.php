<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Database\QueryException;

class FeedbackController extends Controller
{

    public function index(Request $request)
    {
        $viewChoice = $request->query('viewChoice', '0');

        $feedbacks = Feedback::where('read', $viewChoice)->get();

        //return view('admin.feedback', compact('feedbacks', 'viewChoice'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'feedback' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);


        try {
            Feedback::create($validated);
            return redirect()->route('home')->with('success', 'Feedback submitted successfully!');
        } catch (QueryException $exception) {

            return redirect()->back()->with('error', 'An error occurred while submitting your feedback. Please try again.');
        }
    }

    public function read(Request $request)
    {
        $feedbackId = $request->feedbackId;

        // Find the feedback by ID
        $feedback = Feedback::findOrFail($feedbackId);

        // Toggle the "read" status
        $feedback->read = !$feedback->read;
        $feedback->save();

        return redirect()->route('feedback.index')->with('success', 'Feedback has been marked as read');
    }


    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}
