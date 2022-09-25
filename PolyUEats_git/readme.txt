The PolyU-Eat can be used for both customers and administrators. In this case, after the user is logged in, 
data will be retrieved from Users.sql to identify whether the user is a customer or an administrator. 
Two different pages will be displayed correspondingly. 

For customers, they can first select which canteen they want to view. 
We currently have two canteens: American Diner and VA Canteen. 
After the canteen is selected, customers will be directed to the menu page, 
where they can view all the food in the selected canteen and add the food they want into the shopping cart. 
The information of the food are retrieved from food.sql. 
Customers can click to view their shopping cart at any time. 
This will lead them to the order confirmation page. 
Customers can go back to shopping or confirm their orders. Some additional order information will be asked to put in during the confirmation. 
After the order is confirmed, customers will get a receipt with the food they ordered, 
the information of the order and the order status. Each order will have a specific order ID. After generating a new ID, the system will check whether it is used before in the usedID.sql. The order information will be put into the Order.sql.
Customer login:
Cook
222

For administrators, their job information which indicate which canteen they belonged to are stored in the database. 
They will see the management page once they logged in. 
Administrators can view the orders they have and the menu of their food in this page. 
The data are retrieved from Orders.sql and food.sql. 
Administrators can manipulate the menu by clicking the button under the menu.
Then, they can choose to change the price of food items, add food items or delete food items. 
Administrators can manipulate the orders by clicking the button under orders. 
Then, they can view the detailed information of an order. 
There are four status in an order, and it can be updated by administrators. The information will be updated in Order.sql. The page will be automatically redirected to the management page after the operation is finished. 
Admin login:
John
111