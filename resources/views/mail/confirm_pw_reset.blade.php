<html>

<head>
    <title></title>
</head>

<body>
    <table>
        <tr>
            <td>Dear {{ $name }},</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>A request to reset your password has been called. If it was you click the link below to reset the
                password. : </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><a class="btn btn-primary" style="color: #6f42c1"
                    href="{{ url('confirm-reset/' . $code . '/' . $code2) }}">Reset password?</a>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thank You & Regards,</td>
        </tr>
    </table>
</body>

</html>
