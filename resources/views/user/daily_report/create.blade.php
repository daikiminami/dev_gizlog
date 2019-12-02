@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      {!! Form::input('hidden', 'user_id', Auth::id(), ['class' => 'form-control']) !!}
      <div class="form-group form-size-small {{ $errors->has('reporting_time') ? 'has-error' : '' }}">
        {!! Form::input('date', 'reporting_time', null, ['class' => 'form-control']) !!}
        @if ($errors->has('reporting_time'))
            <span class="help-block">
                <strong>{{ $errors->first('reporting_time') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => "Title"]) !!}
        @if ($errors->has('title'))
          <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content', 'rows' => '10', 'cols' => '50']) !!}
        @if ($errors->has('title'))
          <span class="help-block">
            <strong>{{ $errors->first('content') }}</strong>
          </span>
        @endif
      </div>
      {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>
@endsection