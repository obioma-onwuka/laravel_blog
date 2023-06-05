<x-layout>

    <div class="container py-md-5 container--narrow">
        <form action="/create" method="POST">
            @csrf
            <div class="form-group">
                <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
                <input name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="Post Title Here:" autocomplete="off" />
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
                <textarea name="content" id="post-body" class="body-content tall-textarea form-control" type="text"></textarea>
                @error('content')
                    <div class="text-danger" role="alert">
                        <small>
                            {{ $message }}
                        </small>
                    </div>
                @enderror
            </div>

            <button class="btn btn-primary">Save New Post</button>
        </form>
    </div>

</x-layout>