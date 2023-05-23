<form action="{{ route('categorias.destroy', $id) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="text-right">
        <a href="{{ route('categorias.show', $id) }}" class="btn px-1 text-success btn-sm" data-toggle="tooltip" title='Ver'><i class="fas fa-eye fs-6"></i></a>
        <a href="{{ route('categorias.edit', $id) }}" class="btn px-1 text-primary btn-sm" data-toggle="tooltip" title='Editar'><i class="fas fa-edit fs-6"></i></a>
        <button type="submit" class="btn text-danger btn-sm" data-toggle="tooltip" title='Borrar'
            onclick="return confirm('Esta seguro de borrar? {{ $id }} ')">
            <i class="fa fa-trash fs-6"></i>
        </button>
    </div>
</form>
