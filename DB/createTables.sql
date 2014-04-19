CREATE TABLE Staff(staff_id INTEGER NOT NULL AUTO_INCREMENT,
					name VARCHAR(20) NOT NULL,
					password VARCHAR(20) NOT NULL,
					manager BOOLEAN NOT NULL DEFAULT 0,
					PRIMARY KEY (staff_id));
					
CREATE TABLE Promotions(promotion_id INTEGER NOT NULL AUTO_INCREMENT,
						discount FLOAT NOT NULL,
						start_date DATE NOT NULL,
						end_date DATE,
						created_by INTEGER NOT NULL,
						PRIMARY KEY (promotion_id),
						FOREIGN KEY (created_by) REFERENCES Staff(staff_id),
						CHECK (discount < 1));

CREATE TABLE Items(item_id INTEGER NOT NULL AUTO_INCREMENT,
					description VARCHAR(200),
					name VARCHAR(50) NOT NULL,
					price FLOAT NOT NULL,
					PRIMARY KEY (item_id),
					CHECK (price > 0));
					
CREATE TABLE VIP_Items(item_id INTEGER NOT NULL AUTO_INCREMENT,
						description VARCHAR(200),
						name VARCHAR(50) NOT NULL,
						price FLOAT,
						PRIMARY KEY (item_id));
						
CREATE TABLE Customers(email VARCHAR(30) NOT NULL,
						VIP BOOLEAN NOT NULL DEFAULT 0,
						name VARCHAR(50) NOT NULL,
						password VARCHAR(20) NOT NULL,
						address VARCHAR(50),
						PRIMARY KEY (email));
						
CREATE TABLE Bids(item_id INTEGER NOT NULL AUTO_INCREMENT,
					email VARCHAR(30) NOT NULL DEFAULT '',
					amount FLOAT NOT NULL,
					winning BOOLEAN NOT NULL DEFAULT 0,
					PRIMARY KEY (item_id, email),
					FOREIGN KEY (item_id) REFERENCES VIP_Items(item_id),
					FOREIGN KEY (email) REFERENCES Customers(email));
					
CREATE TABLE Bid_Offers(item_id INTEGER NOT NULL AUTO_INCREMENT,
						email VARCHAR(30) NOT NULL,
						minimum_bid FLOAT NOT NULL,
						PRIMARY KEY (item_id, email),
						FOREIGN KEY (item_id) REFERENCES VIP_Items(item_id),
						FOREIGN KEY (email) REFERENCES Customers(email));
						
CREATE TABLE Buy_Offers(item_id INTEGER NOT NULL AUTO_INCREMENT,
						email VARCHAR(30) NOT NULL,
						asking_price FLOAT NOT NULL,
						PRIMARY KEY (item_id, email),
						FOREIGN KEY (item_id) REFERENCES VIP_Items(item_id),
						FOREIGN KEY (email) REFERENCES Customers(email));
						
CREATE TABLE Buy(item_id INTEGER NOT NULL AUTO_INCREMENT,
					email VARCHAR(30) NOT NULL,
					PRIMARY KEY (item_id, email),
					FOREIGN KEY (item_id) REFERENCES VIP_Items(item_id),
					FOREIGN KEY (email) REFERENCES Customers(email));
					
CREATE TABLE Carts(cart_id INTEGER NOT NULL AUTO_INCREMENT,
          email VARCHAR(30) NOT NULL,
					item_id INTEGER NOT NULL,
					PRIMARY KEY (cart_id),
					FOREIGN KEY (email) REFERENCES Customers(email),
					FOREIGN KEY (item_id) REFERENCES Items(item_id));
					
CREATE TABLE Orders(order_id INTEGER NOT NULL AUTO_INCREMENT,
					status INTEGER,
					order_date DATE NOT NULL,
					shipping_date DATE,
					PRIMARY KEY (order_id),
					CHECK(EXISTS(SELECT * 
								FROM Staff 
								WHERE Orders.status = Staff.staff_id)));
					
CREATE TABLE Item_orders(id INTEGER NOT NULL AUTO_INCREMENT,
              order_id INTEGER NOT NULL,
							item_id INTEGER NOT NULL,
							PRIMARY KEY (id),
							FOREIGN KEY (order_id) REFERENCES Orders(order_id),
							FOREIGN KEY (item_id) REFERENCES Items(item_id));
					
CREATE TABLE Customer_Orders(email VARCHAR(30) NOT NULL,
								order_id INTEGER NOT NULL AUTO_INCREMENT,
								PRIMARY KEY (email, order_id),
								FOREIGN KEY (email) REFERENCES Customers(email),
								FOREIGN KEY (order_id) REFERENCES Orders(order_id));

CREATE TABLE Included(item_id INTEGER NOT NULL,
						promotion_id INTEGER NOT NULL,
						PRIMARY KEY (item_id, promotion_id),
						FOREIGN KEY (item_id) REFERENCES Items(item_id),
						FOREIGN KEY (promotion_id) REFERENCES Promotions(promotion_id));
						

					
					