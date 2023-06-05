<x-layout>

    <div class="container py-md-5 container--narrow">
        <form action="/post/edit/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
                <input required name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" value = "{{old('title', $post->title)}}" />
                @error('title')
                    <div class="text-danger" role="alert">
                        <small>
                            {{ $message }}
                        </small>
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
                <textarea required name="content" id="post-body" class="body-content tall-textarea form-control" type="text">{{old('content', $post->content)}}</textarea>
                @error('content')
                    <div class="text-danger" role="alert">
                        <small>
                            {{ $message }}
                        </small>
                    </div>
                @enderror
            </div>

            <button class="btn btn-primary">Submit</button>
        </form>
    </div>

</x-layout>