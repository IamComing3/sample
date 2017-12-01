<form action="{{ route('statuses.store') }}" method="post">
  @include('shared._errors')

  {{ csrf_field() }}

  <textarea name="content" rows="3" placeholder="聊聊新鲜事儿..." class="form-control">{{ old('content') }}</textarea>
  <button type="submit" name="button" class="btn btn-primary pull-right">发布</button>
</form>
