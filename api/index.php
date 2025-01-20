<?php
// Check if we're running on Vercel
if (getenv('VERCEL')) {
    // SSL Certificate path
    putenv('SSL_CERT_FILE=/etc/ssl/certs/ca-certificates.crt');
}

require __DIR__ . '/../public/index.php';