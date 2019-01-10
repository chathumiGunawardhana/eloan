<!DOCTYPE html>
 <html>
  <head>
   <meta charset="utf-8" />
    <title>Page Title</title>
  </head>
  <body>
    <h2>Welcome to the Inquiry page!</h2>
    <form method="POST" action="insertinq.php">
      <div class="box">
        <table>
          <div name="txt">
            <tr>
              <td>Full Name:</td>
              <td><input type="text" name="name" required></td>
            </tr>
            <tr>
              <td>NIC no.:</td>
              <td><input type="text" name="nicno" required></td>
            </tr>
            <tr>
              <td>Email Address:</td>
              <td><input type="text" name="email" required></td>
            </tr>
            <tr>
              <td>Mobile No.:</td>
              <td><input type="text" name="mobile" required></td>
            </tr>
            <tr>
              <td>Loan Type:</td>
              <td><input type="text" name="loantype" required></td>
            </tr>
            <tr>
              <td>Loan Amount(Rs.):</td>
              <td><input type="text" name="amount" required></td>
            </tr>
            <tr>
              <td>Period(Months):</td>
              <td><input type="text" name="period" required></td>
            </tr>
            <tr id>
              <td>Other Details:</td>
              <td><input type="text" name="other"></td>
            </tr>
            <tr>
              <td>Date Required:</td>
              <td><input type="date-time" name="date" required></td>
            </tr>
          </div>
          <div class="button">
            <td><button type="submit" name="submit">Submit</button></td>
            <td><button onclick="location.href='myinquiry.php'" name="myinquiry">My Inquiry</button></td>
          </div>
        </table>
      </div>
    </form>
  </body>
 </html>