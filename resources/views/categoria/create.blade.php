<x-app-layout>

    <div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h3 class="m-0">
                    Nueva Categoria
                </h3>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('categorias.store') }}" method="post" class="needs-validation" autocomplete="off">
                            @csrf
                            @php $data = ''; @endphp

                            @include('categoria.form.controls')

                            <div class="mt-4 row d-print-none">
                                <div class="text-right col-12">
                                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary" tabindex="5">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-success" tabindex="6">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                        Grabar
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
