<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
        }
        .strip {
            background: #f2f2f2;
        }
        td {
            padding: 10px;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <td class="strip">Name:</td>
        <td class="strip">{{ $request->name }}</td>
    </tr>

    <tr>
        <td>Email:</td>
        <td>{{ $request->email }}</td>
    </tr>

    <tr>
        <td class="strip">Phone:</td>
        <td class="strip">{{ $request->phone }}</td>
    </tr>

    <tr>
        <td>Subject:</td>
        <td>{{ $request->subject }}</td>
    </tr>

    <tr>
        <td class="strip">Message:</td>
        <td class="strip">{{ $request->message }}</td>
    </tr>
</table>

</body>
</html>
