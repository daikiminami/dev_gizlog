@extends ('common.user')
@section ('content')

<h2 class="brand-header">Mail作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'message.store']) !!}
      <div class="form-group">
        <select name='recipient_user_id' class = "form-control selectpicker form-size-small" id="pref_id">
          <option value="">Select User</option>
            @foreach($users as $user)
              <option value= "{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block"></span>
      </div>
      {{ Form::submit('Send', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) }}
    {!! Form::close() !!}
  </div>
</div>

@endsection