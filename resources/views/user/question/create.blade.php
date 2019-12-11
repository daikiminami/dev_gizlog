@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    <!-- <form> -->
    {!! Form::open(['route' => 'question.confirm']) !!}
      <div class="form-group">
        <select name='tag_category_id' class = "form-control selectpicker form-size-small" id="pref_id">
          <option value="">Select category</option>
          @foreach ($categories as $category)
            <option value= "{{ $category->id }}">{{ strtoupper($category->name) }}</option>
          @endforeach
        </select>
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <!-- <input class="form-control" placeholder="title" name="title" type="text"> -->
        {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <!-- <textarea class="form-control" placeholder="Please write down your question here..." name="content" cols="50" rows="10"></textarea> -->
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block"></span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="create">
    <!-- </form> -->
    {!! Form::close() !!}
  </div>
</div>

@endsection

