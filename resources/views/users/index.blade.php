@extends('template.private')


@section('component')
	<h1> @lang('users.title') </h1>
	<hr>
	@include('errors.list')
	<a class="btn btn-primary" aria-label="@lang('template.create')" href="{{ route('users.create') }}">@lang('users.createnew')</a>
	@if($users)
	<table class="table" id="table-format" data-toggle="table">
	    <thead>
	    <tr>
	        <th data-field="id" data-align="center">#</th>
	        <th data-field="username" data-align="center">
	       		@lang('users.username')
	        </th>
	        <th data-field="displayname" data-align="left">
	        	@lang('users.displayname')
	        </th>
	        <th data-field="created_at" data-align="left">
	        	@lang('users.created')
	        </th>
	        <th data-align="left">@lang('template.actions') </th>

	    </tr>
	    </thead>
		@foreach($users as $user)
			<tr class="{{ isset($user->deleted_at) ? 'danger' : 'success' }}" >
 				<td> {{ $user->id }}</td>
 				<td> 
 					<a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->username }}	</a>
 				</td>
 				<td> {{ $user->displayname }} </td>
 				<td> {{ date('d F Y - G:i', strtotime($user->created_at)) }} </td>
 				<td>
					{!! Form::open(['route' => ['users.destroy',$user->id], 'method' => 'DELETE', 'class' => 'form-inline']) !!} 				
		 				<a class="btn btn-default btn-sm" aria-label="@lang('template.edit')" href="{{ route('users.edit', ['id' => $user->id]) }}">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a class="btn btn-{{ isset($user->deleted_at) ? 'success': 'danger' }} btn-sm" aria-label="@lang('template.destroy')" onclick="$(this).closest('form').submit()">
							<span class="glyphicon glyphicon-{{ isset($user->deleted_at) ? 'ok': 'remove' }}-circle" aria-hidden="true"></span>
						</a>
					{!! Form::close() !!}
	

 				</td>
			</tr>
		@endforeach	    
	</table>




	@endif
@stop