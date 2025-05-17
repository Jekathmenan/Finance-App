<html>

<head>
    <title></title>
</head>

<body>
    <table>
        <tr>
            <td>Dear {{ $name }},</td>
        </tr>
        <tr></tr>
        <tr>
            <td>A new user account war created for you. To log into your account click on "Set password" and set a
                password for your account </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><a class="btn btn-primary" style="color: #6f42c1" href="{{ url('forgotPassword/') }}">Set password</a>
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
