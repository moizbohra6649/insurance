<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <style type="text/css">
    body {
        width: 650px;
        font-family: work-Sans, sans-serif;
        background-color: #f6f7fb;
        display: block;
    }

    a {
        text-decoration: none;
    }

    span {
        font-size: 14px;
    }

    p {
        font-size: 13px;
        line-height: 1.7;
        letter-spacing: 0.7px;
        margin-top: 0;
    }

    .text-center {
        text-align: center
    }
    </style>
</head>

<body style="margin: 30px auto;">
    <table style="width: 100%">
      <tbody>
        <tr>
          <td>
            <table style="background-color: #f6f7fb; width: 100%">
              <tbody>
                <tr>
                  <td>
                    <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                      <tbody>
                        <tr>
                          <td><img src="assets/images/logo/logo-white.png" alt="" style="max-height: 60px;width: auto; margin: 10px 10px 10px 10px;"></td>
                          <td style="text-align: right; color:#999"><span></span></td>
                        </tr>
                      </tbody>
                    </table>
                    <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                      <tbody>
                        <tr>
                          <td style="padding: 30px"> 
                            <p>Dear {{name}},</p>
                            <p> You’ve received a new inquiry through the Inquiry Us form on the Westland Mutual Insurance website.</p>
                            <p>Please review the submission details below:</p>
                            <p><b>Name:</b> {{username}}</p>
                            <p><b>Email:</b> {{email}}</p>
                            <p><b>Mobile No.:</b> {{mobile_no}}</p> 
                            <br>
                            <p> Thank you,</p>
                            <p> <b>Westland Mutual Insurance</b></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
</body>
</html>