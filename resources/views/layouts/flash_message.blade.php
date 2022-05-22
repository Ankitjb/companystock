@if ($errors->count()>0)
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $errors->first() }}</strong>
    </div>
@endif
