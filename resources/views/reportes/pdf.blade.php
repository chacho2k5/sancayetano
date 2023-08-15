<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>
    .header {
      background-color: royalblue;
    }
  </style>
</head>
<body>
  <table class="table">
    <thead class="header">
      <tr>
        <th>Numero</th>
        <th>Razon Social</th>
        <th>Trabajo</th>
      </tr>
    </thead>
    <tbody>
      {{-- @foreach ( $registros as $reg)
      <tr>
        <td>{{ $reg->numero_ot }}</td>
        <td>{{ $reg->razonsocial }}</td>
        <td>{{ $reg->trabajo_nombre }}</td>
      </tr>
      @endforeach --}}
    </tbody>
  </table>
</body>
</html>

