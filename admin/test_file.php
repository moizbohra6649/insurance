<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice - American General</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
    h1 { text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    td, th { padding: 8px; border: 1px solid #ccc; text-align: left; }
    .header, .footer { text-align: center; margin-bottom: 20px; }
    .total { font-weight: bold; }
  </style>
</head>
<body>

<!-- Your Invoice Content -->
<div id="invoice"> <!-- Hide or show as you want -->
  <div class="invoice-box">
    <h1>INVOICE</h1>
    <div class="header">
      <p><strong>AMERICAN GENERAL</strong></p>
      <p>Registered Address: 8770 W Bryn Mawr, St 1300 Chicago, IL 60631</p>
      <p>Email: contact@aginsuranceusa.com | Phone: +1 (877) 898-0788</p>
    </div>
    <p><strong>Invoice No:</strong> ILC00-102028</p>
    <p><strong>Date:</strong> 11/21/2024</p>
    <p><strong>Customer Name:</strong> SABAT ZHUSUEV</p>
    <p><strong>Billing Address:</strong> 3910 N CALIFORNIA AVE 1 60618</p>
    <p><strong>Email:</strong> </p>

    <table>
      <thead>
        <tr>
          <th>Item</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>International Driving License Print</td>
          <td>1</td>
          <td>$69.00</td>
          <td>$69.00</td>
        </tr>
      </tbody>
    </table>

    <p class="total">Total Amount Paid: $69.00</p>
    <p><strong>Payment Mode:</strong> Credit Card (XXXX-XXXX-XXXX-2262)</p>
    <p><strong>Transaction ID:</strong> 542432****2262</p>
    <p><strong>Shipping Address:</strong> Same as billing</p>

    <div class="footer">
      <p>Thank you for your business!</p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- html2pdf.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
$(document).ready(function() {
    var element = document.getElementById('invoice');

    html2pdf()
        .from(element)
        .toPdf()
        .get('pdf')
        .then(function (pdf) {
       
            var blob = pdf.output('blob');
            var url = URL.createObjectURL(blob);
            window.open(url, '_self'); // Automatically open in same tab
        });
});
</script>

</body>
</html>
