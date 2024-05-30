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
    <table FRAME="void" RULES="rows">
        <tr>
            <td><strong>Valor:</strong> {{ $lote->valor_gc }}</td>
            <td><strong>Vigencia:</strong> {{ $lote->vigencia_gc }}</td>
        </tr>
        <tr>
            <td><strong>Cantidad:</strong> {{ $lote->cantidad_gc }}</td>
            <td><strong>Prefijo:</strong> {{ $lote->prefijo_gc }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Comentarios:{{ $lote->comentarios }}</strong></td>
        </tr>
    </table>
    <br><br><br>
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
                    <td>{{ $giftcard->internal_code }}</td>
                    <td>{{ $giftcard->pin }}</td>
                    <td>{{ $giftcard->phone }}</td>
                    <td>{{ $giftcard->email }}</td>
                    <td>{{ $giftcard->status ? 'Activada' : 'Sin activar' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
