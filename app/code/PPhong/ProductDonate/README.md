# Donate Option - Magento 2 module.
- This module allow customers donate to store owner while they're visiting the site.
- Donate options are able to set in configuration.
- Show donate fee for customers view and store owner.


[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/phongphanmage)


# Installation
#### Composer:  
- `composer config repositories.pphong/product-donate vcs https://github.com/phongphanmage/donate-option-product.git`
- `composer require pphong/product-donate:dev-master`
- Execute this command if your environment is developer: `./bin/magento setup:upgrade`
- Execute this command if your environment is production: `./bin/magento setup:upgrade && ./bin/magento deploy:mode:set production`
#### Others:
- git clone
- Move or Copy this cloned repo to `app/code/PPhong/ProductDonate`
- Execute this command if your environment is developer: `./bin/magento setup:upgrade`
- Execute this command if your environment is production: `./bin/magento setup:upgrade && ./bin/magento deploy:mode:set production`
 

# Configuration:
- Stores -> Configuration -> PPhanMage - Product Donate Option -> Configuration
![Alt text](images/configuration.png?raw=true "Configuration")

# Feature Description:
- Donate Options are shown on PDP base on configuration.<br/>
![Alt text](images/pdp.png?raw=true "Configuration")
- Cart information.<br/>
![Alt text](images/cart.png?raw=true "Cart Information")
- Checkout information.<br/>
![Alt text](images/checkout.png?raw=true "Checkout Information")<br/>
- Order Grid: donate fee is able to filter and sort out.<br/>
![Alt text](images/grid.png?raw=true "Order Grid")<br/>
- Totals block information for order, invoice, creditmemo.<br/>
![Alt text](images/totals_block.png?raw=true "Totals Block")
- Order, Invoice emails.<br/>
![Alt text](images/email.png?raw=true "Email")
- PDF totals block.<br/>
![Alt text](images/pdf.png?raw=true "PDF")
- Customer's order, invoice view.<br/>
![Alt text](images/manage_order.png?raw=true "PDF")
- Customer's print view.<br/>
![Alt text](images/print_order.png?raw=true "PDF")

# Compatibility
- 2.x version.

# Report issues
- For any issue please help me open an issue.
