@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['update.confirm', $question->id]]) !!}
      <div class="form-group {{ $errors->has('tag_category_id') ? 'has-error' : '' }}">
        <select name='tag_category_id' class = "form-control selectpicker form-size-small" id ="pref_id">
          <option value="{{ $question->tagCategory->id }}">{{ $question->tagCategory->name }}</option>
          @foreach ($categories as $category)
            <option value= "{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        {!! Form::input('text', 'title', $question->title, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        {!! Form::textarea('content', $question->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) !!}
    {!! Form::close(); !!}
  </div>
</div>

@endsection

