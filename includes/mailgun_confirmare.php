<?php
$config = include(__DIR__ . '/../.env.php'); // incarca datele din fisierul .env.php

function trimiteEmailConfirmare($nume, $email, $medic, $data, $ora) {
    global $config; // accesare variabilele din $config

    $api_key = $config['MAILGUN_API_KEY'];
    $domain = $config['MAILGUN_DOMAIN'];
    $from = 'Clinica SmileTrack <postmaster@' . $domain . '>';

    $subject = 'Confirmare programare SmileTrack';
    $html = "
        <html>
        <body style='font-family: Arial, sans-serif;'>
            <h3 style='color:#2a8;'>Salut, $nume!</h3>
            <p>Programarea ta la <strong>$medic</strong> a fost <span style='color:green;'>confirmată</span>.</p>
            <p>Data: <strong>$data</strong><br>Ora: <strong>$ora</strong></p>
            <p style='margin-top:20px;'>Te așteptăm cu drag!<br><em>Echipa SmileTrack</em></p>
        </body>
        </html>
    ";

    $cmd = curl_init();

    curl_setopt_array($cmd, [
        CURLOPT_URL => "https://api.mailgun.net/v3/$domain/messages",
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => "api:$api_key",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'from' => $from,
            'to' => $email,
            'subject' => $subject,
            'html' => $html
        ]
    ]);

    $response = curl_exec($cmd);
    $httpCode = curl_getinfo($cmd, CURLINFO_HTTP_CODE);
    curl_close($cmd);

    if ($httpCode == 200) {
        error_log("✅ Email trimis cu succes către $email");
    } else {
        error_log("❌ Eroare la trimitere către $email: $response");
    }
}
?>
