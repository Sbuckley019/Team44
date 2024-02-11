@include('includes.navigation')

@if(isset($feedbacks) && count($feedbacks)>0)
<div class="feedbackContainer">
    <div class="feedbackBar">
        <div class="w-85">User Feedback</div>
        <form method="GET" action="{{ route('feedback.index') }}">
            @csrf
            <select name="viewChoice" onchange="this.form.submit()" class="form-select">
                <option value="0" {{ $viewChoice == '0' ? 'selected' : '' }}>Unread</option>
                <option value="1" {{ $viewChoice == '1' ? 'selected' : '' }}>Read</option>
            </select>
        </form>
    </div>
    @foreach($feedbacks as $feedback)
    <div class="feedbackEntry">
        <div class="w-90">
            <div class="feedbackText">{{$feedback->feedback}} -{{{$feedback->name}}}</div>
            <div class="feedbackRating">
                <div class="stars" style="--rating: {{($feedback->rating)/5 * 100}}%"></div>
                <div class="feedbackEmail">{{$feedback->email}}</div>
            </div>
        </div>
        <div class="feedbackReadButton">
            <form method="POST" action="{{route('feedback.read',['feedbackId'=>$feedback->id])}}">
                @csrf
                <button type="submit" class="readButton {{ $feedback->read == 0 ? 'empty' : 'full' }}"></button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div>There is no feedback to review</div>
@endif