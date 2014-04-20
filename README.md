CS405 Project
=============

This site is currently live at cs405-ggjl.rhcloud.com

Authors
=======

* Joel Lubrano
* Grant Garrett

Description
===========

Website for CS405 Project

Files
=====

* Project Root
    * index.php - Application Home Page

    * signOut.php - Signs out staff and customers alike.  Begins a new HTTP Session.

    * config
        * config.php - Contains definitions of global variables for the application.

    * contact
        * index.php - Static html contact us page.

    * DAOs (Data Access Objects)
        * CustomerDAO.php - Defines CustomerDAO class that executes queries regarding
                            customer authentication and information.

        * ItemsDAO.php - Defines ItemsDAO class that executes queries regarding Items and Item_orders.

        * StaffDAO.php - Defines StaffDAO class that executes queries regarding staff and manager authentication.

    * DB
        * createTables.sql - Creates tables in DB.
        * items.sql - Initializes items in store's inventory.

    * helpers
        * displayOrders.php - Contains queries to retrieve order information from the database.
                              Contains a function to neatly display order information in a table.

    * images

    * js
        * application.js - Contains application scope javascript/jQuery functions.

    * layout
        * footer.php - Generates links in site footer.
        * headerTags.php - Generates html header tags for a typical site page.
        * navbar.php - Generates links and formats navbar for entire site.
        * sidebar.php - Generates links and formats sidebar for entire site.

    * shopping
        * addToCart.php - Contains logic and queries for adding items to a user's cart.
        * displayItems.php - Contains logic for displaying items in tabular format according to the intent
                             of the current user.
        * index.php - Shows a list of all items.
        * myOrders.php - Contains queries to display current customer's orders.
        * purchase.php - Contains queries to move items from the current customer's cart into a purchased order.
        * purchaseConfirmation.php - Landing page for customer after purchasing items.
        * removeFromCart.php - Defines and executes queries to remove items from the current user's cart.
        * search.php - Modifies the items to be displayed by displayItems.php by searching according to keyword GET parameter.
        * viewCart.php - Defines and executes queries to display items in current customer's cart.

    * signIn
        * createCustomer.php - takes input from form in register.php to add customer to the database.
        * index.php - Displays login form for customers.
        * register.php - Displays form to register a new customer.
        * signInCustomer.php - Authenticates user credentials provided to index.php.

    * staff
        * addNewItem.php - Displays form for creating a new item in the store's inventory.
        * addNewStaff.php - Displays form for creating a new staff member.
        * authenticateManager.php - Checks if current user has credentials that match a store manager's.
        * authenticateStaff.php - Checks if current user has credentials that match a staff member's.
        * createItem.php - Parses request from addNewItem.php to create a new Item in the store's inventory.
        * createPromotion - Parses request from startPromotion.php to create a new promotion in the database.
        * createStaff.php - Parses request from addNewStaff.php to create a new promotion in the database.
        * index.php - Displays static menu for staff actions.
        * salesStatistics.php - Displays items and amount of items sold in the past week, month, or year.
        * shipOrder.php - Updates status and shipping_date of an existing order in the database.
        * signIn.php - Displays form for staff login.
        * signInStaff.php - Authenticates staff credentials provided to signIn.php.
        * startPromotion.php - Displays form to create a new promotion.
        * stopPromotion.php - Sets end_date on a given promotion and resets item prices to pre-promotion levels.
        * updateInventory.php - Displays a form for updating inventory quantities.
        * updateItem.php - Changes the quantity of a given item via a SQL UPDATE.
        * viewPendingOrders.php - Shows orders that have been placed but not yet shipped.
        * viewPromotionHistory.php - Shows current and past promotions, allows managers to stop promotions.
        * viewStaff.php - Shows all staff members with login credentials.

    * style
        * application.css - application scope stylesheet.

    * utilities
        * DB_Connector.php - Defines DB_Connector class including methods for connecting to the database and executing
                             prepared statements and static queries.
