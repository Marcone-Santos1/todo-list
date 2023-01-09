<form action="{{!isset($data) ? '/create' : '/update/' . $data['id'] }}" method="post">
    @csrf

    @if (isset($data))
    @method('PUT')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissable margin5">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Errors:</strong> Please check below for errors
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissable margin5">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Errors:</strong> Please check below for errors
            <ul>
                {{ session('danger') }}
            </ul>
        </div>
    @endif

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{isset($data) && $data != '[]' ? $data['title'] : ''}}">
        </div>
        <div class="form-group col-md-6">
            <label for="expires_at">Expires at</label>
            <input type="date" name="expires_at" class="form-control" id="expires_at" placeholder="Expires at" value="{{isset($data) && $data != '[]' ? $data['expires_at'] : ''}}">
        </div>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" cols="30" rows="10" id="description" placeholder="Description">{{isset($data) && $data != '[]' ? $data['description'] : ''}}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">{{isset($data) && $data != '[]' ? 'Atualizar' : 'Cadastrar'}}</button>
</form>
