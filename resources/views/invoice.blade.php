<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>
<style>
body { font-family: sans-serif; }
.invoice { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
.company-details { text-align: left; }
.customer-details { text-align: left; }
.invoice-header { text-align: center; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 8px; border: 1px solid #ddd; }
th { background-color: #f2f2f2; }
.total { font-weight: bold; text-align: right; }
</style>
</head>
<body>
<div class="invoice">
  <div class="invoice-header">
    <h1>Invoice</h1>
  </div>
  <div class="company-details">
    <h2>Your Company Name</h2>
    <p>Your Address</p>
    <p>Your Contact Info</p>
  </div>
  <div class="customer-details">
    <h2>Customer: [Customer Name]</h2>
    <p>Customer Address</p>
  </div>
  <div class="invoice-details">
    <p>Invoice Number: [Invoice Number]</p>
    <p>Invoice Date: [Date]</p>
  </div>
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
        <td>[Item 1]</td>
        <td>[Quantity 1]</td>
        <td>[Price 1]</td>
        <td>[Total 1]</td>
      </tr>
      <tr>
        <td>[Item 2]</td>
        <td>[Quantity 2]</td>
        <td>[Price 2]</td>
        <td>[Total 2]</td>
      </tr>
      <!-- Add more rows as needed -->
    </tbody>
  </table>
  <div class="total">
    <p>Total Due: [Total Amount]</p>
  </div>
</div>
</body>
</html>