<?php
include "phpqrcode/qrlib.php";

QRcode::png("ramdan", "ramdan.png", "L", 4, 4);
QRcode::png("ramdan", "ramdan ukuran 6 4.png", "L", 6, 4);
QRcode::png("ramdan", "ramdan ukuran 8 4.png", "L", 8, 4);

echo "<img src='code.png' /><br/>";

echo "<img src='code1.png' /><br/>"; 

echo "<img src='code2.png' />";



/**
 Keterangan :
 1. Parameter pertama untuk menentukan teks atau data yang akan dikodekan
    kedalam gambar dan di lewatkan sebagai sting biasa.
 
 2. Parameter kedua adalah nama file output untuk gambar PNG yang dihasilkan
 
 3. Parameter ketiga adalah tingkat koreksi kesalahan untuk barcode yang dihasilkan,
    yang dilewatkan sebagai huruf string tunggal. Ini menentukan berapa banyak kata kode data
    (8 bits percodewords) yang dapat dikembalikan untuk gambar QR Code yang terdistorsi atau rusak
    menggunakan algoritma koreksi kesalahan Reed-Solomon, berikut tabelnya :
    
 ----------------------------------------------------
 |  LEVEL   |   Resordarble     |   PHP QR Code     | 
 |          |   Codewords       |   Parameters      |
 ----------------------------------------------------
 | Low      | 7%                |        L          |
 | Medium   | 15%               |        M          |
 | Quartile | 25%               |        Q          |   
 | High     | 30%               |        H          |
 ----------------------------------------------------
 
 4. Parameter keempat menentukan ukuran dari masing- masing kotak kode barcode di ukur salam pixel
    Setiap persegi kode (juga bernama "pixel" atau "modul") adalah 4 x 4 px
    
 5. Parameter kelima menentukan batas margin putih di sekitar barcode, di ukur dalam kotak kode 
    (misalnya margin 16px di setiap sisi untuk 4 x 4px kode persegi)
 **/
?>