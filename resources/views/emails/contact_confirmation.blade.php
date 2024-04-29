<!DOCTYPE html>
<html>

<head>
    <title>Konfirmasi Pesan Kontak</title>
</head>

<body>
    <h1>Konfirmasi Pesan Kontak</h1>

    <p>Terima kasih atas pesan kontak Anda. Berikut ini adalah detail pesan yang telah Anda kirim:</p>

    <strong>Nama:</strong> {{ $contact->name }}<br>
    <strong>Email:</strong> {{ $contact->email }}<br>
    <strong>Subjek:</strong> {{ $contact->subject }}<br>
    <strong>Pesan:</strong> {{ $contact->message }}<br>

    <p>Terima kasih atas pesan Anda. Kami akan segera meresponsnya.</p>

    <p>Salam,
        Tim Wikin</p>
</body>

</html>
