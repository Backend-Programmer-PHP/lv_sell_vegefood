<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            max-width: 600px;
            width: 100%;
            margin: 0 auto 0;
            background: #fff;
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            font-size: 18px;
        }

    </style>
</head>

<body style="background: #F3F3F3;padding: 80px 0;">
    <table>
        <tbody>
            <tr>
                <td style="text-align: center;padding: 30px;">
                    <img width="90" style="margin-bottom: 20px;"
                        src="https://api.onicorn.vn/public/assets/images/logo.png" />
                    <p style="text-align: left;margin-bottom:15px;color: #606060;">Hi {{ $email }},</p>
                    <p style="text-align: left;color: #606060;font-size: 14px;">Welcome to Ho Chi Minh City! You have
                        successfully registered. Please use the registered email and password to sign in to the App for
                        a better experience.</p>
                    {{-- <p style="text-align: left;color: #606060;font-size: 14px;margin-bottom:15px">If you do not request a password reset using this
                        address,
                        please ignore this email.</p> --}}
                    <a href="{{ url('/signin') }}" itemprop="url"
                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: block; border-radius: 5px; text-transform: capitalize;  margin: 0;background-color: #AF2D23 ; border-color: #AF2D23 ; border-style: solid; border-width: 10px 20px;">
                        Go to the login page
                    </a>
                    <p style="text-align: left;font-size: 14px;color: #606060;">© All rights reserved.</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
