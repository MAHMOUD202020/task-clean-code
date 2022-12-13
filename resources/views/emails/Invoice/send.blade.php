<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>

<h1>Hello, your invoice has been generated</h1>

<hr>
<h2>Invoice details</h2>
<tabel>
    <tr>
        <td>name</td>
        <td>email</td>
        <td>phone</td>
        <td>amount</td>
        <td>due date the invoice</td>
        <td> create date</td>
    </tr>

    <tr>
        <td>{{$invoice->name}}</td>
        <td>{{$invoice->email}}</td>
        <td>{{$invoice->phone}}</td>
        <td>{{$invoice->amount}}</td>
        <td>{{$invoice->due_date_the_invoice}}</td>
        <td>{{$invoice->created_at}}</td>
    </tr>
</tabel>

</body>
</html>
