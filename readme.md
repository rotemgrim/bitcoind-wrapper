
# Bitcoind PHP simple wrapper
Its a simple library granting access to bitcoind core RPC with simple php methods and auto complete for IDEs

The logic is separated into 3 different departments:
 - Wallet
 - Transactions
 - Blockchain

## Usage
Instantiating bitcoin
```php
    require "../vendor/autoload.php";
    
    $bc = new BitcoindClient(
        'foo',          // user name
        'bar',          // password
        'localhost',    // host address
        18333           // rpc port
    );
        
    echo $bc->wallet->getAccountAddress("");
    echo $bc->wallet->getBalance();
```

--------------------
## Installing Dependencies
Install the packages via `composer`:
```sh
composer install
composer dump-autoload
```

## Spawn bitcoin daemon with docker
```bash
docker-compose up -d
```
look inside docker with
```bash
docker exec -it <containerId> sh
```

## Testing
Just run the PHPUnit test suit by:
```sh
composer test
```