CREATE TABLE Product (
	pid			int		NOT NULL,
	Product_name		VARCHAR(50)	NOT NULL,
	Product_desc		TEXT,
	Price			Decimal(9,2)	NOT NULL,
	PRIMARY KEY (pid)
);

CREATE TABLE Buyer (
	bid			int		NOT NULL,
	F_Name			VARCHAR(20)	NOT NULL,
	L_Name			VARCHAR(20),
	PRIMARY KEY (bid)
);

CREATE TABLE Buyer_Addresses (
	BuyerID			int		NOT NULL,
	Buyer_Address		VARCHAR(50)	NOT NULL,
	PRIMARY KEY (BuyerID, Buyer_Address),
	FOREIGN KEY (BuyerID) REFERENCES Buyer(bid) 
		ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Buyer_Cards (
	BuyerID			int		NOT NULL,
	Buyer_card		VARCHAR(20)	NOT NULL,
	PRIMARY KEY (BuyerID, Buyer_card),
	FOREIGN KEY (BuyerID) REFERENCES Buyer(bid)
		ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Seller (
	sid			int 		NOT NULL,
	Business_Name		VARCHAR(20)	NOT NULL,
	PRIMARY KEY (sid)
);

CREATE TABLE SellerPayableAccount (
	SellerID		int		NOT NULL,
	PayableAccount		VARCHAR(50)	NOT NULL,
	PRIMARY KEY (SellerID, PayableAccount),
	FOREIGN KEY (SellerID) REFERENCES Seller(sid)
		ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Transaction (
	transaction_id		int		NOT NULL,
	transaction_date	DATE		NOT NULL,
	buyer_id		int		NOT NULL,
	seller_id		int		NOT NULL,
	PRIMARY KEY (transaction_id, buyer_id, seller_id),
	FOREIGN KEY(buyer_id) REFERENCES Buyer(bid)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(seller_id) REFERENCES Seller(sid)
		ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE TransactionProducts (
	buyer_id		int		NOT NULL,
	seller_id		int		NOT NULL,
	transaction_id		int		NOT NULL,
	product_id		int,
	product_count	int,
	PRIMARY KEY (buyer_id, seller_id, transaction_id, product_id),
	FOREIGN KEY (buyer_id) REFERENCES Buyer(bid)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (seller_id) REFERENCES Seller(sid)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (transaction_id) REFERENCES Transaction(transaction_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (product_id) REFERENCES Product(pid)
		ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Shipment (
	shipment_id		int		NOT NULL,
	order_date		DATE		NOT NULL,
	ship_date		DATE,
	arrival_date		DATE,
	status			VARCHAR(25),
	PRIMARY KEY (shipment_id)
);


CREATE TABLE Warehouse (
	warehouse_id		int		NOT NULL,
	warehouse_location	VARCHAR(50),
	warehouse_addr		VARCHAR(50),
	PRIMARY KEY (warehouse_id)
);

CREATE TABLE IncomingShipment (
	shipment_id		int		NOT NULL,
	order_date		DATE		NOT NULL,
	seller_id		int		NOT NULL,
	source_address		VARCHAR(50),
	warehouse_id		int,
	PRIMARY KEY (shipment_id, seller_id),
	FOREIGN KEY (shipment_id) REFERENCES Shipment(shipment_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (seller_id) REFERENCES Seller(sid)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (warehouse_id) REFERENCES Warehouse(warehouse_id)
		ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IncomingShipmentProducts (
	shipment_id		int		NOT NULL,
	seller_id		int		NOT NULL,
	product_id		int,
	PRIMARY KEY (shipment_id, seller_id, product_id),
	FOREIGN KEY (shipment_id) REFERENCES Shipment(shipment_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (seller_id) REFERENCES Seller(sid)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (product_id) REFERENCES Product(pid)
		ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE OutgoingShipment (
	shipment_id		int		NOT NULL,
	order_date		DATE		NOT NULL,
	buyer_id		int		NOT NULL,
	warehouse_id		int,
	PRIMARY KEY (shipment_id, buyer_id),
	FOREIGN KEY (shipment_id) REFERENCES Shipment(shipment_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (buyer_id) REFERENCES Buyer(bid)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (warehouse_id) REFERENCES Warehouse(warehouse_id)
);

CREATE TABLE OutgoingShipmentProducts (
	shipment_id		int		NOT NULL,
	buyer_id		int		NOT NULL,
	product_id		int,
	PRIMARY KEY (shipment_id, buyer_id, product_id),
	FOREIGN KEY (shipment_id) REFERENCES OutgoingShipment(shipment_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (buyer_id) REFERENCES OutgoingShipment(buyer_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (product_id) REFERENCES Product(pid)
		ON DELETE CASCADE ON UPDATE CASCADE
);


