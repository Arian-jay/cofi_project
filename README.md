# cofi_project


CREATE OR REPLACE VIEW cart_view AS 
	SELECT ci.id, ci.cart_id, c.user_id,
				ci.quantity,
                p.id as product_id,
                p.name as product_name, 
                p.price,
				(p.price * ci.quantity) AS total_amount,
                p.description,
                p.image,
				cat.name
	FROM carts c
	JOIN cart_items ci ON c.id = ci.cart_id
	JOIN products p ON ci.product_id = p.id
	JOIN categories cat ON cat.id = p.category_id



this is for the transaction_summary

CREATE OR REPLACE VIEW transaction_summary AS
		SELECT t.id, t.user_id, t.status, t.total_amount, t.payment_method, t.gcash_no, t.created_at
		FROM transactions t