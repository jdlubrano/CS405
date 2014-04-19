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
        * myOrders.php -
