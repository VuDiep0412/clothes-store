@extends('frontend.layouts.main')

@section('content')
<div class="header" style="text-align: center;">
	<h3><b>Đăng nhập</b></h3>
	<br><br>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-4 col-md-4" style="margin-left: 400px;">
			<form action="{{route('checkLogin')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label><b>Email *</b></label>
					<input type="text" name="email" id="email" class="form-control">
					<span class="form-message" style="color: red;">{{ $errors->first('email') }}</span>
				</div>
				<div class="form-group">
					<label><b>Mật khẩu *</b></label>
					<input type="password" name="password" id="password" class="form-control">
					<span class="form-message" style="color: red;">{{ $errors->first('password') }}</span>
				</div>
				@if (session('msg'))
				<div class="form-group has-feedback"><a href="#" style="color: red">{{ session('msg') }}</a></div>
				@endif
				<div class="form-group">
					<button type="submit" name="submit" class="form-control btn btn-primary">Đăng nhập</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection