<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bir Fikrim Var</title>
</head>

<body>
    <p>Ad ve Soyad: {{ $data['name'] }}</p>
    <p>Email : {{ $data['email'] }}</p>
    <p>Telefon:{{ $data['phone'] }}</p>
    <p>Mahalle : {{ $data['neighbourhood'] }}</p>
    <p>Doğum Yılı : {{ $data['year'] }}</p>
    <p>Mesaj:{{ $data['message'] }}</p>
</body>

</html>
