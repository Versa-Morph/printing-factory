<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.5;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 16px;
            margin: 0;
            color: #f15a24;
        }
        .header .subtitle {
            font-size: 8px;
            margin: 0;
            color: #333;
        }
        .contact-info {
            text-align: left;
            margin-top: 10px;
        }
        .contact-info p {
            margin: 0;
            font-size: 9px;
        }
        .quotation-number {
            text-align: center;
            margin: 20px 0;
        }
        .quotation-number p {
            font-size: 10px;
            margin: 5px 0;
        }
        .customer-info, .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .customer-info td {
            padding: 5px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        .notes {
            margin-top: 20px;
        }
        .footer {
            text-align: left;
            margin-top: 30px;
        }
        .footer img {
            width: 60px;
            margin-bottom: 10px;
        }
        .footer p {
            font-size: 9px;
        }
        .contact {
            font-size: 8px;
            text-align: left;
            margin-top: 10px;
        }
        .contact a {
            text-decoration: none;
            color: #000;
            font-size: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/images/logo-polimer.jpg') }}" width="60px" alt="">
        <h1>Poto Polimer Indonesia pt</h1>
        <p class="subtitle">Villa Melati Mas Blok B8 No.16 A-B, Jalan Raya Serpon. Desa/Kelurahan Lengkong Karya, Kec. Serpong Utara, Kota Tangerang Selatan, Provinsi Banten, Kode Pos: 15310</p>
        <p class="subtitle">Telp: +62 21 22232940 Fax: +62 21 22232940 Email: potopolimer@gmail.com</p>
    </div>
    
    <div class="quotation-number">
        <b>QUOTATION </b>
        <p><strong>No. {{ $quotation->quotation_number }}/NK/24-Anugerah Aneka Box</strong></p>
        <p>Tangerang, 21 Oktober 2024</p>
    </div>
    
    <table class="customer-info">
        <tr>
            <td><strong>To:</strong> {{ $quotation->company_code }}</td>
            <td><strong>Attention:</strong> {{ $customer->company_name }}</td>
        </tr>
        <tr>
            <td>{{ $customer->company_address }}</td>
            <td></td>
        </tr>
        <tr>
            <td>{{ $customer->company_phone_number }}</td>
        </tr>
        <tr>
            <td>{{ $customer->pic_email }}</td>
            <td></td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Description</th>
                <th>Materials</th>
                <th>Units</th>
                <th>Thickness</th>
                <th>Unit Price (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Liquid Photopolymer Plate</td>
                <td>PPI 40</td>
                <td>Cm2</td>
                <td>0,175 mm</td>
                <td>Rp.139,00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Liquid Photopolymer Plate</td>
                <td>PPI A06</td>
                <td>Cm2</td>
                <td>0,73 mm</td>
                <td>Rp.159,00</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Liquid Photopolymer Plate</td>
                <td>Huanguang</td>
                <td>Cm2</td>
                <td>0,83mm</td>
                <td>Rp.129,00</td>
            </tr>
        </tbody>
    </table>

    <div class="notes">
        <p><strong>Term & Condition:</strong></p>
        <ul>
            <li>Surat penawaran harga ini berlaku 30 hari dari sekarang</li>
            <li>Harga belum termasuk pajak PPN</li>
            <li>Minimum Order 1.000 Cm2</li>
            <li>Pembayaran: Tunai, Transfer, Pembayaran 30 Hari</li>
            <li>Ke Bank BCA atas nama Poto Polimer Indonesia No.Rek 497 651 5188</li>
            <li>Delivery term: Free min. 1000 cm2 utk area Jabodetabek</li>
        </ul>
    </div>

    <div class="footer">
        <p>Salam,</p>
        <img src="path-to-your-signature.jpg" alt="Signature">
        <p>PT. Poto Polimer Indonesia</p>
        <p>Nuke Hapsari S</p>
        <p>Sales Executive</p>
    </div>
</body>
</html>
