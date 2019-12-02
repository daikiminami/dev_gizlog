@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['report.update', $report->id], 'method' => 'PUT']) !!}
    {!! Form::input('hidden', 'user_id', Auth::id(), ['class' => 'form-control']) !!}
    <div class="form-group form-size-small {{ $errors->has('reporting_time') ? 'has-error' : '' }}">
      {!! Form::input('date', 'reporting_time', $report->reporting_time->format('Y-m-d'), ['class' => 'form-control']) !!}
      @if ($errors->has('reporting_time'))
        <span class="help-block">
          <strong>{{ $errors->first('reporting_time') }}</strong>
        </span>
      @endif
    </div>
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
      {!! Form::input('text', 'title', $report->title, ['class' => 'form-control', 'placeholder' => "Title"]) !!}
      @if ($errors->has('title'))
        <span class="help-block">
          <strong>{{ $errors->first('title') }}</strong>
        </span>
      @endif
    </div>
    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
      {!! Form::textarea('content', $report->content, ['class' => 'form-control', 'placeholder' => 'Content', 'rows' => '10', 'cols' => '50']) !!}
      @if ($errors->has('content'))
        <span class="help-block">
          <strong>{{ $errors->first('content') }}</strong>
        </span>
      @endif
    </div>
    <button type="submit" class="btn btn-success pull-right">Update</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

