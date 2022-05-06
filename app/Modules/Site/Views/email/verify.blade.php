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

        .navbar-brand {
            font-weight: 800;
            font-size: 20px;
            text-transform: uppercase;
        }

        .navbar-brand {
            display: inline-block;
            padding-top: 0.3125rem;
            padding-bottom: 0.3125rem;
            margin-right: 1rem;
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap;
        }

        .navbar-brand {
            color: #82ae46;
        }

    </style>
</head>

<body style="background: #F3F3F3;padding: 80px 0;">
    <table>
        <tbody>
            <tr>
                <td style="text-align: center;padding: 30px;">
                    <a class="navbar-brand" href="{{ url('/') }}">Vegefoods</a>
                    <p style="text-align: left;margin-bottom:15px;color: #606060;">Hi {{ $email }},</p>
                    <p style="text-align: left;color: #606060;font-size: 14px;">Welcome to Ho Chi Minh City! You have
                        successfully registered. Please use the registered email and password to sign in to the App for
                        a better experience.</p>
                    {{-- <p style="text-align: left;color: #606060;font-size: 14px;margin-bottom:15px">If you do not request a password reset using this
                        address,
                        please ignore this email.</p> --}}
                    <a href="{{ url('/users/signin') }}" itemprop="url"
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
