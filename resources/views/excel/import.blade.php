@if (count($errors) > 0)
    @foreach ($errors as $error)
        <p>{{ $error }}</p>
    @endforeach
@else
    <h1>{{ $filePath }} file import!</h1>
    <h3>{{ $importCounts['lojas'] }} lojas inseridas/atualizados.</h3>
    <h3>{{ $importCounts['produtos'] }} produtos inseridos/atualizados.</h3>
@endif
