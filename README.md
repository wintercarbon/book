# book
 project302

# dir

- [ ] index.php - have signin
   - [ ] homepage.php - menus for staff // check staff position if manager there might be manager only menus
      - [ ] Staff
         - [ ] staff_view.php - table to show all the staff details (limit 10-20 per view // have next button for next.) // (manager only: have edit button)
         - [ ] staff_edit.php - manager only access. here can update staff details and can do action delete.
      - [ ] Inventory
         - [ ] inventory_view.php - shows the inventory details. (view based on staffid -> if there is no staffid under the inventory table, then show "no inventory is being managed by you". (note: manager can view all the inventory details and the staff handling it)
         - [ ] inventory_add.php - staff can add
         - [ ] inventory_edit.php - staff can edit/update book quantity etc.
      - [ ] Book
         - [ ] book_view.php - table to show all the book details (limit 10-20 per view // have next button for next.) // (manager only: have edit button)
         - [ ] book_edit.php - manager only access. here can update book details and can do action delete.
      - [ ] Supplier
         - [ ] supplier_view.php - table to show all the supplier details (limit 10-20 per view // have next button for next.) // (manager only: have edit button)
         - [ ] supplier_edit.php - manager only access. here can update supplier details and can do action delete.
      - [ ] Sales Report
         - [ ] sales_report_view.php - shows the sales report. (view based on date, supplier, and staff member)
         - [ ] sales_report_generate.php - allows the user to generate a report based on the specified criteria.

 - [ ] php functions
    - [ ] get_staff_data - handles the retrieval of staff data from the database.
    - [ ] get_inventory_data - handles the retrieval of inventory data from the database.
    - [ ] get_book_data - handles the retrieval of book data from the database.
    - [ ] get_supplier_data - handles the retrieval of supplier data from the database.
    - [ ] get_sales_report_data - handles the retrieval of sales report data from the database.
    - [ ] add_staff - handles the submission of new staff data to the database.
    - [ ] add_inventory - handles the submission of new inventory data to the database.
    - [ ] add_book - handles the submission of new book data to the database.
    - [ ] add_supplier - handles the submission of new supplier data to the database.

# page descriptions
- Staff management page: This page would allow a manager to view and manage all staff members, including their personal details, salary information, and the staff members they supervise. It could also include functionality for adding, editing, and deleting staff members, as well as assigning supervisors.

- Inventory management page: This page would allow a staff member to view and manage the inventory they handle, including the books they have in stock and the suppliers they purchase from. It could also include functionality for adding, editing, and deleting inventory items, as well as updating the quantity of books in stock.

- Book management page: This page would allow a staff member to view and manage all books, including their details, authors, prices, and suppliers. It could also include functionality for adding, editing, and deleting books.

- Supplier management page: This page would allow a staff member to view and manage all suppliers, including their details, addresses, and contact information. It could also include functionality for adding, editing, and deleting suppliers.

- Sales Report Page: This page would allow a staff member to view and manage the sales report. It could include functionality for viewing the book and inventory report, generating report based on date, supplier and staff member.

- Login page: This page would allow staff members to log in to the system with their email and password, allowing them to access the pages appropriate to their role.

- Home page: This page would provide a summary of the different sections of the website and allow users to navigate to the pages they need

# ERD
![images](https://github.com/wintercarbon/book/blob/main/erd%20latest.jpg)
