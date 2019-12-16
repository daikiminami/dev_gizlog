@extends ('common.user')
@section ('content')

<h2 class="brand-header">
  <img src="" class="avatar-img"> MailBox
</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'question.index', 'method' => 'GET','class' => 'search-form']) !!}
    <div class="btn-wrapper">
      <a class="btn" href="{{ route('message.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">user</th>
          <th class="col-xs-2">date</th>
          <th class="col-xs-1">title</th>
          <th class="col-xs-5">content</th>
          <th class="col-xs-1"></th>
          <th class="col-xs-1"></th>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-xs-2"></td>
          <td class="col-xs-1"></td>
          <td class="col-xs-5"></td>
          <td class="col-xs-2"><span class="point-color"></span></td>
          <td class="col-xs-1">
            <a class="btn btn-success" href="">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
          </td>
          <td class="col-xs-1">
            <form action=""></form>
          </td>
        </tr>
      </tbody>
    </table>
    <div aria-label="Page navigation example" class="text-center"></div>
  </div>
</div>

@endsection