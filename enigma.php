<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="" method="POST">
            <div>
                <label for="name">Text</label>
                <input type="text" name="text">
            </div>
            <div>
                <label for="name">Clé</label>
                <input type="text" name="clé" maxlength="26">
            </div>
            <div>
                <button type="submit" name="submit">Crypter</button>
            </div>
        </form>
    </div>
    <hr>
    <div>
        <form action="" method="POST">
            <div>
                <label for="name">Text</label>
                <input type="text" name="code">
            </div>
            <div>
                <label for="name">Clé</label>
                <input type="number" name="clé" maxlength="26">
            </div>
            <div>
                <button type="submit" name="submit">Decrypter</button>
            </div>
        </form>
    </div>
    <?php
    $alph = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

    function crypte($word, $key)
    {
        $alphabet = range('a', 'z');
        for ($i = 0; $i < 26; $i++) {
            $index = $i + $key;
            if ($i + $key > 25) $index = (($i + $key) % 25) - 1;
            $alph[$i] = $alphabet[$index];
        }
        $cryptedData = strtr($word, array_combine($alphabet, $alph));
        echo $cryptedData;
    }

    function decrypte($word, $key)
    {
        crypte($word, 26 - $key);
    }

    function vernam($word, $key)
    {
        $word_length = strlen($word);
        $key_length =  strlen($key);

        if ($key_length > $word_length) {
            $key = substr($key, 0, $key_length);
        } elseif ($key_length > $word_length) {
            $key = str_pad($key, $key_length, $key, STR_PAD_RIGHT);
        }
        return $word ^ $key;
    }
    // function vernam_decrypt($word, $key)
    // {
    //    echo vernam()
    // }

    if (isset($_POST['text']) && isset($_POST['clé'])) {
        $word = trim($_POST['text']);

        $data = trim($_POST['clé']);
        $nb = intval($data);

        $v = vernam($word, $data);
        $vd = vernam($v, $data);
        // echo ($v);
        echo vernam($v, $data);
        // crypte($word, $nb);
    }

    if (isset($_POST['code']) && isset($_POST['clé'])) {
        $word = trim($_POST['code']);

        $data = trim($_POST['clé']);
        $nb = intval($data);

        decrypte($word, $nb);
    }
    ?>
</body>

</html>