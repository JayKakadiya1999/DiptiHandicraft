your password is :

<?php
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digit = '1234567890';
    $symbol = '@$#^';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1;
    $digitLength = strlen($digit) - 1;
    $symbolLength = strlen($symbol) - 1;
    for ($i = 0; $i < 4; $i++)
    {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    for ($i = 0; $i < 1; $i++)
    {
        $d = rand(0, $symbolLength);
        $pass[] = $symbol[$d];
    }
    for ($i = 0; $i < 3; $i++)
    {
        $d = rand(0, $digitLength);
        $pass[] = $digit[$d];
    }

    $pwd = implode($pass);

    $forgotpwdemail = session()->get('forgotpwdemail');
    DB::table('user')
        ->where('Email','=',$forgotpwdemail)
        ->update(['Password' => $pwd]);

    echo "Your New Password Is :";
    foreach ($pass as $row)
    {
        echo $row;
    }
    
?>
