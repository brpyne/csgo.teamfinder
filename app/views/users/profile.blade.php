@extends('layouts.master')
@section('content')
<div class="row">

	<div class="jumbotron col-md-8 col-md-offset-2">
		<h1>{{ $user->username }}</h1>
			@if($user->bio)
				<p>{{{ $user->bio }}}</p>
			@endif
	</div>

	<div class="well col-md-6 col-md-offset-3">

		<div class="col-md-6">
			<h3>Services:</h3>
			@if($user->steam || $user->esea || $user->leetway || $user->altpug)
			<table class="table table-condensed">
				@if($user->steam)
					<p>
						<a href="{{ $user->steam }}"><img src="{{ asset('/img/ext_services/steam_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
				@if($user->esea)
					<p>
						<a href="{{ $user->esea }}"><img src="{{ asset('/img/ext_services/esea_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
				@if($user->leetway)
					<p>
						<a href="{{ $user->leetway }}"><img src="{{ asset('/img/ext_services/leetway_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
				@if($user->altpug)
					<p>
						<a href="{{ $user->altpug }}"><img src="{{ asset('/img/ext_services/altpug_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
			</table>
			@else
				<p>This user doesn't use any third-party services.</p>
			@endif
		</div>
		<div class="col-md-6">
			<h3>Info:</h3>
			<table class="table table-condensed">
				<tr>
					<td>Rating</td>
					<td>
						@if($user->rating >= 0)
							<span class="good">{{ $user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
						@else
							<span class="bad">{{ $user->rating }} <span class="glyphicon glyphicon-thumbs-down"></span></span>
						@endif
					</td>
				</tr>
				@if($user->birthday)
				<tr>
					<td>Age</td>
					<td>{{ date("Y-m-d")-date($user->birthday) }}</td>
				</tr>
				@endif
				@if($user->region)
				<tr>
					<td>Region</td>
					<td>{{ $user->region->name }}</td>
				</tr>
				@endif
				@if($user->skill)
				<tr>
					<td>Skill</td>
					<td>{{ $user->skill->name }}</td>
				</tr>
				@endif
				@if($user->rank)
				<tr>
					<td>Rank</td>
					<td>{{ $user->rank->name }}</td>
				</tr>
				@endif
				@if($user->voips)
				<tr>
					<td>Voip Services</td>
					<td>
					@foreach ($user->voips as $voip)
						<p>{{ $voip->name }}</p>
					@endforeach
					</td>
				</tr>
				@endif
			</table>
		</div>
	</div>

	@yield('post')

	@if($user->experience)
		<div class="col-md-8 well col-md-offset-2">
			<h3>Experience</h3>
			<p>{{{ $user->experience }}}</p>
		</div>
	@endif


	<div class="well col-md-8 col-md-offset-2">
		<div class="col-md-12" id="ratings">
			<h3>Reviews <a href="{{ action('UserController@getReview', [$user->id]) }}" class="btn btn-default pull-right">Leave a Review</a></h3>
			@if($ratings)
				<table class="table">
					<thead>
						<tr>
							<td>Author</td>
							<td>Review</td>
							<td>Rating</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($ratings as $rating)
						<tr>
							<td><a href="{{ action('UserController@show', [User::find($rating->author_id)->id]) }}">{{ User::find($rating->author_id)->username }}</a> </td>
							<td>{{{ $rating->review }}}</td>
							<td>
								@if ($rating->score == 1)
								<span class="glyphicon glyphicon-thumbs-up good"></span>
								@else
								<span class="glyphicon glyphicon-thumbs-down bad"></span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p>This user hasn't been reviewed yet</p>
			@endif
		</div>
	</div>
</div>


@stop
