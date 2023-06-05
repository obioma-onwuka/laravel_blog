
<x-layout>

    <div class="container py-md-5 container--narrow">
        <form action="/profile-upload" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="post-title" class="text-muted mb-1"><small>Select Avatar:</small></label>
                <input name="user-image" class="form-control form-control-lg" type="file" placeholder="Select Image" />
                @error('user-image')
                    <div class="text-danger" role="alert">
                        <small>
                            {{ $message }}
                        </small>
                    </div>
                @enderror
            </div>


            <button class="btn btn-dark">Upload</button>
        </form>
    </div>

</x-layout>