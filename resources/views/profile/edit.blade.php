@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="card d-flex">
            <div class="col-6 p-5 d-flex align-items-center">
                <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ Auth::user()->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ Auth::user()->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="fomr-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    <div>
                        <input type="submit" value="Update" class="btn btn-primary w-md">
                    </div>
                </form>
                <div class="col-6 rounded-1 rounded-start overflow-hidden" style="height: 320px">
                    <img src="/storage/{{ Auth::user()->avatar ?? 'Sample_User_Icon.png'}}" alt="" width="100%" height="100%" style="object-fit: cover; object-position: 15% 100%; " id="browse" class="browse">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script src="{{ asset('js/jquery.js') }}"></script>

<script>
    $(document).on("click", "#browse", function() {
        var file = $(this)
        .parent()
        .parent()
        .parent()
        .find("#avatar");
        file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
        var reader = new FileReader();
		reader.onload = function(e) {
			// get loaded data and render thumbnail.
			document.getElementById("browse").src = e.target.result;
		};
		// read the image file as a data URL.
		reader.readAsDataURL(this.files[0]);
		});
</script>
@endsection