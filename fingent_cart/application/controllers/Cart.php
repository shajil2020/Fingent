<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model("Products_model");
		$product_list = $this->Products_model->get_all();
		$data['products'] = $product_list;
		$this->load->view('product_list', $data);
	}

	public function add()
	{
		$this->load->model("Products_model");
		//==== check the product is alredy exit in cart ======//
		$product_det = $this->Products_model->get_product_count($this->input->post('id'));
		$product_count = count($product_det);
		if ($product_count == 0) {
			$insert_room = array(
				'product_id' => $this->input->post('id'),
				'product_name' => $this->input->post('name'),
				'product_price' => $this->input->post('price'),
				'product_qty' => 1
			);
			$this->Products_model->insert_products($insert_room);
		} else {
			$pro_qty = $product_det[0]['product_qty'];
			$id = $product_det[0]['id'];

			$update_room = array(
				'product_id' => $this->input->post('id'),
				'product_name' => $this->input->post('name'),
				'product_price' => $this->input->post('price'),
				'product_qty' => $pro_qty + 1,
			);
			$this->db->where('id', $id);
			$this->db->where('product_id', $this->input->post('id'));
			$this->db->update('cart_products', $update_room);
		}


		redirect('cart/invoice');
	}
	public function invoice()
	{
		$this->load->model('Cart_model');
		$this->data['title'] = 'Shopping Carts';

		$this->load->model("Products_model");
		$product_list = $this->Products_model->get_cart_products();
		$data['cart_products'] = $product_list;
		$this->load->view('invoice', $data);
	}
	public function save_order_details()
	{
		$this->load->model('Cart_model');
		$product_list = $this->input->post('product_name');
		$qty_list     = $this->input->post('qty');
		$price_list   = $this->input->post('unit_price_');
		$sub_total    = $this->input->post('old_sub_total');
		$tax          = $this->input->post('tax_amount');
		$sub_total_with_tax    = $this->input->post('total_with_tax');
		$discount          = $this->input->post('discount_amount');
		$grand_total  = $this->input->post('grand_total');


		$order_data = array(
			'sub_total' => $sub_total,
			'tax_amount' => $tax,
			'amount_with_tax' => $sub_total_with_tax,
			'discount' => $discount,
			'grand_total' => $grand_total

		);
		$order_id = $this->Cart_model->insert_order($order_data);

		if ($order_id) {

			$i = 0;
			foreach ($product_list as $product) {
				$order_details = array(
					'orderid' => $order_id,
					'product_name' => $product_list[$i],
					'unit_price' => $price_list[$i],
					'quantity' => $qty_list[$i],
					'sub_total' => $sub_total[$i]

				);

				$order_det_id = $this->Cart_model->insert_order_details($order_details);

				$i++;
			}
		}

		$this->load->model("Products_model");
		$product_list = $this->Products_model->get_cart_products();
		$data['cart_products'] = $product_list;

		$data['order_details'] = $this->Cart_model->get_order($order_id);
		$data['order_product_details'] = $this->Cart_model->get_order_products($order_id);
		$this->load->view('print_invoice_view', $data);
	}

	function delete_cart()
	{
		$this->db->truncate('orders');
		$this->db->truncate('cart_products');
		$this->db->truncate('order_detail');
		redirect('cart');
	}
}
