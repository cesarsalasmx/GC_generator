<!DOCTYPE html>
<html>
<head>
    <title>Exportación de Giftcards</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Giftcards del Lote #{{ $lote->id }}</h1>
    <p><strong>Comentarios:</strong> {{ $lote->comentarios }}</p>
    <p><strong>Cantidad GC:</strong> {{ $lote->cantidad_gc }}</p>
    <p><strong>Vigencia GC:</strong> {{ $lote->vigencia_gc }}</p>
    <p><strong>Prefijo GC:</strong> {{ $lote->prefijo_gc }}</p>
    <p><strong>Valor GC:</strong> {{ $lote->valor_gc }}</p>

    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Pin</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($giftcards as $giftcard)
                <tr>
                    <td>{{ $giftcard->code }}</td>
                    <td>{{ $giftcard->pin }}</td>
                    <td>{{ $giftcard->phone }}</td>
                    <td>{{ $giftcard->email }}</td>
                    <td>{{ $giftcard->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
