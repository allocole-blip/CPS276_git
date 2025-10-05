<?php
   class BankAccount {
    private $balance = 0;  // Private property - can't be accessed directly

    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            return "Deposited: $" . $amount;
        }
        return "Invalid deposit amount";
    }

    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return "Withdrawn: $" . $amount;
        }
        return "Invalid withdrawal amount";
    }

    public function getBalance() {
        return "Current balance: $" . $this->balance;
    }
}

// Using the encapsulated bank account
$account = new BankAccount();


?> 

<!doctype html>
<html lang="en">
<head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, 
            initial-scale=1, shrink-to-fit=no">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
          <title>encapsulation demo </title>
</head>
    <body class="container"> 
            <main>
           <?php
            echo $account->deposit(100);    // Outputs: Deposited: $100
            print("||");
            echo $account->getBalance();    // Outputs: Current balance: $100
            echo $account->withdraw(50);    // Outputs: Withdrawn: $50
            echo $account->getBalance();    // Outputs: Current balance: $50.  
             ?> 

             
            </main>
     </body>
</html>