@extends('layouts.index')
@section('content')
<div class="row" id="changePassword">
	<div class="col-12">
		<div class="container col-lg-8">
			<div class="card">
				<div class="p-5 align-items-center">
					<h3 class="mb-5">Change Password</h3>
					@if (session('success'))
						<div class="alert alert-success" role="alert">
							{{ session('success') }}
						</div>
					@elseif (session('error'))
						<div class="alert alert-danger" role="alert">
							{{ session('error') }}
						</div>
					@endif
					<form action="changepassword/change" method="POST">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="current_password">Current Password</label>
							<input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" value="{{ old('current_password') }}">
							@error('current_password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="password">New Password</label>
							<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="password_confirmation">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="">
						</div>
						<div class="">
							<input type="submit" value="Change" class="btn btn-primary w-md">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
