<form action="{{ route('reply') }}" method="post">
    @csrf

    <input type="hidden" name="contact_id" value="{{ $contact->contact_id }}">

    <div class="form-group">
        <label for="reply_message">Feedback Content</label>
        <textarea class="form-control" name="reply_message" id="reply_message" rows="5"></textarea>
        @error('reply_message')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Send</button>
</form>
