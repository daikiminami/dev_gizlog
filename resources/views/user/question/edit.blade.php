@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['update.confirm', $question->id]]) !!}
      <div class="form-group">
        <select name='tag_category_id' class = "form-control selectpicker form-size-small" id ="pref_id">
          <option value="{{ $question->tagCategory->id }}">{{ strtoupper($question->tagCategory->name) }}</option>
          @foreach ($categories as $category)
            <option value= "{{ $category->id }}">{{ strtoupper($category->name) }}</option>
          @endforeach
        </select>
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', $question->title, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $question->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block"></span>
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) !!}
    {!! Form::close(); !!}
  </div>
</div>

@endsection

