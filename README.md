## Crypto Scam White Paper.

An open source system database containing fraudulent cryptocurrency addresses. 
The goal for this project is to integrate it with major crypto wallets to help prevent <a href="https://www.fbi.gov/scams-and-safety/common-scams-and-crimes/advance-fee-schemes" target="_blank">advance-fee schemes</a>. 

Project Homepage: https://crypto-scam.io

Copyrighted under <a href="https://europa.eu/youreurope/business/running-business/intellectual-property/copyright/index_en.htm" target="_blank">European Union guidelines</a>. Distributed under <a href="https://github.com/tgbv/crypto-scam/blob/beta/license.txt" target="_blank">MIT license</a>.

## How does it work

Let's assume three fictionary men: John Doe, Foo Bar, Baz Bar

1. John Doe spots a scammy Youtube ad with a fraudulent BTC/ETH/XRM/etc.. address claiming to triple the amount of coins you send to it. He goes to https://crypto-scam.io/report and reports it.
2. Foo Bar spots the ad as well but doesn't know it's an advance-fee scheme. He proceeds to send funds to the address.
3. Before executing the order, the wallet software used by Foo Bar queries the database of https://crypto-scam.io (check API reference below) to check if the receipt address is fraudulent. Because John Doe already reported it, Crypto Scam signals it, and wallet software halts the transaction initiated by Foo Bar preventing him from falling into the scam.
4. Alternatively Baz Bar spots the ad as well but he's suspicious about it. He goes to https://crypto-scam.io/search and manually queries the database only to discover the address is fraudulent.

## API reference

Via API anyone can query the database for any address and I encourage all crypto wallets to do so before executing any order. API base URL is: https://api.crypto-scam.io. The return is always a JSON.

1. To lookup an address call the API like this:  
`GET https://api.crypto-scam.io/a/crypto_address_here/parmeters,separated,by,commas,here`

A response can have three states: **scam**, **unknown**, **safe**. First when it's a known fraud, second when address hasn't been reported yet, and third when it's legit.
The third state hasn't been implemented in current application version yet for privacy reasons, but is planned for future.

2. You can also query the reports for an address. Add this magic parameter to your request:  
`GET https://api.crypto-scam.io/a/crypto_address_here/rep`

3. App currently supports 13 crypto address types. A list with them can be found at the bottom of this file. If you're unsure about an address type you can use a parameter to find it out:  
`GET https://api.crypto-scam.io/a/crypto_address_here/type`

4. A list with all supported crypto address types can be retrieved via following request:  
`GET https://api.crypto-scam.io/a-types`

## GUI reference

1. https://crypto-scam.io/search is used to search for an address. You can search for an address from GUI site request directly -- this is also valid: https://crypto-scam.io/search/178rVxcS95pfE6UiHAFFnrTEELqhyjmxyV
2. https://crypto-scam.io/report is used to report a fraudulent address

## Privacy statement and Terms of Service
"I" refers to me (tgbv), the original creator of this project.
"We" refers to us, the contributors of this project (including me).
"You" refers to you, as consumer/user of this service.

I and future contributors of this project don't want/intent to disclose the privacy of anyone using this service.
Using it provides you understand and agree with below statements:

- All the data (IP address and request body) you share with us to provide you this service **does not** constitute personal identifiable information. We do not want it to be so anyhow.
- Before accessing any layer of our site, your request body passes through Cloudflare's infrastructure to prevent abuse.
- We use Google's Invisible reCaptcha v2; IP address and request headers will be shared with them as well when submitting POST forms.
- We collect and in some cases store machine-identifiable information (IP addresses and request headers) for indefinite periods of time in our server/database to prevent abuse. 
- We naturally store most of the data sent via our Report form: https://crypto-scam.io/report
- We use cookies (as most websites do) to prevent abuse.

## Supported crypto address types

- Binance
- Bitcoin
- Bitcoin Cash
- Bitcoin SV
- Bitcoin on Ethereum
- Dash
- Dogecoin
- Ethereum
- Ethereum Classic
- Litecoin
- Neo
- Ripple
- Zcash
