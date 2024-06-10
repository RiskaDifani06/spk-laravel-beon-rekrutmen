<!DOCTYPE html>
<html>

<head>
  <title>SPK BEON</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <style type="text/css">
    table tr td,
    table tr th {
      font-size: 9pt;
    }
  </style>
  <center>
    <h4>Hasil Ranking Metode Borda {{ $borda->first()->role_name }}</h4>
  </center>

  <table class='table-bordered table'>
    <thead>
      <tr>
        <th>Ranking</th>
        <th>Nama Alternatif</th>
        <th>Skor</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($borda as $b)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $b->alternatif_name }}</td>
          <td>{{ number_format($b->score, 3) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

</body>

</html>
