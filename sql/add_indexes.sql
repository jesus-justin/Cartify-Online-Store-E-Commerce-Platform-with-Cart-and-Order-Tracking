-- Indexes to improve catalog search and order browsing.

ALTER TABLE products
  ADD INDEX idx_products_name (name),
  ADD INDEX idx_products_price (price);

ALTER TABLE orders
  ADD INDEX idx_orders_date (order_date);

ALTER TABLE cart
  ADD INDEX idx_cart_product (product_id);
