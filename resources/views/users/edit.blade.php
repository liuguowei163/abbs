@extends('layouts.app')

@section('title', '编辑个人页面')

@section('content')
<div class="container">
	<div class="panel panel-default col-md-10 col-offset-1">
		<div class="panel-heading">
			<h4>
				<i class="glyphicon glyphicon-edit">编辑个人资料</i>
			</h4>
		</div>
		@include('common.error')
		<div class="panel-body">
			<form action="{{ route('users.update', $user->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="name-field">用户名</label>
					<input type="text" name="name" id="name-field" class="form-control" value="{{ old('name', $user->name) }}">
				</div>
				<div class="form-group">
					<label for="email-field">邮箱</label>
					<input type="text" name="email" class="form-control" id="email-field" value="{{ old('email', $user->email) }}">
				</div>
				<div class="form-group">
					<label for="introduction-field">个人简介</label>
					<textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
				</div>
				<div class="form-group">
					<label for="" class="aratar-label">用户头像</label>
					<input type="file" name="avatar">

					@if($user->avatar)
						<br>
						<img src="{{ $user->avatar }}" class="thumbnail img-responsive" width="200">
					@endif

				</div>
				<div class="well well-sm">
					<button type="submit" class="btn btn-primary">保存</button>
				</div>

			</form>
		</div>
	</div>
</div>

@endsection